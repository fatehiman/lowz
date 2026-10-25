<?php

namespace App\Http\Controllers;

use App\Models\PageSeo;
use App\Models\Product;
use App\Models\ProductCategory;
use Illuminate\View\View;

class ProductController extends Controller
{
    /** All products. */
    public function index(): View
    {
        $seo = PageSeo::for('shop');

        return view('shop', [
            'title' => $seo->title,
            'meta_description' => $seo->meta_description,
            'heading' => 'فروشگاه '.config('shop.name'),
            'intro' => 'همه محصولات عطاری: ادویه، دمنوش و گیاهان دارویی، عرقیات، روغن‌های گیاهی، عسل و دانه‌ها.',
            'category' => null,
            'categories' => ProductCategory::query()->orderBy('sort_order')->get(),
            'products' => Product::query()->with('category')->where('is_active', true)
                ->orderBy('sort_order')->orderBy('id')->paginate(12),
        ]);
    }

    public function category(ProductCategory $category): View
    {
        return view('shop', [
            'title' => 'خرید '.$category->name.' — '.config('shop.name'),
            'meta_description' => $category->description ?: 'خرید '.$category->name.' از '.config('shop.name'),
            'heading' => $category->name,
            'intro' => $category->description,
            'category' => $category,
            'categories' => ProductCategory::query()->orderBy('sort_order')->get(),
            'products' => $category->products()->with('category')->where('is_active', true)
                ->orderBy('sort_order')->orderBy('id')->paginate(12),
        ]);
    }

    public function show(Product $product): View
    {
        abort_unless($product->is_active, 404);

        // Only reviews the admin accepted (comments.is_accepted = 1) are shown.
        $accepted = $product->comments()->accepted();
        $ratingCount = (clone $accepted)->count();
        $ratingAverage = $ratingCount ? round((float) (clone $accepted)->avg('rating'), 1) : null;
        $comments = $accepted->latest()->limit(50)->get();

        $related = Product::query()
            ->where('is_active', true)
            ->where('id', '!=', $product->id)
            ->where('product_category_id', $product->product_category_id)
            ->inRandomOrder()
            ->take(4)
            ->get();

        return view('products.show', compact('product', 'comments', 'ratingCount', 'ratingAverage', 'related'));
    }
}
