# deployment-on-ger1.md — lowz.ir on ger1 (production)

## Server

ger1 = `hetzner-webserver`, `162.55.167.140`, Virtualmin / Ubuntu 24.04 shared hosting.
SSH needs a per-session IP whitelist first (`curl -s "https://mon.peppasoft.com/addip?_type=s"`), then `ssh Ger1-root`.
See the `deploy` skill (`servers/ger1.md`).

## Site

| Field | Value |
|---|---|
| Domain | `lowz.ir` (Cloudflare in front; `www.lowz.ir` → 301 to `lowz.ir` by the app) |
| Virtualmin user | `lowz`, home `/mnt/ger_hd1/www/lowz` |
| App code | `/mnt/ger_hd1/www/lowz/app` |
| Docroot | `/mnt/ger_hd1/www/lowz/app/public` (set with `virtualmin modify-web --document-dir app/public`) |
| PHP | PHP-FPM 8.4 pool of the domain |
| Database | MySQL `lowz`, user `lowz`, host `127.0.0.1`; password = the Virtualmin MySQL password of the domain (in `app/.env`) |
| `.env` | only on the server, `chmod 600`, owner `lowz`. Has `UNDER_CONSTRUCTION_TOKEN` and the AI keys |
| Cron | `/etc/cron.d/lowz` — `blog:generate` daily at 07:45 server time (Europe/Berlin) as user `lowz` |
| Logs | `app/storage/logs/laravel.log`, `blog-cron.log`, `blog-ai-YYYY-MM-DD.log` |

## Deploy

```bash
git commit ...           # the deploy uses the last commit
bash deploy/deploy.sh    # in Git Bash, from the repo root
```

The script: whitelists the IP → `git archive HEAD` (no `.md`, no `tests/`, no `reference-docs/`) → upload →
backup of the code and a DB dump in `/root/backups/lowz-*` → extract over `app/` → `composer install --no-dev` →
`migrate --force` → `db:seed --force` (seeders only add missing rows) → `optimize` → opcache reset → checks URLs.

The first run also enabled the MySQL feature, set PHP-FPM 8.4 and the docroot, wrote `.env` and the cron file,
and backed up the old Virtualmin welcome page to `/root/backups/lowz-old-site-*.tgz`.

After the first deploy the AI keys were copied by hand (server to server) from the partycookies `.env`
(`DEEPSEEK_API_KEY`, `SILICONFLOW_API_KEY`), then `php8.4 artisan config:cache`.

## Under construction

On. Visitors get 503, `robots.txt` says `Disallow: /`. Preview link: `https://lowz.ir/preview/<UNDER_CONSTRUCTION_TOKEN>`
(the link is in `E:\www\myLan\credentials.md`).

```bash
cd /mnt/ger_hd1/www/lowz/app
su -s /bin/bash lowz -c 'php8.4 artisan site:construction status'
su -s /bin/bash lowz -c 'php8.4 artisan site:construction off'    # open the site
```

## AI articles by hand

```bash
/mnt/ger_hd1/www/lowz/new-article.sh            # help
/mnt/ger_hd1/www/lowz/new-article.sh run        # one article now (same as the cron)
/mnt/ger_hd1/www/lowz/new-article.sh rotation   # subject/product counters
```

AI cover images are saved in `app/public/images/articles/ai-*.webp` (only on the server, not in git).
Never `rsync --delete` that folder.

## Health check

```bash
curl -s -o /dev/null -w '%{http_code}\n' https://lowz.ir/up      # 200
curl -s -o /dev/null -w '%{http_code}\n' https://lowz.ir/        # 503 while under construction
```

## Deploy log

- **2026-10-26** — first deploy. MySQL feature enabled (database `lowz`), PHP-FPM 8.4, docroot `app/public`,
  `.env`, cron. Seeded demo data (33 products, 6 categories, 5 article categories, 44 AI subjects, 8 articles,
  9 reviews, provinces/cities). AI keys copied from partycookies. 12 AI articles generated with
  `new-article.sh run`. Verified through Cloudflare: `/up` 200, `/` 503 without the cookie, all pages 200
  with the preview cookie (with `noindex`), demo checkout and payment work locally (tests).
