@extends('layouts.app')

@section('title', $title)
@section('meta_description', $meta_description)
{{-- Each page of the list is its own canonical URL (Google's advice for pagination). --}}
@section('canonical', $articles->currentPage() > 1 ? $articles->url($articles->currentPage()) : ($category ? route('blog.category', $category) : route('blog')))
@if (! empty($og_image) && ! str_ends_with($og_image, '.svg'))
    @section('og_image_url', asset($og_image))
@endif

@section('jsonld')
<script type="application/ld+json">
{!! json_encode([
    '@@context' => 'https://schema.org',
    '@type' => 'Blog',
    'name' => $heading,
    'description' => $meta_description,
    'url' => $category ? route('blog.category', $category) : route('blog'),
    'blogPost' => $articles->map(function ($article) {
        return [
            '@type' => 'BlogPosting',
            'headline' => $article->title,
            'url' => route('blog.show', $article),
            'image' => $article->image && ! str_ends_with($article->image, '.svg') ? asset($article->image) : null,
            'datePublished' => optional($article->published_at ?? $article->created_at)->toIso8601String(),
        ];
    })->values(),
], JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES) !!}
</script>
@endsection

@section('content')
<div class="page-section">
    <nav class="breadcrumb" aria-label="مسیر صفحه">
        <a href="{{ route('home') }}">خانه</a>
        <span class="breadcrumb-sep">/</span>
        @if ($category)
            <a href="{{ route('blog') }}">مقالات</a>
            <span class="breadcrumb-sep">/</span>
            <span class="breadcrumb-current">{{ $category->name }}</span>
        @else
            <span class="breadcrumb-current">مقالات</span>
        @endif
    </nav>

    <div class="page-intro">
        <h1>{{ $heading }}</h1>
        @if ($intro)
            <p>{{ $intro }}</p>
        @endif
    </div>

    <nav class="category-chips" aria-label="دسته‌بندی مقالات">
        <a href="{{ route('blog') }}" @class(['active' => ! $category])>همه مقالات</a>
        @foreach ($categories as $item)
            <a href="{{ route('blog.category', $item) }}" @class(['active' => $category && $category->id === $item->id])>{{ $item->name }}</a>
        @endforeach
    </nav>

    @if ($articles->count() === 0)
        <p>هنوز مقاله‌ای در این بخش منتشر نشده است.</p>
    @else
        <div class="article-grid">
            @foreach ($articles as $article)
                @include('partials.article-card', ['article' => $article])
            @endforeach
        </div>

        <div class="pagination">
            {{ $articles->links() }}
        </div>
    @endif
</div>
@endsection
