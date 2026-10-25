<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Product extends Model
{
    protected $fillable = [
        'product_category_id',
        'slug',
        'name',
        'short_description',
        'description',
        'price',
        'unit',
        'min_quantity',
        'quantity_step',
        'image',
        'is_active',
        'allow_article_link',
        'link_count',
        'last_linked_at',
        'sort_order',
    ];

    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    protected function casts(): array
    {
        return [
            'is_active' => 'boolean',
            'allow_article_link' => 'boolean',
            'link_count' => 'integer',
            'last_linked_at' => 'datetime',
            'price' => 'integer',
            'min_quantity' => 'integer',
            'quantity_step' => 'integer',
        ];
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(ProductCategory::class, 'product_category_id');
    }

    public function orderItems(): HasMany
    {
        return $this->hasMany(OrderItem::class);
    }

    public function comments(): HasMany
    {
        return $this->hasMany(Comment::class);
    }

    /**
     * Snap a requested quantity onto this product's valid grid: never below
     * min_quantity, and every step above it a multiple of quantity_step
     * (e.g. min_quantity=18, quantity_step=10 -> 18, 28, 38, ...). Rounds up
     * so a value between two steps never loses units the customer asked for.
     */
    public function normalizeQuantity(int $quantity): int
    {
        if ($quantity <= $this->min_quantity) {
            return $this->min_quantity;
        }

        $step = max(1, $this->quantity_step);
        $stepsAbove = (int) ceil(($quantity - $this->min_quantity) / $step);

        return $this->min_quantity + $stepsAbove * $step;
    }
}
