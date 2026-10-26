<footer class="site-footer">
    <div class="container">
        <nav class="footer-nav">
            <a href="{{ route('shop') }}">فروشگاه</a>
            <a href="{{ route('blog') }}">مقالات</a>
            <a href="{{ route('about') }}">درباره ما</a>
            <a href="{{ route('contact') }}">تماس با ما</a>
            <a href="{{ route('rules') }}">قوانین و حریم خصوصی</a>
        </nav>

        <div class="footer-contact">
            <span>📍 {{ config('shop.address') }}</span>
            @if (config('shop.phone'))
                <span>☎ <a href="tel:{{ preg_replace('/[^\d+]/', '', config('shop.phone')) }}" dir="ltr">{{ fa_number(config('shop.phone')) }}</a></span>
            @endif
            <span>🕘 {{ config('shop.hours') }}</span>
        </div>

        <p class="footer-brand">{{ config('shop.name') }} — {{ config('shop.tagline') }}</p>
        <p class="footer-copy">&copy; {{ fa_number(\Morilog\Jalali\Jalalian::now()->getYear()) }} {{ config('shop.name') }}. تمامی حقوق محفوظ است.</p>

        @if (array_filter(config('shop.social')))
        <div class="footer-social">
            <a href="{{ config('shop.social.instagram') }}" target="_blank" rel="noopener noreferrer" aria-label="اینستاگرام {{ config('shop.name') }}" class="social-icon social-instagram">
                <svg viewBox="0 0 48 48" xmlns="http://www.w3.org/2000/svg">
                    <defs>
                        <radialGradient id="igGrad" cx="30%" cy="107%" r="150%">
                            <stop offset="0%" stop-color="#fdf497"/>
                            <stop offset="10%" stop-color="#fdf497"/>
                            <stop offset="45%" stop-color="#fd5949"/>
                            <stop offset="60%" stop-color="#d6249f"/>
                            <stop offset="90%" stop-color="#285AEB"/>
                        </radialGradient>
                    </defs>
                    <rect x="2" y="2" width="44" height="44" rx="12" fill="url(#igGrad)"/>
                    <rect x="13" y="13" width="22" height="22" rx="7" fill="none" stroke="#fff" stroke-width="2.5"/>
                    <circle cx="24" cy="24" r="6" fill="none" stroke="#fff" stroke-width="2.5"/>
                    <circle cx="32.5" cy="15.5" r="1.8" fill="#fff"/>
                </svg>
            </a>
            <a href="{{ config('shop.social.telegram') }}" target="_blank" rel="noopener noreferrer" aria-label="تلگرام {{ config('shop.name') }}" class="social-icon social-telegram">
                <svg viewBox="0 0 48 48" xmlns="http://www.w3.org/2000/svg">
                    <circle cx="24" cy="24" r="22" fill="#29A9EA"/>
                    <path d="M34.9 14.5 30.9 34c-.3 1.3-1.1 1.6-2.2 1l-6.1-4.5-2.9 2.8c-.3.3-.6.6-1.2.6l.4-6.2 11.3-10.2c.5-.4-.1-.7-.8-.3L15 24.2l-6-1.9c-1.3-.4-1.3-1.3.3-1.9l23.5-9.1c1.1-.4 2 .3 1.600 2.2Z" fill="#fff"/>
                </svg>
            </a>
            <a href="{{ config('shop.social.whatsapp') }}" target="_blank" rel="noopener noreferrer" aria-label="واتساپ {{ config('shop.name') }}" class="social-icon social-whatsapp">
                <svg viewBox="0 0 48 48" xmlns="http://www.w3.org/2000/svg">
                    <circle cx="24" cy="24" r="22" fill="#25D366"/>
                    <path d="M32.6 15.3a11.6 11.6 0 0 0-18.4 14L13 34.9l5.8-1.5a11.6 11.6 0 0 0 13.8-18Z" fill="#fff"/>
                    <path d="M24.1 12.9a10.9 10.9 0 0 0-9.3 16.6l.2.3-1 3.7 3.8-1 .3.2a10.9 10.9 0 1 0 6-19.8Zm6.4 15.6c-.3.8-1.5 1.4-2.4 1.6-.6.1-1.4.2-4.1-.9-3.5-1.4-5.7-5-5.9-5.2-.2-.2-1.4-1.9-1.4-3.600 0-1.7.9-2.600 1.2-2.900.3-.3.7-.4 1-.4h.7c.2 0 .5-.1.8.6.3.8 1.1 2.600 1.2 2.800.1.2.2.4 0 .7-.1.2-.2.4-.4.6l-.6.7c-.2.2-.4.4-.2.8.2.4 1 1.6 2.1 2.6 1.4 1.3 2.6 1.7 3 1.9.4.2.6.2.8-.1.2-.3.9-1.1 1.2-1.4.3-.3.5-.3.9-.2l2.5 1.2c.3.1.5.2.6.3.1.3.1.9-.2 1.7Z" fill="#25D366"/>
                </svg>
            </a>
        </div>
        @endif
    </div>
</footer>
