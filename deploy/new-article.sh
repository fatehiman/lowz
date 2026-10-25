#!/bin/bash
# Create one AI blog article now (same as the daily cron).
# Lives in git at deploy/new-article.sh; installed on ger1 as
# /mnt/ger_hd1/www/lowz/new-article.sh. Works as root or as the lowz user.

APP=/mnt/ger_hd1/www/lowz/app

show_help() {
    cat <<'HELP'
Create one AI blog article now (same as the daily cron).

Usage:
  ./new-article.sh run [options]     create an article (subject and product picked by rotation)
  ./new-article.sh rotation          show subject/product counters and next-pick chances
  ./new-article.sh help              show this help (also shown with no argument)

Options for "run":
  --topic="زعفران؛ طلای سرخ ایران"   use this topic instead of the rotation
  --dry-run            only print the article, save nothing
  --draft              save as unpublished
  --no-image           no cover image

Examples:
  ./new-article.sh run
  ./new-article.sh run --dry-run
  ./new-article.sh run --topic="دمنوش‌های خنک تابستانی" --draft

Output is also added to storage/logs/blog-cron.log.
HELP
}

case "$1" in
    run | rotation) ;;
    "" | help | -h | --help)
        show_help
        exit 0
        ;;
    *)
        echo "Unknown command: $1" >&2
        echo >&2
        show_help >&2
        exit 1
        ;;
esac

if [ "$(id -un)" != "lowz" ]; then
    exec su lowz -s /bin/bash -c "$(printf "%q " "$0" "$@")"
fi

cd "$APP" || exit 1

if [ "$1" = "rotation" ]; then
    exec /usr/bin/php8.4 artisan blog:rotation
fi

shift
/usr/bin/php8.4 artisan blog:generate "$@" 2>&1 | tee -a "$APP/storage/logs/blog-cron.log"
