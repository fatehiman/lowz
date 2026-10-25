<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="noindex, nofollow">
    <title>@yield('title', config('shop.name'))</title>

    <link rel="icon" type="image/png" sizes="32x32" href="{{ versioned_asset('favicon-32x32.png') }}">
    <link rel="icon" type="image/svg+xml" href="{{ versioned_asset('favicon.svg') }}">
    <link rel="shortcut icon" href="{{ versioned_asset('favicon.ico') }}">
    <link rel="preload" href="{{ asset('fonts/Vazirmatn[wght].woff2') }}" as="font" type="font/woff2" crossorigin>
    <link rel="stylesheet" href="{{ versioned_asset('css/app.css') }}">
</head>
<body>
    @yield('content')
</body>
</html>
