<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Comment extends Model
{
    protected $fillable = [
        'product_id',
        'name',
        'email',
        'rating',
        'body',
        'is_accepted',
        'ip',
        'user_agent',
    ];

    protected function casts(): array
    {
        return [
            'rating' => 'integer',
            'is_accepted' => 'boolean',
        ];
    }

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

    public function scopeAccepted(Builder $query): Builder
    {
        return $query->where('is_accepted', true);
    }
}
