<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\PageSeo;
use App\Models\Product;
use App\Models\ProductCategory;
use Illuminate\View\View;

class HomeController extends Controller
{
    public function index(): View
    {
        $seo = PageSeo::for('home');

        return view('home', [
            'title' => $seo->title,
            'meta_description' => $seo->meta_description,
            'categories' => ProductCategory::query()->orderBy('sort_order')->orderBy('id')->get(),
            'products' => Product::query()
                ->with('category')
                ->where('is_active', true)
                ->orderBy('sort_order')
                ->orderBy('id')
                ->take(8)
                ->get(),
            'articles' => Article::query()
                ->with('category')
                ->where('is_published', true)
                ->orderByDesc('published_at')
                ->orderByDesc('id')
                ->take(3)
                ->get(),
        ]);
    }
}
