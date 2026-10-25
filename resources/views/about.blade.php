@extends('layouts.app')

@section('title', $title)
@section('meta_description', $meta_description)
@section('canonical', route('about'))

@section('content')
<div class="page-section">
    <nav class="breadcrumb" aria-label="مسیر صفحه">
        <a href="{{ route('home') }}">خانه</a>
        <span class="breadcrumb-sep">/</span>
        <span class="breadcrumb-current">درباره ما</span>
    </nav>

    <div class="about-hero">
        <img src="{{ versioned_asset('images/categories/spices.webp') }}" alt="ادویه‌ها و گیاهان دارویی در {{ config('shop.name') }}" width="800" height="300" loading="lazy">
    </div>

    <h1>درباره {{ config('shop.name') }}</h1>

    <p class="demo-note">این صفحه یک متن نمونه است و بعداً با داستان واقعی فروشگاه جایگزین می‌شود.</p>

    <p>
        {{ config('shop.name') }} یک عطاری آنلاین است که می‌خواهد تجربه خرید از یک عطاری قدیمی و قابل اعتماد را به خانه شما بیاورد.
        ما ادویه‌ها، دمنوش‌ها، گیاهان دارویی، عرقیات، روغن‌های گیاهی، عسل و دانه‌های خوراکی را از تولیدکنندگان و باغداران مطمئن تهیه می‌کنیم،
        پاک و بوجاری می‌کنیم و در بسته‌بندی بهداشتی به دست شما می‌رسانیم.
    </p>
    <p>
        نام «لوز» در زبان فارسی به معنی بادام است؛ میوه‌ای ساده، مغذی و ماندگار. ما هم دوست داریم محصولاتمان همین‌طور باشند: ساده، طبیعی و قابل اعتماد.
        نماد ما یک حبه سیر است؛ گیاهی که از قدیم در آشپزخانه و طب سنتی ایرانی جای ویژه‌ای داشته است.
    </p>

    <h2 class="mt-3 mb-2">چرا {{ config('shop.name') }}؟</h2>
    <ul>
        <li class="mb-1">🌿 محصولات تازه، با تاریخ بسته‌بندی روشن</li>
        <li class="mb-1">🧺 بسته‌بندی بهداشتی و دربسته، مناسب نگهداری طولانی</li>
        <li class="mb-1">📚 مقاله‌ها و راهنماهای ساده برای انتخاب و مصرف درست گیاهان</li>
        <li class="mb-1">🚚 ارسال به سراسر ایران</li>
        <li class="mb-1">💬 پاسخ‌گویی و مشاوره پیش از خرید</li>
    </ul>

    <h2 class="mt-3 mb-2">یک یادآوری مهم</h2>
    <p>
        گیاهان دارویی هم مثل هر ماده مؤثر دیگری، مقدار و روش مصرف درست دارند. مطالب این سایت فقط برای آگاهی است و جای تشخیص و درمان پزشک را نمی‌گیرد.
        اگر باردار هستید، شیر می‌دهید، بیماری دارید یا دارو مصرف می‌کنید، پیش از مصرف با پزشک مشورت کنید.
    </p>

    <p class="mt-3">
        <a href="{{ route('shop') }}" class="btn btn-primary">مشاهده محصولات</a>
        <a href="{{ route('contact') }}" class="btn btn-outline">تماس با ما</a>
    </p>
</div>
@endsection
