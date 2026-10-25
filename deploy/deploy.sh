#!/usr/bin/env bash
# Deploy lowz.ir (Laravel) to ger1 from the last git commit.
# Run from the repo root in Git Bash:   bash deploy/deploy.sh
#
# First run also: enables MySQL for the domain (database "lowz"), switches the site to PHP-FPM 8.4,
# moves the web root to app/public, backs up the old site, creates .env (with a random
# UNDER_CONSTRUCTION_TOKEN) and installs the daily AI-article cron.
# Every run: code, composer, migrate, seed (seeders only add missing rows), caches, opcache reset.
# *.md files, reference-docs/ and tests/ are never deployed.
set -euo pipefail

HOST=Ger1-root
SITE_USER=lowz
DOMAIN=lowz.ir
HOME_DIR=/mnt/ger_hd1/www/lowz
APP=$HOME_DIR/app
PHP=php8.4
IP=162.55.167.140

cd "$(dirname "$0")/.."
if [ -n "$(git status --porcelain)" ]; then
  echo "Commit your changes first (the deploy uses the last commit)." >&2
  exit 1
fi

echo "== whitelist this IP on the Hetzner firewall"
curl -s "https://mon.peppasoft.com/addip?_type=s" >/dev/null
sleep 5

TMP=$(mktemp -d)
git archive --format=tar.gz -o "$TMP/app.tgz" HEAD
if tar tzf "$TMP/app.tgz" | grep -E '(^|/)reference-docs/|\.md$|^tests/'; then
  echo "The package contains .md files, tests or reference-docs/ - stop." >&2
  exit 1
fi
echo "package: $(tar tzf "$TMP/app.tgz" | wc -l) files"

echo "== upload"
scp -q "$TMP/app.tgz" "$HOST:/tmp/lowz-app.tgz"
rm -rf "$TMP"

echo "== install on server"
ssh "$HOST" bash -s <<EOF
set -euo pipefail
FIRST=0
[ -f $APP/.env ] || FIRST=1

# Backup before replacing anything.
mkdir -p /root/backups
STAMP=\$(date +%Y%m%d-%H%M%S)
if [ \$FIRST = 1 ]; then
  tar czf /root/backups/lowz-old-site-\$STAMP.tgz -C $HOME_DIR public_html
  echo "old site backed up: /root/backups/lowz-old-site-\$STAMP.tgz"
else
  tar czf /root/backups/lowz-app-\$STAMP.tgz -C $APP --exclude=vendor --exclude=storage --exclude=bootstrap/cache --exclude=public/images/articles .
  mysqldump --single-transaction $SITE_USER | gzip > /root/backups/lowz-db-\$STAMP.sql.gz
fi

# Code (extracted over the old tree: AI article images in public/images/articles stay).
mkdir -p $APP /tmp/lowz-stage
rm -rf /tmp/lowz-stage/*
tar xzf /tmp/lowz-app.tgz -C /tmp/lowz-stage
cp -a /tmp/lowz-stage/. $APP/
rm -rf /tmp/lowz-stage /tmp/lowz-app.tgz
rm -f $APP/bootstrap/cache/packages.php $APP/bootstrap/cache/services.php
mkdir -p $APP/storage/app/private $APP/storage/logs $APP/storage/framework/{cache,sessions,views} $APP/bootstrap/cache $APP/public/images/articles

# First run: database, .env, PHP version, web root, cron.
if [ \$FIRST = 1 ]; then
  if ! virtualmin list-domains --domain $DOMAIN --multiline | grep -q 'Features:.*mysql'; then
    virtualmin enable-feature --domain $DOMAIN --mysql
  fi
  DBPASS=\$(virtualmin list-domains --domain $DOMAIN --multiline | awk -F': ' '/Password for mysql/{print \$2}')
  KEY=\$(openssl rand -base64 32)
  PREVIEW=\$(openssl rand -hex 16)
  cat > $APP/.env <<ENV
APP_NAME="عطاری لوز"
APP_ENV=production
APP_KEY=base64:\$KEY
APP_DEBUG=false
APP_URL=https://$DOMAIN
APP_LOCALE=fa
APP_FALLBACK_LOCALE=fa
LOG_CHANNEL=single
LOG_LEVEL=warning
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=$SITE_USER
DB_USERNAME=$SITE_USER
DB_PASSWORD=\$DBPASS
SESSION_DRIVER=file
SESSION_LIFETIME=720
CACHE_STORE=file
QUEUE_CONNECTION=sync
PAYMENT_GATEWAY=demo
UNDER_CONSTRUCTION_TOKEN=\$PREVIEW
DEEPSEEK_API_KEY=
SILICONFLOW_API_KEY=
ENV
  virtualmin modify-web --domain $DOMAIN --mode fpm >/dev/null
  virtualmin modify-web --domain $DOMAIN --php-version 8.4 >/dev/null
  virtualmin modify-web --domain $DOMAIN --document-dir app/public >/dev/null
  # Daily AI article (server time is Europe/Berlin: 07:45 is about 09:15/10:15 in Tehran).
  echo "45 7 * * * $SITE_USER cd $APP && /usr/bin/$PHP artisan blog:generate >> $APP/storage/logs/blog-cron.log 2>&1" > /etc/cron.d/lowz
  chmod 644 /etc/cron.d/lowz
fi

cp $APP/deploy/new-article.sh $HOME_DIR/new-article.sh
chown $SITE_USER:$SITE_USER $HOME_DIR/new-article.sh
chmod 750 $HOME_DIR/new-article.sh

chown -R $SITE_USER:$SITE_USER $APP
chmod 710 $APP
chmod 755 $APP/public
chmod 600 $APP/.env

su -s /bin/bash $SITE_USER -c "cd $APP && $PHP /usr/local/bin/composer install --no-dev --optimize-autoloader --no-interaction --quiet \
  && $PHP artisan migrate --force \
  && $PHP artisan db:seed --force \
  && $PHP artisan optimize:clear >/dev/null \
  && $PHP artisan optimize"

# Per-domain PHP-FPM opcache ignores file times: reset it through a one-shot script.
TOKEN=\$(openssl rand -hex 12)
echo '<?php opcache_reset(); echo "flushed";' > $APP/public/flush-\$TOKEN.php
chown $SITE_USER:$SITE_USER $APP/public/flush-\$TOKEN.php
sleep 2
curl -sk --resolve "$DOMAIN:443:$IP" "https://$DOMAIN/flush-\$TOKEN.php" -o /dev/null || true
rm -f $APP/public/flush-\$TOKEN.php
EOF

echo "== check"
for i in 1 2 3 4 5; do
  code=$(curl -s -o /dev/null -w '%{http_code}' "https://$DOMAIN/up" || true)
  [ "$code" = "200" ] && break
  sleep 1
done
echo "https://$DOMAIN/up -> $code"
# While "under construction" is on, pages answer 503 and robots.txt says "Disallow: /".
for p in / /shop /blog /robots.txt /sitemap.xml; do
  echo "https://$DOMAIN$p -> $(curl -s -o /dev/null -w '%{http_code}' "https://$DOMAIN$p")"
done
