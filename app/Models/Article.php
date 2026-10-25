<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;

class Article extends Model
{
    protected $fillable = [
        'article_subject_id',
        'article_category_id',
        'title',
        'meta_title',
        'slug',
        'excerpt',
        'meta_description',
        'keywords',
        'body',
        'image',
        'image_alt',
        'is_published',
        'published_at',
    ];

    protected function casts(): array
    {
        return [
            'is_published' => 'boolean',
            'published_at' => 'datetime',
        ];
    }

    public function subject(): BelongsTo
    {
        return $this->belongsTo(ArticleSubject::class, 'article_subject_id');
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(ArticleCategory::class, 'article_category_id');
    }

    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    // SEO fallbacks for articles written before the SEO fields existed.

    public function seoTitle(): string
    {
        return $this->meta_title ?: $this->title;
    }

    public function seoDescription(): string
    {
        return $this->meta_description
            ?: ($this->excerpt ?: Str::limit(Str::squish(strip_tags($this->body)), 155));
    }

    public function imageAlt(): string
    {
        return $this->image_alt ?: $this->title;
    }

    /** @return string[] */
    public function keywordList(): array
    {
        return array_values(array_filter(array_map('trim', explode('،', str_replace(',', '،', (string) $this->keywords)))));
    }
}
