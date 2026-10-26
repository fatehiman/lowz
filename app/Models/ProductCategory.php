<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ProductCategory extends Model
{
    protected $fillable = [
        'slug',
        'name',
        'description',
        'image',
        'sort_order',
    ];

    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    /** Only categories that have at least one active product (empty ones are hidden from menus and the sitemap). */
    public function scopeWithActiveProducts(Builder $query): Builder
    {
        return $query->whereHas('products', fn ($q) => $q->where('is_active', true));
    }

    public function products(): HasMany
    {
        return $this->hasMany(Product::class);
    }
}
