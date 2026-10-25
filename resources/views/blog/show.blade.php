@extends('layouts.app')

@php
    $publishedAt = $article->published_at ?? $article->created_at;
    $metaDescription = $article->seoDescription();
    $keywords = $article->keywordList();
    $url = route('blog.show', $article);
    // SVG placeholders are not valid share/rich-result images.
    $imageUrl = $article->image && ! str_ends_with($article->image, '.svg') ? asset($article->image) : null;
    $imageSize = $imageUrl && is_file(public_path($article->image)) ? @getimagesize(public_path($article->image)) : null;
    $crumbs = array_filter([
        ['name' => 'خانه', 'item' => route('home')],
        ['name' => 'مقالات', 'item' => route('blog')],
        $article->category ? ['name' => $article->category->name, 'item' => route('blog.category', $article->category)] : null,
        ['name' => $article->title, 'item' => $url],
    ]);
@endphp

{{-- Article pages carry only the article's own subject: no shop name in title/meta (by request). --}}
@section('title', $article->seoTitle())
@section('meta_description', $metaDescription)
@if ($keywords)
    @section('keywords', implode('، ', $keywords))
@endif
@section('canonical', $url)
@section('og_type', 'article')
@if ($imageUrl)
    @section('og_image_url', $imageUrl)
    @section('og_image_alt', $article->imageAlt())
@endif

@section('meta_extra')
    @if ($imageSize)
    <meta property="og:image:width" content="{{ $imageSize[0] }}">
    <meta property="og:image:height" content="{{ $imageSize[1] }}">
    <meta property="og:image:type" content="{{ $imageSize['mime'] }}">
    @endif
    <meta property="article:published_time" content="{{ $publishedAt->toIso8601String() }}">
    <meta property="article:modified_time" content="{{ $article->updated_at->toIso8601String() }}">
    @foreach ($keywords as $keyword)
    <meta property="article:tag" content="{{ $keyword }}">
    @endforeach
@endsection

@section('jsonld')
<script type="application/ld+json">
{!! json_encode(array_filter([
    '@@context' => 'https://schema.org',
    '@type' => 'BlogPosting',
    'headline' => \Illuminate\Support\Str::limit($article->title, 110, ''),
    'description' => $metaDescription,
    'keywords' => $keywords ? implode('، ', $keywords) : null,
    'inLanguage' => 'fa-IR',
    'wordCount' => \App\Services\AiArticleGenerator::wordCount($article->body),
    'image' => $imageUrl ? [array_filter([
        '@type' => 'ImageObject',
        'url' => $imageUrl,
        'width' => $imageSize[0] ?? null,
        'height' => $imageSize[1] ?? null,
        'caption' => $article->imageAlt(),
    ])] : null,
    'datePublished' => $publishedAt->toIso8601String(),
    'dateModified' => $article->updated_at->toIso8601String(),
    'author' => [
        '@type' => 'Organization',
        'name' => config('shop.name'),
        'url' => url('/'),
    ],
    'publisher' => [
        '@type' => 'Organization',
        'name' => config('shop.name'),
        'logo' => [
            '@type' => 'ImageObject',
            'url' => asset('web-app-manifest-512x512.png'),
        ],
    ],
    'mainEntityOfPage' => [
        '@type' => 'WebPage',
        '@id' => $url,
    ],
]), JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES) !!}
</script>
<script type="application/ld+json">
{!! json_encode([
    '@@context' => 'https://schema.org',
    '@type' => 'BreadcrumbList',
    'itemListElement' => collect($crumbs)->values()->map(fn ($crumb, $i) => ['@type' => 'ListItem', 'position' => $i + 1] + $crumb)->all(),
], JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES) !!}
</script>
@endsection

@section('content')
<div class="page-section">
    <nav class="breadcrumb" aria-label="مسیر صفحه">
        <a href="{{ route('home') }}">خانه</a>
        <span class="breadcrumb-sep">/</span>
        <a href="{{ route('blog') }}">مقالات</a>
        <span class="breadcrumb-sep">/</span>
        @if ($article->category)
            <a href="{{ route('blog.category', $article->category) }}">{{ $article->category->name }}</a>
            <span class="breadcrumb-sep">/</span>
        @endif
        <span>{{ $article->title }}</span>
    </nav>

    <article class="article-single">
        <header class="article-single-header">
            <h1>{{ $article->title }}</h1>
            <div class="article-meta-row">
                @if ($article->category)
                    <a href="{{ route('blog.category', $article->category) }}" class="tag">{{ $article->category->name }}</a>
                @endif
                <time datetime="{{ $publishedAt->toIso8601String() }}" class="article-single-date">
                    {{ fa_number(\Morilog\Jalali\Jalalian::fromCarbon($publishedAt)->format('%d %B %Y')) }}
                </time>
            </div>
        </header>

        @if ($article->image)
            <div class="article-single-hero">
                <img src="{{ asset($article->image) }}" alt="{{ $article->imageAlt() }}" fetchpriority="high" decoding="async"@if ($imageSize) width="{{ $imageSize[0] }}" height="{{ $imageSize[1] }}"@endif>
            </div>
        @endif

        <div class="article-single-body">
            {!! \App\Services\HtmlSanitizer::article($article->body) !!}
        </div>

        @if ($readMore->count())
            <aside class="read-more" aria-label="دیگر بخوانید">
                <strong class="read-more-title">دیگر بخوانید:</strong>
                <ul>
                    @foreach ($readMore as $item)
                        <li><a href="{{ route('blog.show', $item) }}">{{ $item->title }}</a></li>
                    @endforeach
                </ul>
            </aside>
        @endif

        <div class="article-single-back">
            <a href="{{ route('blog') }}" class="btn btn-outline">← بازگشت به مقالات</a>
        </div>
    </article>

    @if ($related->count())
        <section class="article-related">
            <h2>مقالات مرتبط</h2>
            <div class="article-grid">
                @foreach ($related as $item)
                    <article class="article-card">
                        <a href="{{ route('blog.show', $item) }}" class="article-card-image">
                            @if ($item->image)
                                <img src="{{ asset($item->image) }}" alt="{{ $item->imageAlt() }}" loading="lazy">
                            @else
                                <div class="article-placeholder">
                                    <span>🌿 {{ config('shop.name') }}</span>
                                </div>
                            @endif
                        </a>
                        <div class="article-card-body">
                            <h3><a href="{{ route('blog.show', $item) }}">{{ $item->title }}</a></h3>
                            <p>{{ $item->excerpt ?? \Illuminate\Support\Str::limit(strip_tags($item->body), 100) }}</p>
                            <div class="article-card-footer">
                                <time datetime="{{ ($item->published_at ?? $item->created_at)->toIso8601String() }}">
                                    {{ fa_number(\Morilog\Jalali\Jalalian::fromCarbon($item->published_at ?? $item->created_at)->format('%d %B %Y')) }}
                                </time>
                            </div>
                        </div>
                    </article>
                @endforeach
            </div>
        </section>
    @endif
</div>
@endsection
