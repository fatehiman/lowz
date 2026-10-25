<?php

namespace App\Http\Controllers;

use App\Http\Middleware\UnderConstruction;
use App\Models\Article;
use App\Models\ArticleCategory;
use App\Models\Product;
use App\Models\ProductCategory;
use Illuminate\Support\Str;
use Symfony\Component\HttpFoundation\Response;

class SitemapController extends Controller
{
    /**
     * Only indexable pages. Cart/checkout/order pages are noindex and are
     * left out on purpose. lastmod is only set where we know a real date —
     * Google ignores lastmod on sites where it is always "now".
     * While the site is under construction the middleware answers 503 instead.
     */
    public function index(): Response
    {
        $products = Product::query()
            ->where('is_active', true)
            ->orderBy('sort_order')
            ->orderBy('id')
            ->get();

        $articles = Article::query()
            ->where('is_published', true)
            ->orderByDesc('published_at')
            ->get();

        $urls = [];

        $urls[] = ['loc' => route('home'), 'lastmod' => $products->max('updated_at')];
        $urls[] = ['loc' => route('shop'), 'lastmod' => $products->max('updated_at')];

        foreach (ProductCategory::query()->orderBy('sort_order')->get() as $category) {
            $urls[] = ['loc' => route('category.show', $category)];
        }

        foreach ($products as $product) {
            $urls[] = [
                'loc' => route('product.show', $product),
                'lastmod' => $product->updated_at,
                'images' => [['loc' => asset($product->image)]],
            ];
        }

        $urls[] = ['loc' => route('blog'), 'lastmod' => $articles->max('updated_at')];

        foreach (ArticleCategory::query()->orderBy('sort_order')->get() as $category) {
            $urls[] = ['loc' => route('blog.category', $category)];
        }

        foreach ($articles as $article) {
            $urls[] = [
                'loc' => route('blog.show', $article),
                'lastmod' => $article->updated_at,
                'images' => $article->image && ! Str::endsWith($article->image, '.svg')
                    ? [['loc' => asset($article->image)]]
                    : [],
            ];
        }

        foreach (['about', 'contact', 'rules'] as $page) {
            $urls[] = ['loc' => route($page)];
        }

        $xml = view('sitemap', compact('urls'))->render();

        return response($xml, 200)->header('Content-Type', 'application/xml; charset=UTF-8');
    }

    public function robots(): Response
    {
        // Under construction: ask every crawler to stay away.
        if (UnderConstruction::enabled()) {
            return response("User-agent: *\nDisallow: /\n", 200)->header('Content-Type', 'text/plain; charset=UTF-8');
        }

        // Machine endpoints only. /cart and /checkout stay crawlable so
        // Google can read their "noindex" tag.
        $lines = [
            'User-agent: *',
            'Disallow: /cart/',
            'Disallow: /checkout/proforma',
            'Disallow: /order/',
            'Disallow: /payment/',
            'Disallow: /preview/',
            'Disallow: /locations/',
            'Disallow: /contact/captcha',
            'Disallow: /comment/captcha',
            'Disallow: /up',
            '',
            'Sitemap: '.route('sitemap'),
        ];

        return response(implode("\n", $lines)."\n", 200)->header('Content-Type', 'text/plain; charset=UTF-8');
    }
}
