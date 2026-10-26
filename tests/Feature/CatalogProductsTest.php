<?php

namespace Tests\Feature;

use App\Models\Product;
use App\Services\HtmlSanitizer;
use Database\Seeders\CatalogProductSeeder;
use Database\Seeders\ProductSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CatalogProductsTest extends TestCase
{
    use RefreshDatabase;

    public function test_catalog_is_seeded_once_with_images_and_prices(): void
    {
        $this->seed(ProductSeeder::class);
        $this->seed(CatalogProductSeeder::class);
        $this->seed(CatalogProductSeeder::class); // idempotent

        $this->assertSame(16, Product::query()->where('sort_order', '>=', 100)->count());
        $this->assertSame(197500, Product::query()->where('slug', 'laxative-herbal-tablet')->value('price')); // 79000 x 2.5
        $this->assertSame(1750000, Product::query()->where('slug', 'royal-jelly')->value('price')); // 700000 x 2.5

        foreach (Product::query()->where('sort_order', '>=', 100)->get() as $product) {
            $this->assertFileExists(public_path($product->image), $product->slug);
        }
        foreach (['traditional-remedies', 'natural-care'] as $slug) {
            $this->assertFileExists(public_path("images/categories/{$slug}.webp"));
        }
    }

    public function test_new_product_pages_open(): void
    {
        $this->seed(ProductSeeder::class);
        $this->seed(CatalogProductSeeder::class);

        $this->get('/products/royal-jelly')->assertOk()->assertSee('ژل رویال اصلی');
        $this->get('/category/natural-care')->assertOk()->assertSee('شامپو سبغ');
    }

    public function test_demo_products_and_empty_categories_are_hidden(): void
    {
        $this->seed(ProductSeeder::class);
        $this->seed(CatalogProductSeeder::class);

        $this->get('/products/turmeric')->assertNotFound();
        $this->get('/shop')->assertOk()
            ->assertSee('شامپو سبغ')
            ->assertDontSee('/category/honey', false)
            ->assertSee('/category/natural-care', false);
        $this->get('/sitemap.xml')->assertOk()
            ->assertDontSee('/products/turmeric<', false)
            ->assertDontSee('/category/honey', false);
    }

    public function test_article_links_to_hidden_products_become_plain_text(): void
    {
        $this->seed(ProductSeeder::class);
        $this->seed(CatalogProductSeeder::class);

        $html = HtmlSanitizer::article('<p><a href="/products/turmeric">زردچوبه</a> و <a href="/products/royal-jelly">ژل رویال</a></p>');

        $this->assertStringNotContainsString('/products/turmeric', $html);
        $this->assertStringContainsString('زردچوبه', $html);
        $this->assertStringContainsString('/products/royal-jelly', $html);
    }
}
