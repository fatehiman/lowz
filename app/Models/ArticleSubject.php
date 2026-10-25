<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ArticleSubject extends Model
{
    protected $fillable = [
        'article_category_id',
        'name',
        'is_active',
        'allow_product_link',
        'use_count',
        'last_used_at',
    ];

    protected function casts(): array
    {
        return [
            'is_active' => 'boolean',
            'allow_product_link' => 'boolean',
            'use_count' => 'integer',
            'last_used_at' => 'datetime',
        ];
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(ArticleCategory::class, 'article_category_id');
    }

    public function articles(): HasMany
    {
        return $this->hasMany(Article::class);
    }
}
