<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\ArticleCategory;
use Illuminate\Database\Eloquent\Builder;
use App\Models\PageSeo;
use Illuminate\View\View;

class BlogController extends Controller
{
    public function index(): View
    {
        $seo = PageSeo::for('blog.index');

        return view('blog', [
            'title' => $seo->title,
            'meta_description' => $seo->meta_description,
            'og_image' => $seo->og_image,
            'heading' => 'مقالات '.config('shop.name'),
            'intro' => 'دانستنی‌های گیاهان دارویی، ادویه‌ها، دمنوش‌ها و راهنمای خرید و نگهداری محصولات عطاری.',
            'category' => null,
            'categories' => ArticleCategory::query()->orderBy('sort_order')->get(),
            'articles' => $this->published()->paginate(9),
        ]);
    }

    public function category(ArticleCategory $category): View
    {
        return view('blog', [
            'title' => 'مقالات '.$category->name.' — '.config('shop.name'),
            'meta_description' => $category->description ?: 'مقالات '.$category->name,
            'og_image' => null,
            'heading' => $category->name,
            'intro' => $category->description,
            'category' => $category,
            'categories' => ArticleCategory::query()->orderBy('sort_order')->get(),
            'articles' => $this->published()->where('article_category_id', $category->id)->paginate(9),
        ]);
    }

    private function published(): Builder
    {
        return Article::query()
            ->with('category')
            ->where('is_published', true)
            ->orderByDesc('published_at')
            ->orderByDesc('id');
    }

    public function show(Article $article): View
    {
        abort_unless($article->is_published, 404);

        $others = Article::query()
            ->where('is_published', true)
            ->where('id', '!=', $article->id)
            ->orderByDesc('published_at')
            ->orderByDesc('id')
            ->take(60)
            ->get();

        // "دیگر بخوانید" box: the articles that share the most keyword words
        // with this one, topped up with the newest ones.
        $words = $this->topicWords($article);
        $readMore = $others
            ->map(fn (Article $other) => [$other, count(array_intersect($words, $this->topicWords($other)))])
            ->filter(fn ($pair) => $pair[1] > 0)
            ->sortByDesc(fn ($pair) => $pair[1])
            ->map(fn ($pair) => $pair[0])
            ->take(3)
            ->values();
        $readMore = $readMore->merge($others->diff($readMore)->take(3 - $readMore->count()));

        $related = $others->diff($readMore)->take(3);

        return view('blog.show', [
            'article' => $article,
            'readMore' => $readMore,
            'related' => $related,
        ]);
    }

    /** @return string[] meaningful words of an article's keywords and title */
    private function topicWords(Article $article): array
    {
        static $stop = ['در', 'با', 'از', 'به', 'برای', 'که', 'این', 'آن', 'را', 'یا', 'تا', 'چه', 'چرا', 'چگونه', 'های', 'ها', 'است', 'کنیم', 'راهنمای', 'نکات', 'ایده', 'ایده‌های'];

        $text = str_replace(['،', ',', '؛', ':', '؟', '?', '(', ')'], ' ', $article->keywords.' '.$article->title);
        $words = preg_split('/\s+/u', mb_strtolower($text), -1, PREG_SPLIT_NO_EMPTY);

        return array_values(array_unique(array_filter($words, fn ($w) => mb_strlen($w) > 2 && ! in_array($w, $stop, true))));
    }
}
