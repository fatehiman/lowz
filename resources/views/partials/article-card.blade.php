<article class="article-card">
    <a href="{{ route('blog.show', $article) }}" class="article-card-image">
        @if ($article->image)
            <img src="{{ asset($article->image) }}" alt="{{ $article->imageAlt() }}" loading="lazy">
        @else
            <div class="article-placeholder">
                <span>🌿 {{ config('shop.name') }}</span>
            </div>
        @endif
    </a>
    <div class="article-card-body">
        @if ($article->category)
            <a href="{{ route('blog.category', $article->category) }}" class="tag">{{ $article->category->name }}</a>
        @endif
        <h2><a href="{{ route('blog.show', $article) }}">{{ $article->title }}</a></h2>
        <p>{{ $article->excerpt ?? \Illuminate\Support\Str::limit(strip_tags($article->body), 140) }}</p>
        <div class="article-card-footer">
            <time datetime="{{ ($article->published_at ?? $article->created_at)->toIso8601String() }}">
                {{ fa_number(\Morilog\Jalali\Jalalian::fromCarbon($article->published_at ?? $article->created_at)->format('%d %B %Y')) }}
            </time>
            <a href="{{ route('blog.show', $article) }}" class="article-read-more">ادامه مطلب ←</a>
        </div>
    </div>
</article>
