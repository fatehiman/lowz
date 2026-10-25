<?php

namespace App\Console\Commands;

use App\Models\Article;
use App\Services\AiArticleGenerator;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use Throwable;

/**
 * Fill meta_title / meta_description / keywords / image_alt for articles
 * that do not have them yet (e.g. written before these fields existed).
 */
class GenerateArticleSeo extends Command
{
    protected $signature = 'blog:seo
        {--id=* : Only these article ids}
        {--force : Rewrite SEO copy even if it already exists}
        {--dry-run : Print, save nothing}';

    protected $description = 'Write Persian SEO meta (title, description, keywords, image alt) for articles with DeepSeek';

    public function handle(AiArticleGenerator $generator): int
    {
        $query = Article::query()->orderBy('id');

        if ($ids = $this->option('id')) {
            $query->whereIn('id', $ids);
        } elseif (! $this->option('force')) {
            $query->where(fn ($q) => $q->whereNull('meta_description')->orWhereNull('keywords')->orWhereNull('image_alt'));
        }

        $articles = $query->get();
        $this->info($articles->count().' article(s)');
        $failed = 0;

        foreach ($articles as $article) {
            try {
                $seo = $generator->writeSeo($article->title, $article->body);
            } catch (Throwable $e) {
                $failed++;
                Log::channel('blog_ai')->error('blog:seo failed', ['id' => $article->id, 'error' => $e->getMessage()]);
                $this->error("#{$article->id}: ".$e->getMessage());

                continue;
            }

            $this->line("#{$article->id} {$seo['meta_title']}");
            $this->line("   {$seo['meta_description']}");
            $this->line("   {$seo['keywords']}");
            $this->line("   alt: {$seo['image_alt']}");

            if (! $this->option('dry-run')) {
                // Keep updated_at: new meta tags are not a content change for the sitemap.
                $article->timestamps = false;
                $article->update($seo);
            }
        }

        return $failed ? self::FAILURE : self::SUCCESS;
    }
}
