<?php

namespace App\Services;

use App\Models\Article;
use App\Models\ArticleSubject;
use App\Models\ExternalTrustedLink;
use App\Models\Product;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use RuntimeException;
use Throwable;

/**
 * Writes one Persian blog article with DeepSeek and draws its cover image
 * with SiliconFlow. Used by the daily `blog:generate` command.
 */
class AiArticleGenerator
{
    /**
     * Ask DeepSeek for an article on $topic. Returns
     * ['title', 'excerpt', 'body', 'image_prompt'] — body is HTML.
     */
    public function writeArticle(string $topic, ?Product $product = null): array
    {
        $min = config('blog_ai.min_words');
        $max = config('blog_ai.max_words');

        $shop = config('shop.name');
        $system = <<<PROMPT
تو نویسنده محتوای وبلاگ فروشگاه اینترنتی «{$shop}» هستی. {$shop} یک عطاری آنلاین است و ادویه، دمنوش و گیاهان دارویی، گلاب و عرقیات گیاهی، روغن‌های گیاهی، عسل و دانه‌های خوراکی می‌فروشد.

قوانین نوشتن:
- زبان: فارسی روان و درست، با نیم‌فاصله صحیح.
- طول متن اصلی: بین {$min} تا {$max} کلمه.
- لحن: گرم، مفید و قابل اعتماد. مقاله باید اطلاعات واقعی و کاربردی بدهد، نه فقط تبلیغ.
- حداکثر یک بار و به‌صورت طبیعی به {$shop} اشاره کن.
- آمار، عدد، نام پژوهش یا منبعی که از درستی آن مطمئن نیستی نساز. درباره سلامت ادعای درمانی قطعی نکن، از «در طب سنتی» یا «باور بر این است» برای باورهای سنتی استفاده کن و محتاط بنویس.
- اگر درباره مصرف یک گیاه دارویی می‌نویسی، در پایان یک جمله کوتاه بنویس که در بارداری، شیردهی، بیماری یا مصرف دارو باید با پزشک مشورت کرد.
- از یک زاویه مشخص و جذاب به موضوع نگاه کن، نه یک متن کلی.
- فقط روی موضوع داده‌شده تمرکز کن و مقاله را به سمت موضوع دیگری نبر.
- متن را برای سئو مناسب بنویس: عنوان جذاب و طبیعی، کلمه کلیدی موضوع در عنوان و پاراگراف اول.
- این قوانین فقط برای خود توست؛ در متن مقاله به آن‌ها اشاره نکن (مثلاً ننویس «ادعای درمانی نمی‌کنیم»).

لینک‌دهی (اختیاری):
- در پیام کاربر فهرستی از مقاله‌های قبلی (کد A) و سایت‌های معتبر (کد E) و گاهی یک محصول (کد P) آمده است.
- فقط اگر یکی از آن‌ها واقعاً و مستقیماً به جمله‌ای از مقاله مربوط است، یک عبارت طبیعی و توصیفی از همان جمله را لینک کن، مثلاً: <a href="A5">عبارت توصیفی مرتبط</a>
- اگر در فهرست یک محصول (کد P) آمده، لینک دادن به همان محصول مجاز است: اگر جای طبیعی در متن دارد (مثلاً جایی که از همان گیاه، ادویه یا دمنوش حرف می‌زنی)، یک بار به آن لینک بده. اگر محصولی در فهرست نیست، به هیچ محصولی لینک نده.
- مقدار href باید دقیقاً یکی از کدهای فهرست باشد (مثل P3 یا A12 یا E2)، هرگز نشانی اینترنتی ننویس.
- حداکثر ۳ لینک داخلی (P یا A) و حداکثر ۱ لینک خارجی (E). هر کد حداکثر یک بار.
- متن لینک هرگز «اینجا» یا «کلیک کنید» نباشد. جمله را فقط برای جا دادن لینک عوض نکن.
- اگر چیزی واقعاً مرتبط نیست، هیچ لینکی نگذار. لینک نگذاشتن کاملاً قابل قبول و بهتر از لینک نامرتبط است.

قالب خروجی: فقط یک شیء JSON معتبر با دقیقاً همین چهار کلید و به همین ترتیب (کلید دیگری اضافه نکن):
{
  "title": "عنوان مقاله (حداکثر ۷۰ کاراکتر)",
  "excerpt": "خلاصه یک‌جمله‌ای برای توضیح متا (حداکثر ۱۶۰ کاراکتر)",
  "image_prompt": "An English prompt for an AI image generator: one realistic, natural-looking, square photo that fits this article (herbs, spices, herbal tea, a traditional Persian herbal shop, etc.). Describe the subject, setting, colors and light in 40-80 words. The image must contain no text, letters, logos or watermarks.",
  "body": "متن مقاله به HTML. فقط از تگ‌های <p>، <h2>، <h3>، <ul>، <ol>، <li>، <strong> و <a href=\"کد\"> استفاده کن. عنوان اصلی (h1) را در body تکرار نکن."
}
PROMPT;

        $candidates = $this->linkCandidates($product);
        $user = "موضوع مقاله امروز: {$topic}\n\nفهرست لینک‌های مجاز (کد: عنوان):\n"
            .collect($candidates)->map(fn ($c, $code) => "{$code}: {$c['label']}")->implode("\n");

        $data = $this->chatJson($system, $user, ['title', 'excerpt', 'image_prompt', 'body'], 1.0);

        [$body, $links] = $this->resolveLinks(trim($data['body']), $candidates);

        Log::channel('blog_ai')->info('DeepSeek article written', [
            'topic' => $topic,
            'title' => $data['title'],
            'words' => static::wordCount($body),
            'links' => $links,
        ]);

        return [
            'title' => trim(strip_tags($data['title'])),
            'excerpt' => trim(strip_tags($data['excerpt'])),
            'body' => $body,
            'image_prompt' => trim($data['image_prompt']),
            'links' => $links,
        ];
    }

    /**
     * Pages the AI may link to, keyed by a short code: P = the one product
     * picked by pickProduct() (or none), A = one of the last 30 articles in
     * random order (so the first one in the list is not always the one
     * linked), E = row of external_trusted_links.
     *
     * @return array<string, array{label: string, url: string, external: bool}>
     */
    public function linkCandidates(?Product $product = null): array
    {
        $list = [];

        if ($product) {
            $list['P'.$product->id] = ['label' => 'محصول: '.Str::squish($product->name), 'url' => route('product.show', $product), 'external' => false];
        }

        Article::query()->where('is_published', true)->orderByDesc('published_at')->orderByDesc('id')->take(30)->get()
            ->shuffle()
            ->each(function (Article $a) use (&$list) {
                $list['A'.$a->id] = ['label' => 'مقاله: '.$a->title, 'url' => route('blog.show', $a), 'external' => false];
            });

        ExternalTrustedLink::query()->orderBy('id')->get()
            ->each(function (ExternalTrustedLink $e) use (&$list) {
                $list['E'.$e->id] = ['label' => 'سایت: '.$e->name, 'url' => $e->url, 'external' => true];
            });

        return $list;
    }

    /**
     * Next subject by fair rotation (see FairRotation), or null if the table is empty.
     */
    public function pickSubject(): ?ArticleSubject
    {
        $subjects = ArticleSubject::query()->where('is_active', true)->get()->keyBy('id');
        $key = FairRotation::pick($subjects->map(fn (ArticleSubject $s) => [
            'count' => $s->use_count,
            'last' => $s->last_used_at?->getTimestamp(),
        ])->all(), 5);

        return $key === null ? null : $subjects[$key];
    }

    /**
     * The one product the AI may link to in this article, by fair rotation of
     * how often each product was linked; null when the subject does not allow
     * product links or no product is allowed.
     */
    public function pickProduct(?ArticleSubject $subject): ?Product
    {
        if ($subject && ! $subject->allow_product_link) {
            return null;
        }

        $products = Product::query()->where('is_active', true)->where('allow_article_link', true)->get()->keyBy('id');
        $key = FairRotation::pick($products->map(fn (Product $p) => [
            'count' => $p->link_count,
            'last' => $p->last_linked_at?->getTimestamp(),
        ])->all(), 2);

        return $key === null ? null : $products[$key];
    }

    /**
     * Swap the AI's link codes for real URLs. Any other link (unknown code,
     * raw URL, repeated code, or over the 3 internal / 1 external limit) is
     * removed and only its text is kept.
     *
     * @return array{0: string, 1: string[]} [body, codes actually used]
     */
    public function resolveLinks(string $body, array $candidates): array
    {
        $used = [];
        $internal = 0;
        $external = 0;

        $body = preg_replace_callback('/<a\b([^>]*)>(.*?)<\/a>/isu', function ($m) use ($candidates, &$used, &$internal, &$external) {
            $text = $m[2];
            if (! preg_match('/href\s*=\s*["\']\s*([A-Za-z]\d+)\s*["\']/', $m[1], $h)) {
                return $text;
            }

            $code = strtoupper($h[1]);
            $target = $candidates[$code] ?? null;
            if (! $target || in_array($code, $used, true) || trim(strip_tags($text)) === '') {
                return $text;
            }
            if ($target['external'] ? $external >= 1 : $internal >= 3) {
                return $text;
            }

            $target['external'] ? $external++ : $internal++;
            $used[] = $code;

            return '<a href="'.e($target['url']).'">'.$text.'</a>';
        }, $body);

        return [$body, $used];
    }

    /**
     * Ask DeepSeek for the Persian SEO copy of an article. Returns
     * ['meta_title', 'meta_description', 'keywords' (comma list), 'image_alt'].
     * $imagePrompt is the English prompt the cover was drawn from, so the alt
     * text describes the real picture; without it the alt follows the title.
     */
    public function writeSeo(string $title, string $body, ?string $imagePrompt = null): array
    {
        $shop = config('shop.name');
        $system = <<<PROMPT
تو متخصص سئوی محتوای فارسی هستی. برای مقاله‌ای که می‌دهم داده‌های سئو می‌نویسی تا مقاله در جستجوهای فارسی گوگل خوب دیده شود.

قوانین:
- همه خروجی‌ها فقط فارسی باشند.
- فقط درباره موضوع خود مقاله بنویس. نام هیچ فروشگاه، برند یا وب‌سایتی (مثلاً «{$shop}») و هیچ چیز نامرتبط با موضوع مقاله را در هیچ‌کدام از خروجی‌ها نیاور.
- meta_title: بین ۴۰ تا ۶۰ کاراکتر. کلمه کلیدی اصلی نزدیک ابتدای آن باشد. طبیعی و جذاب برای کلیک، بدون تکرار و انباشت کلمات کلیدی.
- meta_description: بین ۱۲۰ تا ۱۵۵ کاراکتر، یک یا دو جمله کامل. دقیقاً بگوید خواننده در مقاله چه چیزی پیدا می‌کند و کلمه کلیدی اصلی را داشته باشد.
- keywords: آرایه‌ای از ۵ تا ۸ عبارت که کاربران فارسی‌زبان واقعاً در گوگل جستجو می‌کنند. اولی کلمه کلیدی اصلی باشد و چند عبارت بلندتر (long-tail) هم داشته باشد. بدون تکرار.
- image_alt: یک عبارت کوتاه (حداکثر ۱۲۵ کاراکتر) که محتوای تصویر شاخص مقاله را توصیف کند و به موضوع مقاله مربوط باشد. با «تصویر» یا «عکس» شروع نشود.

قالب خروجی: فقط یک شیء JSON معتبر با دقیقاً همین کلیدها:
{"meta_title": "...", "meta_description": "...", "keywords": ["...", "..."], "image_alt": "..."}
PROMPT;

        $user = "عنوان مقاله: {$title}\n\n";
        if ($imagePrompt) {
            $user .= "توضیح تصویر شاخص (به انگلیسی): {$imagePrompt}\n\n";
        }
        $user .= 'متن مقاله: '.Str::limit(Str::squish(strip_tags(str_replace('>', '> ', $body))), 6000);

        $data = $this->chatJson($system, $user, ['meta_title', 'meta_description', 'keywords', 'image_alt'], 0.7, function (array $data) {
            $all = $data['meta_title'].' '.$data['meta_description'].' '.$data['image_alt'].' '.implode(' ', (array) $data['keywords']);
            if (preg_match('/'.preg_quote(config('shop.name'), '/').'|lowz/iu', $all)) {
                throw new RuntimeException('SEO copy mentions the shop name');
            }
        });

        $keywords = collect((array) $data['keywords'])
            ->map(fn ($k) => trim(strip_tags((string) $k)))
            ->filter()
            ->unique()
            ->take(10)
            ->implode('، ');

        return [
            'meta_title' => Str::limit(trim(strip_tags($data['meta_title'])), 70, ''),
            'meta_description' => Str::limit(trim(strip_tags($data['meta_description'])), 300, ''),
            'keywords' => Str::limit($keywords, 490, ''),
            'image_alt' => Str::limit(trim(strip_tags($data['image_alt'])), 200, ''),
        ];
    }

    /**
     * One DeepSeek chat call in JSON mode, retried up to 3 times when the
     * reply is cut off, not valid JSON, missing a key, or fails $check.
     */
    protected function chatJson(string $system, string $user, array $keys, float $temperature, ?callable $check = null): array
    {
        $lastError = null;

        for ($attempt = 1; $attempt <= 3; $attempt++) {
            try {
                $response = Http::withToken(config('blog_ai.deepseek.key'))
                    ->timeout(300)
                    ->retry(2, 5000, throw: false)
                    ->post(rtrim(config('blog_ai.deepseek.base_url'), '/').'/chat/completions', [
                        'model' => config('blog_ai.deepseek.model'),
                        'messages' => [
                            ['role' => 'system', 'content' => $system],
                            ['role' => 'user', 'content' => $user],
                        ],
                        'response_format' => ['type' => 'json_object'],
                        'max_tokens' => 16000,
                        'temperature' => $temperature,
                    ]);

                if (! $response->successful()) {
                    throw new RuntimeException('DeepSeek HTTP '.$response->status().': '.Str::limit($response->body(), 500));
                }

                $content = (string) $response->json('choices.0.message.content');
                $finish = $response->json('choices.0.finish_reason');

                if ($finish !== 'stop') {
                    throw new RuntimeException("DeepSeek finish_reason={$finish}");
                }

                $data = json_decode($content, true);

                foreach ($keys as $key) {
                    $value = $data[$key] ?? null;
                    if (is_array($value) ? $value === [] : (! is_string($value) || trim($value) === '')) {
                        throw new RuntimeException("DeepSeek reply is missing '{$key}': ".Str::limit($content, 500));
                    }
                }

                if ($check) {
                    $check($data);
                }

                Log::channel('blog_ai')->info('DeepSeek usage', ['usage' => $response->json('usage')]);

                return $data;
            } catch (RuntimeException $e) {
                $lastError = $e;
                Log::channel('blog_ai')->warning('DeepSeek attempt failed', ['attempt' => $attempt, 'error' => Str::limit($e->getMessage(), 300)]);
            }
        }

        throw $lastError;
    }

    /**
     * Draw a cover image and save it under public/images/articles/.
     * Returns the public path (e.g. "images/articles/ai-....webp").
     */
    public function drawImage(string $prompt): string
    {
        $prompt .= ' Professional photography, high detail, soft natural light, square composition. No text, no letters, no words, no logo, no watermark.';

        $errors = [];

        foreach (config('blog_ai.siliconflow.models') as $model) {
            try {
                $response = Http::withToken(config('blog_ai.siliconflow.key'))
                    ->timeout(180)
                    ->post(rtrim(config('blog_ai.siliconflow.base_url'), '/').'/images/generations', [
                        'model' => trim($model),
                        'prompt' => $prompt,
                        'image_size' => config('blog_ai.siliconflow.image_size'),
                        'batch_size' => 1,
                    ]);

                $url = $response->json('images.0.url');

                if (! $response->successful() || ! $url) {
                    throw new RuntimeException('HTTP '.$response->status().': '.Str::limit($response->body(), 300));
                }

                $bytes = Http::timeout(120)->get($url)->throw()->body();
                $path = $this->saveWebp($bytes);

                Log::channel('blog_ai')->info('Image generated', ['model' => $model, 'path' => $path]);

                return $path;
            } catch (Throwable $e) {
                $errors[] = "{$model}: ".$e->getMessage();
                Log::channel('blog_ai')->warning('Image model failed', ['model' => $model, 'error' => $e->getMessage()]);
            }
        }

        throw new RuntimeException('All image models failed: '.implode(' | ', $errors));
    }

    /**
     * Resize the downloaded image to a square and store it as WebP.
     */
    protected function saveWebp(string $bytes): string
    {
        $source = @imagecreatefromstring($bytes);

        if (! $source) {
            throw new RuntimeException('Downloaded image could not be decoded');
        }

        $size = (int) config('blog_ai.image_output_size', 800);
        $w = imagesx($source);
        $h = imagesy($source);
        $side = min($w, $h);

        $target = imagecreatetruecolor($size, $size);
        imagecopyresampled($target, $source, 0, 0, intdiv($w - $side, 2), intdiv($h - $side, 2), $size, $size, $side, $side);

        $relative = 'images/articles/ai-'.now()->format('Ymd-His').'-'.Str::lower(Str::random(6)).'.webp';
        $absolute = public_path($relative);

        if (! is_dir(dirname($absolute))) {
            mkdir(dirname($absolute), 0755, true);
        }

        if (! imagewebp($target, $absolute, 82)) {
            throw new RuntimeException("Could not write {$absolute}");
        }

        imagedestroy($source);
        imagedestroy($target);

        return $relative;
    }

    /**
     * Persian-native slug (same rules as ArticleSeeder), made unique.
     */
    public static function uniqueSlug(string $title): string
    {
        $clean = str_replace(['؟', '?', '!', '،', ',', '.', ':', '«', '»', '"', "'", '؛', '/', '\\', '#', '%', '&'], '', trim($title));
        $base = trim(preg_replace('/\s+/u', '-', $clean), '-');
        $base = Str::limit($base, 180, '');

        $slug = $base;
        for ($i = 2; Article::where('slug', $slug)->exists(); $i++) {
            $slug = "{$base}-{$i}";
        }

        return $slug;
    }

    public static function wordCount(string $html): int
    {
        $text = trim(preg_replace('/\s+/u', ' ', strip_tags(str_replace('>', '> ', $html))));

        return $text === '' ? 0 : count(explode(' ', $text));
    }
}
