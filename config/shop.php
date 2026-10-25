<?php

/*
|--------------------------------------------------------------------------
| Shop identity (demo values — replace with the real ones later)
|--------------------------------------------------------------------------
*/

return [

    'name' => env('SHOP_NAME', 'عطاری لوز'),
    'tagline' => env('SHOP_TAGLINE', 'گیاهان دارویی، ادویه و دمنوش طبیعی'),

    'phone' => env('SHOP_PHONE', '021-00000000'),
    'mobile' => env('SHOP_MOBILE', '09120000000'),
    'email' => env('SHOP_EMAIL', 'info@lowz.ir'),
    'address' => env('SHOP_ADDRESS', 'تهران، خیابان نمونه، کوچه آزمایشی، پلاک ۰ (نشانی نمایشی)'),
    'hours' => 'شنبه تا پنجشنبه، ۹ صبح تا ۹ شب',

    'social' => [
        'instagram' => env('SHOP_INSTAGRAM', 'https://instagram.com/'),
        'telegram' => env('SHOP_TELEGRAM', 'https://t.me/'),
        'whatsapp' => env('SHOP_WHATSAPP', 'https://wa.me/989120000000'),
    ],

    // Payment is a placeholder until a real gateway is connected.
    'payment_gateway' => env('PAYMENT_GATEWAY', 'demo'),

    // "Under construction": visiting /preview/{token} gives a browser a cookie that shows the real site.
    'preview_token' => env('UNDER_CONSTRUCTION_TOKEN'),

];
