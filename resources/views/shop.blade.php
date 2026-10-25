@extends('layouts.app')

@section('title', $title)
@section('meta_description', $meta_description)
{{-- Each page of the list is its own canonical URL (Google's advice for pagination). --}}
@section('canonical', $products->currentPage() > 1 ? $products->url($products->currentPage()) : ($category ? route('category.show', $category) : route('shop')))
@if ($category && $category->image)
    @section('og_image_url', asset($category->image))
@endif

@section('jsonld')
    @parent
    <script type="application/ld+json">
    {!! json_encode([
        '@@context' => 'https://schema.org',
        '@type' => 'BreadcrumbList',
        'itemListElement' => array_values(array_filter([
            ['@type' => 'ListItem', 'position' => 1, 'name' => 'خانه', 'item' => route('home')],
            ['@type' => 'ListItem', 'position' => 2, 'name' => 'فروشگاه', 'item' => route('shop')],
            $category ? ['@type' => 'ListItem', 'position' => 3, 'name' => $category->name, 'item' => route('category.show', $category)] : null,
        ])),
    ], JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES) !!}
    </script>
@endsection

@section('content')
<div class="page-section">
    <nav class="breadcrumb" aria-label="مسیر صفحه">
        <a href="{{ route('home') }}">خانه</a>
        <span class="breadcrumb-sep">/</span>
        @if ($category)
            <a href="{{ route('shop') }}">فروشگاه</a>
            <span class="breadcrumb-sep">/</span>
            <span class="breadcrumb-current">{{ $category->name }}</span>
        @else
            <span class="breadcrumb-current">فروشگاه</span>
        @endif
    </nav>

    <div class="page-intro">
        <h1>{{ $heading }}</h1>
        @if ($intro)
            <p>{{ $intro }}</p>
        @endif
    </div>

    <nav class="category-chips" aria-label="دسته‌بندی‌ها">
        <a href="{{ route('shop') }}" @class(['active' => ! $category])>همه</a>
        @foreach ($categories as $item)
            <a href="{{ route('category.show', $item) }}" @class(['active' => $category && $category->id === $item->id])>{{ $item->name }}</a>
        @endforeach
    </nav>

    @if ($products->count())
        <div class="product-grid">
            @foreach ($products as $product)
                @include('partials.product-card', ['product' => $product])
            @endforeach
        </div>

        <div class="pagination">
            {{ $products->links() }}
        </div>
    @else
        <p class="text-center">در این دسته هنوز محصولی نیست.</p>
    @endif
</div>
@endsection
