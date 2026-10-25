<?php

namespace App\Console\Commands;

use App\Models\Article;
use App\Models\ArticleSubject;
use App\Services\AiArticleGenerator;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use Throwable;

/**
 * Daily AI article. Run by cron on ger1 once a day — see deployment-on-ger1.md.
 */
class GenerateBlogArticle extends Command
{
    protected $signature = 'blog:generate
        {--topic= : Use this topic instead of the next one from the article_subjects rotation}
        {--no-image : Skip the cover image}
        {--draft : Save as unpublished (is_published = false)}
        {--dry-run : Print the article, save nothing}';

    protected $description = 'Write one Persian blog article with DeepSeek and a cover image with SiliconFlow';

    public function handle(AiArticleGenerator $generator): int
    {
        if (! config('blog_ai.deepseek.key')) {
            $this->error('DEEPSEEK_API_KEY is not set.');

            return self::FAILURE;
        }

        // The code picks the subject (fair rotation), never the AI. A --topic that
        // matches a subject name still counts for that subject.
        $subject = $this->option('topic')
            ? ArticleSubject::where('name', $this->option('topic'))->first()
            : $generator->pickSubject();
        $topic = $this->option('topic') ?: $subject?->name;

        if (! $topic) {
            $this->error('No active subject in article_subjects (run: php artisan db:seed --class=ArticleSubjectSeeder).');

            return self::FAILURE;
        }

        $product = $generator->pickProduct($subject);
        $this->info("Topic: {$topic}");
        $this->line('Product offered: '.($product ? "P{$product->id} ".$product->name : 'none'));

        try {
            // One retry if the length is far outside the wanted range.
            $article = $generator->writeArticle($topic, $product);
            $words = AiArticleGenerator::wordCount($article['body']);

            if ($words < config('blog_ai.min_words') * 0.8 || $words > config('blog_ai.max_words') * 1.2) {
                $this->warn("Got {$words} words, trying once more.");
                $article = $generator->writeArticle($topic, $product);
                $words = AiArticleGenerator::wordCount($article['body']);
            }
        } catch (Throwable $e) {
            Log::channel('blog_ai')->error('Article generation failed', ['topic' => $topic, 'error' => $e->getMessage()]);
            $this->error($e->getMessage());

            return self::FAILURE;
        }

        $this->info("Title: {$article['title']} ({$words} words)");
        $this->line("Image prompt: {$article['image_prompt']}");
        $this->line('Links: '.($article['links'] ? implode(', ', $article['links']) : 'none'));

        if ($this->option('dry-run')) {
            $this->line($article['body']);

            return self::SUCCESS;
        }

        // A missing image must not block the article; the blog shows a placeholder.
        $image = null;
        if (! $this->option('no-image') && config('blog_ai.siliconflow.key')) {
            try {
                $image = $generator->drawImage($article['image_prompt']);
                $this->info("Image: {$image}");
            } catch (Throwable $e) {
                Log::channel('blog_ai')->error('Image generation failed', ['error' => $e->getMessage()]);
                $this->warn('No image: '.$e->getMessage());
            }
        }

        // Persian meta title/description/keywords/alt. Optional: the views fall back to title/excerpt.
        $seo = [];
        try {
            $seo = $generator->writeSeo($article['title'], $article['body'], $image ? $article['image_prompt'] : null);
            $this->info("SEO: {$seo['meta_title']} | {$seo['keywords']}");
        } catch (Throwable $e) {
            Log::channel('blog_ai')->error('SEO generation failed', ['error' => $e->getMessage()]);
            $this->warn('No SEO copy: '.$e->getMessage().' (run blog:seo later)');
        }

        $saved = Article::create($seo + [
            'article_subject_id' => $subject?->id,
            'article_category_id' => $subject?->article_category_id,
            'title' => $article['title'],
            'slug' => AiArticleGenerator::uniqueSlug($article['title']),
            'excerpt' => $article['excerpt'],
            'body' => $article['body'],
            'image' => $image,
            'is_published' => ! $this->option('draft'),
            'published_at' => now(),
        ]);

        // Rotation counters: only for what was really used.
        $subject?->update(['use_count' => $subject->use_count + 1, 'last_used_at' => now()]);
        if ($product && in_array('P'.$product->id, $article['links'], true)) {
            $product->timestamps = false; // not a product change for the sitemap
            $product->update(['link_count' => $product->link_count + 1, 'last_linked_at' => now()]);
        }

        Log::channel('blog_ai')->info('Article saved', ['id' => $saved->id, 'slug' => $saved->slug, 'image' => $image]);
        $this->info('Saved: '.route('blog.show', $saved));

        return self::SUCCESS;
    }
}
