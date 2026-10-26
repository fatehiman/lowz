# عطاری لوز — lowz.ir

Demo online shop of an **عطاری** (Persian herbal and spice shop). Persian only, RTL only, green theme,
garlic logo. Laravel 12 + Blade, plain CSS and vanilla JS (no build step).

Built from the code of `E:\www\partycookies` (shop, cart, checkout, blog, AI articles, SEO) and the
"under construction" idea of `E:\www\narjeshesari`.

> **The site is public** (since 2026-10-26, under construction mode is off). Products, prices, descriptions, articles,
> reviews and images are still demo data. The payment gateway is a placeholder (no money moves).
> Phone numbers and social links are hidden until the owner has real ones (see "Contact info" below).

- **Repo:** https://github.com/fatehiman/lowz (public — never commit secrets)
- **Production:** https://lowz.ir on `ger1` — see [deployment-on-ger1.md](deployment-on-ger1.md)

## Features

- **Shop** — 8 product categories, 49 products (33 demo products + 16 real catalog products) (`/shop`, `/category/{slug}`, `/products/{slug}`).
  Each product has a pack size (`products.unit`, e.g. «۱۰۰ گرم»). Product pages have JSON-LD
  (`Product`, `Offer`, `BreadcrumbList`), reviews with stars (only accepted reviews are shown), related products.
- **Cart / checkout** — the cart lives in the browser (`localStorage` key `lowz_cart`); the server always
  re-prices it (`App\Services\CartPricing`). Checkout asks for name, mobile, province/city (all of Iran), address.
  A پیش‌فاکتور (proforma) can be printed.
- **Payment (placeholder)** — `PaymentController`: the order goes to `/payment/demo/{order}`, a fake bank page
  with «پرداخت موفق» and «انصراف». Success marks the order `paid` with a `DEMO-…` tracking code.
  To connect a real gateway, replace `payOrder()` and `demoCallback()` (see the class comment).
- **Blog** — 5 article categories (`/blog`, `/blog/category/{slug}`, `/article/{persian-slug}`), 8 hand-written
  demo articles, «دیگر بخوانید» and related articles.
- **Daily AI article** — `php artisan blog:generate` (cron on ger1, daily). The code picks a subject from
  `article_subjects` (44 starter subjects about عطاری, each linked to an article category) by fair rotation, asks
  **DeepSeek** for a Persian article, **SiliconFlow** draws the cover image (`public/images/articles/ai-*.webp`,
  not in git), and a second call writes the SEO fields. The new article gets the category of its subject.
  Options: `--topic=`, `--dry-run`, `--draft`, `--no-image`. `php artisan blog:rotation` shows the counters.
  Keys: `DEEPSEEK_API_KEY`, `SILICONFLOW_API_KEY` in `.env` (Bitwarden folder `AI Providers`).
- **Contact form** with a math captcha (saved to `storage/app/contacts/`, nothing is sent out),
  about page, rules / privacy page.
- **SEO** — titles/descriptions per page (`page_seo` table), canonical URLs, Open Graph, sitemap, robots.txt.

## Contact info (hidden items)

- Address (real): `config/shop.php` → `address` (or `SHOP_ADDRESS` in `.env`).
- **Phone numbers are hidden** everywhere (footer, `/contact`, JSON-LD) while `SHOP_PHONE` and `SHOP_MOBILE` are empty.
  To show them later, set them in the server `.env` (then `php8.4 artisan config:cache`) or give them a default in
  `config/shop.php`. The footer and the contact page already have the markup.
- **Social icons are hidden** while `SHOP_INSTAGRAM`, `SHOP_TELEGRAM`, `SHOP_WHATSAPP` are empty. Set a link to show the footer icons.
- The cart minus button removes the product when the quantity is at the product minimum.

## Under construction mode

The mode is **off now** (public since 2026-10-26). It was on after the first install (setting `maintenance_enabled = 1`), so visitors and search engines do not see the demo.

- Everybody gets a waiting page: HTTP **503** with `Retry-After`, `X-Robots-Tag: noindex`.
- `robots.txt` says `Disallow: /`; `sitemap.xml` is also closed. Every page has `noindex` while the mode is on,
  even for people who can see it.
- **Preview link:** `https://lowz.ir/preview/<UNDER_CONSTRUCTION_TOKEN>` (token in the server `.env`) gives your
  browser a cookie for 180 days and you see the real site with a yellow band on top.
  `…/preview/<token>/off` removes the cookie.
- Allowed IPs (optional), one per line in the setting `maintenance_ips`, e.g. `1.2.3.4 # office`.
- Commands (on the server, as the site user):

  ```bash
  php8.4 artisan site:construction status        # shows the mode, the IPs and the preview link
  php8.4 artisan site:construction off           # open the site to everybody
  php8.4 artisan site:construction on
  php8.4 artisan site:construction allow 1.2.3.4 --label="office"
  php8.4 artisan site:construction deny 1.2.3.4
  ```

`/up` (health check) always works.

## Demo data

Seeders (`database/seeders`) only **add missing rows** (`firstOrCreate`), so `db:seed` runs on every deploy without
overwriting anything you edited later. To replace the demo data, edit the rows in the database (or the seeders
and run them on an empty database).

| What | Where |
|---|---|
| Shop name, address, phone (hidden), social links (hidden) | `config/shop.php` (or `SHOP_*` in `.env`) |
| Categories + demo products | `ProductSeeder` → tables `product_categories`, `products` |
| Real catalog (16 products, 2 categories) | `CatalogProductSeeder` — from `reference-docs/product-links.txt`; price = supplier price × 2.5; texts rewritten in Persian; photos in `public/images/products/` (sources in [IMAGE-CREDITS.md](IMAGE-CREDITS.md)) |
| Article categories + AI subjects | `ArticleSubjectSeeder` → `article_categories`, `article_subjects` |
| Starter articles | `ArticleSeeder` |
| Page titles / descriptions | `PageSeoSeeder` → `page_seo` |
| Settings (under construction, minimum order, VAT, packing) | `SettingSeeder` → `settings` |
| Demo reviews | `CommentSeeder` (only when `comments` is empty) |
| Images | `public/images/` — sources and licenses in [IMAGE-CREDITS.md](IMAGE-CREDITS.md) |

Accept a product review: `UPDATE comments SET is_accepted=1 WHERE id=N;`

## Run locally

```bash
composer install
cp .env.example .env && php artisan key:generate
touch database/database.sqlite
php artisan migrate --seed
php artisan site:construction off      # or set UNDER_CONSTRUCTION_TOKEN and open /preview/<token>
php artisan serve
php artisan test
```

## Project map

| Path | What |
|---|---|
| `routes/web.php` | all routes |
| `app/Http/Middleware/UnderConstruction.php` | the under-construction mode |
| `app/Console/Commands/SiteConstruction.php` | `site:construction` |
| `app/Http/Controllers/PaymentController.php` | placeholder payment gateway |
| `app/Services/AiArticleGenerator.php` | AI article prompts and image generation |
| `config/shop.php` | shop identity (demo values) |
| `public/css/app.css` | all styles (green theme colors are the `--color-*` variables at the top) |
| `public/images/logo.svg` | garlic logo; favicons and app icons in `public/` are made from it |
| `deploy/deploy.sh` | deploy to ger1 |
| `deploy/new-article.sh` | run the AI article by hand on ger1 |
| `reference-docs/` | the owner's own files (contracts, graphics…). Not deployed, no `.md` files there |
