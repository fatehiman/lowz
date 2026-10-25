@extends('layouts.app')

@php
    // Product names may contain line breaks from the DB; keep meta/JSON-LD on one line.
    $name = \Illuminate\Support\Str::squish($product->name);
    $short = \Illuminate\Support\Str::squish(strip_tags($product->short_description ?: $product->description ?: ''));
    $imageUrl = asset($product->image);
    $url = route('product.show', $product);
    // The meta description starts with the first sentence of the description
    // (short_description is only a few words), then price and minimum order.
    $lead = preg_match('/^(.+?[.!؟?])(\s|$)/u', \Illuminate\Support\Str::squish($product->description ?? ''), $m) ? $m[1] : $short;
    $metaDescription = \Illuminate\Support\Str::limit(
        trim(($lead ? rtrim($lead, '.').'. ' : '').'قیمت '.($product->unit ? $product->unit.' ' : '').fa_price($product->price).'.'),
        160
    );
    $imageSize = @getimagesize(public_path($product->image)) ?: [480, 480];
    // 4.5 -> ۴٫۵ (fa_number() takes string|int, a float would be cut to 4).
    $ratingText = $ratingAverage !== null ? str_replace('.', '٫', fa_number((string) $ratingAverage)) : '';
    $paragraphs = preg_split('/\R\s*\R/u', trim($product->description ?? ''), -1, PREG_SPLIT_NO_EMPTY);
@endphp

@section('title', 'قیمت و خرید '.$name.' — '.config('shop.name'))
@section('meta_description', $metaDescription)
@section('canonical', $url)
@section('og_type', 'product')
@section('og_image_url', $imageUrl)
@section('og_image_alt', $name)

@section('meta_extra')
    {{-- Toman is not an ISO 4217 currency; IRR = Toman x 10. --}}
    <meta property="og:image:width" content="{{ $imageSize[0] }}">
    <meta property="og:image:height" content="{{ $imageSize[1] }}">
    <meta property="product:price:amount" content="{{ $product->price * 10 }}">
    <meta property="product:price:currency" content="IRR">
    <meta property="product:availability" content="{{ $product->is_active ? 'in stock' : 'out of stock' }}">
    <meta property="product:condition" content="new">
    <meta property="product:brand" content="{{ config('shop.name') }}">
@endsection

@section('jsonld')
    @parent
    <script type="application/ld+json">
    {!! json_encode([
        '@@context' => 'https://schema.org',
        '@type' => 'Product',
        'name' => $name,
        'description' => \Illuminate\Support\Str::squish(strip_tags($product->description ?: $product->short_description ?: $name)),
        'image' => [$imageUrl],
        ...\App\Services\ProductSchema::identifiers($product),
        'url' => $url,
        'offers' => \App\Services\ProductSchema::offer($product),
        ...\App\Services\ProductSchema::rating($comments, $ratingCount, $ratingAverage),
    ], JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES) !!}
    </script>
    <script type="application/ld+json">
    {!! json_encode([
        '@@context' => 'https://schema.org',
        '@type' => 'BreadcrumbList',
        'itemListElement' => [
            ['@type' => 'ListItem', 'position' => 1, 'name' => 'خانه', 'item' => route('home')],
            ['@type' => 'ListItem', 'position' => 2, 'name' => 'فروشگاه', 'item' => route('shop')],
            ...($product->category ? [['@type' => 'ListItem', 'position' => 3, 'name' => $product->category->name, 'item' => route('category.show', $product->category)]] : []),
            ['@type' => 'ListItem', 'position' => $product->category ? 4 : 3, 'name' => $name, 'item' => $url],
        ],
    ], JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES) !!}
    </script>
@endsection

@section('content')
<div class="page-section">
    <nav class="breadcrumb" aria-label="مسیر صفحه">
        <a href="{{ route('home') }}">خانه</a>
        <span class="breadcrumb-sep">/</span>
        <a href="{{ route('shop') }}">فروشگاه</a>
        <span class="breadcrumb-sep">/</span>
        @if ($product->category)
            <a href="{{ route('category.show', $product->category) }}">{{ $product->category->name }}</a>
            <span class="breadcrumb-sep">/</span>
        @endif
        <span class="breadcrumb-current">{{ $product->name }}</span>
    </nav>

    <div class="product-detail product-card" data-product-id="{{ $product->id }}" data-product-name="{{ $product->name }}" data-product-price="{{ $product->price }}" data-min-quantity="{{ $product->min_quantity }}" data-quantity-step="{{ $product->quantity_step }}" data-product-image="{{ asset($product->image) }}">
        <div class="product-detail-image">
            <img src="{{ asset($product->image) }}" alt="{{ $name }}" fetchpriority="high" decoding="async" width="{{ $imageSize[0] }}" height="{{ $imageSize[1] }}">
        </div>

        <div class="product-detail-body">
            <h1 class="product-detail-title">{{ $product->name }}</h1>

            @if ($ratingCount)
                <a href="#comments" class="rating-summary" aria-label="امتیاز {{ $ratingText }} از ۵، {{ fa_number($ratingCount) }} نظر">
                    <span class="stars" style="--rating: {{ $ratingAverage }}" aria-hidden="true"></span>
                    <span>{{ $ratingText }} از ۵ ({{ fa_number($ratingCount) }} نظر)</span>
                </a>
            @endif

            @if ($product->short_description)
                <p class="product-detail-short">{{ $product->short_description }}</p>
            @endif

            <div class="product-detail-price">
                {{ fa_price($product->price) }}
                @if ($product->unit)
                    <span class="product-unit">/ {{ $product->unit }}</span>
                @endif
            </div>

            <div class="product-card-footer">
                <div class="cart-controls" id="cart-controls-{{ $product->id }}">
                    <button type="button" class="btn btn-primary cart-add" data-product-id="{{ $product->id }}">افزودن به سبد</button>
                    <div class="cart-quantity" style="display:none;">
                        <button type="button" class="btn btn-outline cart-decrease" data-product-id="{{ $product->id }}">-</button>
                        <span class="cart-quantity-value">{{ $product->min_quantity }}</span>
                        <button type="button" class="btn btn-outline cart-increase" data-product-id="{{ $product->id }}">+</button>
                    </div>
                </div>
            </div>

            @if ($product->description)
                <div class="product-detail-description">
                    <h2>توضیحات محصول</h2>
                    @foreach ($paragraphs as $paragraph)
                        <p>{!! nl2br(e($paragraph)) !!}</p>
                    @endforeach
                    <p class="demo-note">این توضیحات فقط برای آگاهی است و جای مشاوره با پزشک را نمی‌گیرد. در بارداری، شیردهی، بیماری یا مصرف دارو، پیش از مصرف گیاهان دارویی با پزشک مشورت کنید.</p>
                </div>
            @endif
        </div>
    </div>

    @if ($related->count())
        <section class="section">
            <div class="section-head">
                <h2>محصولات مشابه</h2>
                @if ($product->category)
                    <a href="{{ route('category.show', $product->category) }}">همه {{ $product->category->name }} ←</a>
                @endif
            </div>
            <div class="product-grid">
                @foreach ($related as $item)
                    @include('partials.product-card', ['product' => $item])
                @endforeach
            </div>
        </section>
    @endif

    <section class="product-comments" id="comments">
        <h2>نظرات خریداران</h2>

        @if ($comments->isEmpty())
            <p class="comments-empty">هنوز نظری برای این محصول ثبت نشده است. اولین نفری باشید که نظر می‌دهد.</p>
        @else
            <ul class="comment-list">
                @foreach ($comments as $comment)
                    <li class="comment-item">
                        <div class="comment-head">
                            <strong>{{ $comment->name }}</strong>
                            <span class="stars" style="--rating: {{ $comment->rating }}" role="img" aria-label="{{ fa_number($comment->rating) }} از ۵ ستاره"></span>
                            <time datetime="{{ $comment->created_at->toDateString() }}">{{ fa_number(\Morilog\Jalali\Jalalian::fromCarbon($comment->created_at)->format('%d %B %Y')) }}</time>
                        </div>
                        <p>{!! nl2br(e($comment->body)) !!}</p>
                    </li>
                @endforeach
            </ul>
        @endif

        <div class="comment-form-card">
            <h3>نظر خود را بنویسید</h3>

            @if (session('comment_success'))
                <div class="alert alert-success">نظر شما ثبت شد و پس از بررسی نمایش داده می‌شود. ممنون از شما!</div>
            @endif

            <form method="POST" action="{{ route('product.comment', $product) }}" class="app-form">
                @csrf
                {{-- Honeypot: hidden from people, bots fill it. --}}
                <div class="hp-field" aria-hidden="true">
                    <label for="website">Website</label>
                    <input type="text" id="website" name="website" tabindex="-1" autocomplete="off">
                </div>

                <div class="form-group">
                    <span class="form-label" id="rating-label">امتیاز شما</span>
                    <div class="star-input" role="radiogroup" aria-labelledby="rating-label">
                        @for ($i = 5; $i >= 1; $i--)
                            <input type="radio" id="rating-{{ $i }}" name="rating" value="{{ $i }}" @checked((int) old('rating') === $i) @if ($i === 5) required @endif>
                            <label for="rating-{{ $i }}" title="{{ fa_number($i) }} ستاره">★</label>
                        @endfor
                    </div>
                    @error('rating') <span class="field-error">{{ $message }}</span> @enderror
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label for="comment-name">نام</label>
                        <input type="text" id="comment-name" name="name" value="{{ old('name') }}" maxlength="100" required>
                        @error('name') <span class="field-error">{{ $message }}</span> @enderror
                    </div>

                    <div class="form-group">
                        <label for="comment-email">ایمیل <small>(نمایش داده نمی‌شود)</small></label>
                        <input type="email" id="comment-email" name="email" value="{{ old('email') }}" maxlength="255" dir="ltr" required>
                        @error('email') <span class="field-error">{{ $message }}</span> @enderror
                    </div>
                </div>

                <div class="form-group">
                    <label for="comment-body">نظر شما</label>
                    <textarea id="comment-body" name="body" rows="4" maxlength="2000" required>{{ old('body') }}</textarea>
                    @error('body') <span class="field-error">{{ $message }}</span> @enderror
                </div>

                <div class="form-group">
                    <label for="comment-captcha">عددهای داخل تصویر را وارد کنید</label>
                    <div class="captcha-row">
                        <img src="{{ route('comment.captcha') }}" alt="کد امنیتی" class="captcha-image" id="commentCaptchaImage" width="160" height="60" loading="lazy">
                        <button type="button" class="btn btn-outline captcha-refresh" id="commentCaptchaRefresh" aria-label="کد جدید">↻</button>
                    </div>
                    <input type="text" id="comment-captcha" name="captcha" required autocomplete="off" inputmode="numeric" maxlength="10" dir="ltr">
                    @error('captcha') <span class="field-error">{{ $message }}</span> @enderror
                </div>

                <button type="submit" class="btn btn-primary">ثبت نظر</button>
            </form>
        </div>
    </section>
</div>

<script>
(function () {
    const img = document.getElementById('commentCaptchaImage');
    const btn = document.getElementById('commentCaptchaRefresh');
    if (img && btn) {
        btn.addEventListener('click', function () {
            img.src = img.src.split('?')[0] + '?t=' + Date.now();
        });
    }
})();
</script>
@endsection
