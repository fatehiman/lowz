<?php

if (! function_exists('fa_number')) {
    /**
     * Convert English digits to Persian digits.
     */
    function fa_number(string|int $value): string
    {
        $value = (string) $value;

        $persian = ['۰', '۱', '۲', '۳', '۴', '۵', '۶', '۷', '۸', '۹'];

        return str_replace(['0','1','2','3','4','5','6','7','8','9'], $persian, $value);
    }
}

if (! function_exists('fa_price')) {
    /**
     * Format an integer amount as Persian price with تومان suffix.
     */
    function fa_price(int $amount): string
    {
        return fa_number(number_format($amount)) . ' تومان';
    }
}

if (! function_exists('fa_currency')) {
    /**
     * Alias for fa_price (integer تومان, no decimals).
     */
    function fa_currency(int $amount): string
    {
        return fa_price($amount);
    }
}

if (! function_exists('versioned_asset')) {
    /**
     * asset() with a ?v=<mtime> cache-busting query string, so a CDN/browser
     * cache from before a deploy can never serve a stale app.js/app.css.
     */
    function versioned_asset(string $path): string
    {
        $fullPath = public_path($path);
        $version = is_file($fullPath) ? filemtime($fullPath) : time();

        return asset($path) . '?v=' . $version;
    }
}

if (! function_exists('visitor_ip')) {
    /**
     * The visitor's real IP. Apache on ger1 has no mod_remoteip, so behind
     * Cloudflare $request->ip() is the Cloudflare edge; Cloudflare sends the
     * real one in CF-Connecting-IP. Only used for rate limits and logs.
     */
    function visitor_ip(?\Illuminate\Http\Request $request = null): string
    {
        $request ??= request();
        $ip = (string) $request->header('CF-Connecting-IP');

        return filter_var($ip, FILTER_VALIDATE_IP) ? $ip : (string) $request->ip();
    }
}
