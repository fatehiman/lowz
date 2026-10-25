<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="noindex, nofollow">
    <title>به‌زودی — {{ config('shop.name') }}</title>
    <link rel="icon" type="image/svg+xml" href="{{ asset('favicon.svg') }}">
    <link rel="shortcut icon" href="{{ asset('favicon.ico') }}">
    <style>
        @font-face {
            font-family: 'Vazirmatn';
            src: url('{{ asset('fonts/Vazirmatn[wght].woff2') }}') format('woff2');
            font-weight: 100 900;
            font-display: swap;
        }
        * { box-sizing: border-box; margin: 0; padding: 0; }
        body {
            min-block-size: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 1.5rem;
            font-family: 'Vazirmatn', Tahoma, sans-serif;
            line-height: 1.8;
            color: #1f2a1f;
            background: radial-gradient(circle at 30% 20%, #e8f5e9, #f7fbf4 60%, #eef6ea);
        }
        .card {
            max-inline-size: 520px;
            text-align: center;
            background: #fff;
            border: 1px solid #dfe8d8;
            border-radius: 1.25rem;
            padding: 2.5rem 2rem;
            box-shadow: 0 10px 30px rgb(27 94 32 / 0.08);
        }
        img { inline-size: 96px; block-size: 96px; }
        h1 { font-size: 1.6rem; color: #1b5e20; margin-block: 0.75rem 0.5rem; }
        p { color: #5f6b5f; }
        .leaf { display: inline-block; margin-block-start: 1.25rem; font-size: 0.875rem; color: #2e7d32; }
    </style>
</head>
<body>
    <main class="card">
        <img src="{{ asset('images/logo.svg') }}" alt="{{ config('shop.name') }}" width="96" height="96">
        <h1>{{ config('shop.name') }} به‌زودی باز می‌شود</h1>
        <p>وب‌سایت ما در حال آماده‌سازی است. به‌زودی با گیاهان دارویی، ادویه‌ها و دمنوش‌های طبیعی در خدمت شما خواهیم بود.</p>
        <span class="leaf">🌿 از صبر و همراهی شما سپاسگزاریم</span>
    </main>
</body>
</html>
