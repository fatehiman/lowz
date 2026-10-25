@extends('layouts.app')

@section('title', $title)
@section('meta_description', $meta_description)
@section('canonical', route('home'))

@section('jsonld')
    @parent
    <script type="application/ld+json">
    {!! json_encode([
        '@@context' => 'https://schema.org',
        '@type' => 'ItemList',
        'itemListElement' => $products->values()->map(function ($product, $index) {
            return [
                '@type' => 'ListItem',
                'position' => $index + 1,
                'url' => route('product.show', $product),
                'item' => [
                    '@type' => 'Product',
                    'name' => \Illuminate\Support\Str::squish($product->name),
                    'description' => \Illuminate\Support\Str::squish(strip_tags($product->short_description ?: $product->name)),
                    'image' => asset($product->image),
                    ...\App\Services\ProductSchema::identifiers($product),
                    'url' => route('product.show', $product),
                    'offers' => \App\Services\ProductSchema::offer($product),
                ],
            ];
        })->all(),
    ], JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES) !!}
    </script>
@endsection

@section('content')
<div class="page-section">
    <div class="home-hero text-center">
        <div class="home-hero-content">
            <h1>{{ config('shop.name') }}؛ عطاری آنلاین شما</h1>
            <p>
                زعفران، ادویه‌های تازه، دمنوش‌ها و گیاهان دارویی، گلاب و عرقیات، روغن‌های گیاهی و عسل طبیعی؛
                همه با بسته‌بندی بهداشتی و ارسال به سراسر ایران.
            </p>
            <a href="{{ route('shop') }}" class="btn btn-primary">مشاهده محصولات</a>
            <a href="{{ route('blog') }}" class="btn btn-outline">مقالات عطاری</a>
        </div>
    </div>

    <section class="section">
        <div class="feature-list">
            <div class="feature-item">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M11 20A7 7 0 0 1 9.8 6.1C15.5 5 17 4.48 19 2c1 2 2 4.18 2 8 0 5.5-4.78 10-10 10Z"/><path d="M2 21c0-3 1.85-5.36 5.08-6C9.5 14.52 12 13 13 12"/></svg>
                <div><strong>طبیعی و تازه</strong><p>گیاهان و ادویه‌های سالم، بدون افزودنی</p></div>
            </div>
            <div class="feature-item">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M14 18V6a2 2 0 0 0-2-2H4a2 2 0 0 0-2 2v11a1 1 0 0 0 1 1h2"/><path d="M15 18H9"/><path d="M19 18h2a1 1 0 0 0 1-1v-3.65a1 1 0 0 0-.22-.62l-3.48-4.35A1 1 0 0 0 17.52 8H14"/><circle cx="17" cy="18" r="2"/><circle cx="7" cy="18" r="2"/></svg>
                <div><strong>ارسال به سراسر کشور</strong><p>بسته‌بندی محکم و بهداشتی</p></div>
            </div>
            <div class="feature-item">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><rect x="2" y="5" width="20" height="14" rx="2"/><path d="M2 10h20"/></svg>
                <div><strong>پرداخت امن</strong><p>پرداخت اینترنتی از طریق درگاه بانکی</p></div>
            </div>
            <div class="feature-item">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"/></svg>
                <div><strong>مشاوره رایگان</strong><p>راهنمایی برای انتخاب دمنوش و گیاه</p></div>
            </div>
        </div>
    </section>

    @if ($categories->count())
        <section class="section">
            <div class="section-head">
                <h2>دسته‌بندی محصولات</h2>
                <a href="{{ route('shop') }}">همه محصولات ←</a>
            </div>
            <div class="category-grid">
                @foreach ($categories as $category)
                    <a href="{{ route('category.show', $category) }}" class="category-card">
                        @if ($category->image)
                            <img src="{{ asset($category->image) }}" alt="{{ $category->name }}" loading="lazy" width="400" height="300">
                        @endif
                        <span>{{ $category->name }}</span>
                    </a>
                @endforeach
            </div>
        </section>
    @endif

    <section class="section">
        <div class="section-head">
            <h2>محصولات پرفروش</h2>
            <a href="{{ route('shop') }}">مشاهده همه ←</a>
        </div>
        @if ($products->count())
            <div class="product-grid">
                @foreach ($products as $product)
                    @include('partials.product-card', ['product' => $product])
                @endforeach
            </div>
        @else
            <p class="text-center">هنوز محصولی اضافه نشده است.</p>
        @endif
    </section>

    @if ($articles->count())
        <section class="section">
            <div class="section-head">
                <h2>تازه‌ترین مقالات</h2>
                <a href="{{ route('blog') }}">همه مقالات ←</a>
            </div>
            <div class="article-grid">
                @foreach ($articles as $article)
                    @include('partials.article-card', ['article' => $article])
                @endforeach
            </div>
        </section>
    @endif
</div>
@endsection
