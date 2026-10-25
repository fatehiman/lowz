<?php

namespace Database\Seeders;

use App\Models\Comment;
use App\Models\Product;
use Illuminate\Database\Seeder;

/**
 * A few accepted demo reviews so the product pages show stars. Only runs
 * while there are no comments at all.
 */
class CommentSeeder extends Seeder
{
    public function run(): void
    {
        if (Comment::query()->exists()) {
            return;
        }

        $reviews = [
            'saffron' => [['مریم', 5, 'عطر و رنگ زعفران عالی بود. بسته‌بندی هم شیشه‌ای و تمیز بود.'], ['حسین', 4, 'کیفیت خوب، فقط کمی دیر رسید.']],
            'borage' => [['زهرا', 5, 'گل‌ها درشت و خوش‌رنگ بودند. با عناب دم کردم و خیلی خوب شد.']],
            'rose-water' => [['فاطمه', 5, 'گلاب واقعاً دو آتشه است، عطرش خیلی قوی است.'], ['علی', 5, 'برای شله‌زرد استفاده کردم، عالی بود.']],
            'cinnamon' => [['نرگس', 4, 'دارچین تازه و خوش‌عطر بود.']],
            'honey' => [['رضا', 5, 'عسل طبیعی و خوش‌طعم، بچه‌ها خیلی دوست داشتند.']],
            'chamomile' => [['سارا', 4, 'دمنوش ملایم و خوبی است، برای شب عالی است.']],
        ];

        foreach ($reviews as $slug => $items) {
            $product = Product::query()->where('slug', $slug)->first();
            if (! $product) {
                continue;
            }

            foreach ($items as $i => [$name, $rating, $body]) {
                Comment::query()->create([
                    'product_id' => $product->id,
                    'name' => $name,
                    'email' => 'demo'.$product->id.$i.'@example.com',
                    'rating' => $rating,
                    'body' => $body,
                    'ip' => '127.0.0.1',
                    'is_accepted' => true,
                ]);
            }
        }
    }
}
