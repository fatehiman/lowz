<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PageSeo extends Model
{
    protected $table = 'page_seo';

    protected $fillable = [
        'page_key',
        'title',
        'meta_description',
        'og_image',
    ];

    /**
     * Fetch the SEO row for a page key, failing safe with a default title
     * so a missing DB row never breaks a page (no throw, no blank title).
     */
    public static function for(string $pageKey): self
    {
        return static::query()->where('page_key', $pageKey)->first() ?? new self([
            'page_key' => $pageKey,
            'title' => config('shop.name'),
            'meta_description' => config('shop.name').' — '.config('shop.tagline'),
            'og_image' => null,
        ]);
    }
}
