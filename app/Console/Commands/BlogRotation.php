<?php

namespace App\Console\Commands;

use App\Models\Article;
use App\Models\ArticleSubject;
use App\Models\Product;
use App\Services\FairRotation;
use Illuminate\Console\Command;

/**
 * Show (and optionally rebuild) the counters behind the fair rotation of
 * article subjects and linked products used by blog:generate.
 */
class BlogRotation extends Command
{
    protected $signature = 'blog:rotation
        {--recount : Rebuild subject counts from articles.article_subject_id and product link counts from article bodies}';

    protected $description = 'Show article subject / product link rotation: counts, last use, chance of being picked next';

    public function handle(): int
    {
        if ($this->option('recount')) {
            $this->recount();
        }

        $subjects = ArticleSubject::query()->orderBy('id')->get();
        $chance = FairRotation::probabilities($subjects->where('is_active', true)->keyBy('id')->map(fn ($s) => [
            'count' => $s->use_count,
            'last' => $s->last_used_at?->getTimestamp(),
        ])->all(), 5);

        $this->table(
            ['id', 'subject', 'active', 'product link', 'count', 'last used', 'next %'],
            $subjects->map(fn ($s) => [
                $s->id, $s->name, $s->is_active ? 'yes' : 'no', $s->allow_product_link ? 'yes' : 'no',
                $s->use_count, $s->last_used_at?->format('Y-m-d H:i') ?? '-',
                isset($chance[$s->id]) ? number_format(100 * $chance[$s->id], 1) : '0 (cooldown)',
            ])
        );

        $products = Product::query()->orderBy('sort_order')->orderBy('id')->get();
        $chance = FairRotation::probabilities($products->where('is_active', true)->where('allow_article_link', true)->keyBy('id')->map(fn ($p) => [
            'count' => $p->link_count,
            'last' => $p->last_linked_at?->getTimestamp(),
        ])->all(), 2);

        $this->table(
            ['id', 'product', 'link allowed', 'links', 'last linked', 'offered next %'],
            $products->map(fn ($p) => [
                $p->id, $p->name, $p->is_active && $p->allow_article_link ? 'yes' : 'no',
                $p->link_count, $p->last_linked_at?->format('Y-m-d H:i') ?? '-',
                isset($chance[$p->id]) ? number_format(100 * $chance[$p->id], 1) : '0',
            ])
        );

        return self::SUCCESS;
    }

    private function recount(): void
    {
        foreach (ArticleSubject::all() as $subject) {
            $articles = Article::where('article_subject_id', $subject->id);
            $subject->update([
                'use_count' => $articles->count(),
                'last_used_at' => $articles->max('published_at'),
            ]);
        }

        $articles = Article::all(['id', 'body', 'published_at']);
        foreach (Product::all() as $product) {
            $url = route('product.show', $product);
            $linking = $articles->filter(fn ($a) => str_contains($a->body, $url));
            $product->timestamps = false;
            $product->update([
                'link_count' => $linking->count(),
                'last_linked_at' => $linking->max('published_at'),
            ]);
        }

        $this->info('Counters rebuilt.');
    }
}
