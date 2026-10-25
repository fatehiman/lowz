<header class="site-header">
    <div class="container header-inner">
        <a href="{{ route('home') }}" class="logo" aria-label="{{ config('shop.name') }}">
            <img src="{{ versioned_asset('images/logo.svg') }}" alt="{{ config('shop.name') }}" width="44" height="44">
            <span class="logo-text">
                <strong>{{ config('shop.name') }}</strong>
                <small>{{ config('shop.tagline') }}</small>
            </span>
        </a>

        <button class="hamburger" id="hamburger" aria-label="منو" aria-expanded="false">
            <span></span>
            <span></span>
            <span></span>
        </button>

        <nav class="main-nav" id="mainNav">
            <ul>
                <li><a href="{{ route('home') }}" @class(['active' => request()->routeIs('home')])>خانه</a></li>
                <li><a href="{{ route('shop') }}" @class(['active' => request()->routeIs('shop', 'category.show', 'product.show')])>فروشگاه</a></li>
                <li><a href="{{ route('blog') }}" @class(['active' => request()->routeIs('blog', 'blog.*')])>مقالات</a></li>
                <li><a href="{{ route('about') }}" @class(['active' => request()->routeIs('about')])>درباره ما</a></li>
                <li><a href="{{ route('contact') }}" @class(['active' => request()->routeIs('contact')])>تماس با ما</a></li>
            </ul>
        </nav>

        <a href="{{ route('cart') }}" class="basket-link" aria-label="سبد خرید">
            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <circle cx="9" cy="21" r="1"></circle>
                <circle cx="20" cy="21" r="1"></circle>
                <path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"></path>
            </svg>
            <span class="basket-price" id="basketPrice"></span>
            <span class="badge" id="basketCount">0</span>
        </a>
    </div>
</header>
