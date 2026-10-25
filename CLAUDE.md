# lowz — project notes for Claude

Demo عطاری shop (Persian, RTL only, green theme). Laravel 12 + Blade, plain CSS/JS in `public/` (no build step).
Production: https://lowz.ir on `ger1` (user `lowz`, app in `/mnt/ger_hd1/www/lowz/app`). See README.md.

## Rules for this repo
- The repo is **public**: never commit `.env`, keys, passwords or `credentials.md`.
- All data is demo. Seeders must stay idempotent (`firstOrCreate`): `db:seed` runs on every deploy.
- Shop name/contact come from `config/shop.php`; do not hard-code the shop name in views.
- "Under construction" is a DB setting (`maintenance_enabled`); never let a seeder or deploy turn it back on.
- `*.md` and `reference-docs/` are committed but never deployed (`.gitattributes` export-ignore). All `.md` files stay in the root.
- Deploy: commit, then `bash deploy/deploy.sh` (Git Bash). It uses the last commit.
- Run tests: `php artisan test`.
