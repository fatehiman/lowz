<?php

/*
|--------------------------------------------------------------------------
| Shop identity
|--------------------------------------------------------------------------
*/

return [

    'name' => env('SHOP_NAME', 'عطاری لوز'),
    'tagline' => env('SHOP_TAGLINE', 'گیاهان دارویی، ادویه و دمنوش طبیعی'),

    // Phone numbers stay hidden while empty (footer, contact page, JSON-LD). Set SHOP_PHONE / SHOP_MOBILE to show them.
    'phone' => env('SHOP_PHONE'),
    'mobile' => env('SHOP_MOBILE'),
    'email' => env('SHOP_EMAIL', 'info@lowz.ir'),
    'address' => env('SHOP_ADDRESS', 'تهران، خیابان جمالزاده. بین چهارراه نصرت و بلوار کشاورز - پلاک 386 - واحد 8.'),
    'hours' => 'شنبه تا پنجشنبه، ۹ صبح تا ۹ شب',

    // Empty = hidden everywhere (footer icons show only when a link is set).
    'social' => [
        'instagram' => env('SHOP_INSTAGRAM'),
        'telegram' => env('SHOP_TELEGRAM'),
        'whatsapp' => env('SHOP_WHATSAPP'),
    ],

    // Payment is a placeholder until a real gateway is connected.
    'payment_gateway' => env('PAYMENT_GATEWAY', 'demo'),

    // "Under construction": visiting /preview/{token} gives a browser a cookie that shows the real site.
    'preview_token' => env('UNDER_CONSTRUCTION_TOKEN'),

];
