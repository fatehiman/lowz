@php
    $shopName = config('shop.name');
    $defaultDescription = $shopName.' — '.config('shop.tagline');
    $underConstruction = \App\Http\Middleware\UnderConstruction::enabled();
@endphp
<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', $shopName)</title>
    <meta name="description" content="@yield('meta_description', $defaultDescription)">
    @hasSection('keywords')
    <meta name="keywords" content="@yield('keywords')">
    @endif
    {{-- While the site is under construction nothing may be indexed, not even the preview. --}}
    @if ($underConstruction)
    <meta name="robots" content="noindex, nofollow">
    @else
    <meta name="robots" content="@yield('robots', 'index, follow, max-image-preview:large, max-snippet:-1')">
    @endif
    <link rel="canonical" href="@yield('canonical', url()->current())">
    <meta name="theme-color" content="#2e7d32">

    <link rel="icon" type="image/png" sizes="32x32" href="{{ versioned_asset('favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ versioned_asset('favicon-16x16.png') }}">
    <link rel="icon" type="image/png" sizes="96x96" href="{{ versioned_asset('favicon-96x96.png') }}">
    <link rel="icon" type="image/svg+xml" href="{{ versioned_asset('favicon.svg') }}">
    <link rel="shortcut icon" href="{{ versioned_asset('favicon.ico') }}">
    <link rel="apple-touch-icon" sizes="180x180" href="{{ versioned_asset('apple-touch-icon.png') }}">
    <meta name="apple-mobile-web-app-title" content="{{ $shopName }}">
    <link rel="manifest" href="{{ versioned_asset('site.webmanifest') }}">

    <meta property="og:title" content="@yield('title', $shopName)">
    <meta property="og:description" content="@yield('meta_description', $defaultDescription)">
    <meta property="og:type" content="@yield('og_type', 'website')">
    <meta property="og:url" content="@yield('canonical', url()->current())">
    <meta property="og:locale" content="fa_IR">
    <meta property="og:site_name" content="{{ $shopName }}">
    <meta property="og:image" content="@yield('og_image_url', asset('og-image.png'))">
    @hasSection('og_image_alt')
    <meta property="og:image:alt" content="@yield('og_image_alt')">
    @endif
    @yield('meta_extra')

    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="@yield('title', $shopName)">
    <meta name="twitter:description" content="@yield('meta_description', $defaultDescription)">
    <meta name="twitter:image" content="@yield('og_image_url', asset('og-image.png'))">

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="preload" href="{{ asset('fonts/Vazirmatn[wght].woff2') }}" as="font" type="font/woff2" crossorigin>
    <link rel="stylesheet" href="{{ versioned_asset('css/app.css') }}">

    @section('jsonld')
        <script type="application/ld+json">
        {!! json_encode([
            '@@context' => 'https://schema.org',
            '@type' => 'Store',
            'name' => $shopName,
            'url' => url('/'),
            'logo' => asset('web-app-manifest-512x512.png'),
            'image' => asset('og-image.png'),
            'address' => config('shop.address'),
        ], JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES) !!}
        </script>
    @show
</head>
<body>
    @if (\App\Http\Middleware\UnderConstruction::previewing(request()))
        <div class="preview-band">
            حالت «در دست ساخت» روشن است؛ فقط شما (پیش‌نمایش) این سایت را می‌بینید. بازدیدکنندگان و موتورهای جستجو صفحه انتظار را می‌بینند.
            <button type="button" aria-label="بستن" onclick="this.parentElement.remove()">×</button>
        </div>
    @endif

    @include('partials.header')

    <main>
        @yield('content')
    </main>

    @include('partials.footer')

    @yield('extra_js')
    <script src="{{ versioned_asset('js/app.js') }}" defer></script>
</body>
</html>
