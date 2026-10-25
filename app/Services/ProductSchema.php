<?php

namespace App\Services;

use App\Models\Comment;
use App\Models\Product;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;

/**
 * schema.org pieces shared by every Product JSON-LD block (product page and
 * the home page ItemList), so Google's merchant-listing checks see the same
 * offer data everywhere. The values follow /rules: processing <= 3 working
 * days, delivery 2-5 working days, shipping paid by the buyer on delivery
 * (depends on the city, at most SHIPPING_MAX_TOMAN), and food is
 * not returnable once delivered (damaged items are replaced/refunded).
 */
class ProductSchema
{
    // Google wants a Google product taxonomy path, not free text.
    public const CATEGORY = 'Food, Beverages & Tobacco > Food Items > Seasonings & Spices';

    // Shipping is paid on delivery (پس‌کرایه) and depends on the city; this is the maximum.
    public const SHIPPING_MAX_TOMAN = 200000;

    public static function brand(): array
    {
        return ['@type' => 'Brand', 'name' => config('shop.name')];
    }

    /** The product fields Google uses as identifiers (brand + mpn/sku). */
    public static function identifiers(Product $product): array
    {
        return [
            'sku' => 'LZ-'.$product->id,
            'mpn' => 'LZ-'.$product->id,
            'brand' => self::brand(),
            'category' => self::CATEGORY,
        ];
    }

    /**
     * aggregateRating + the newest reviews, from accepted comments only (Google
     * forbids made-up ratings). Empty when there are none, so no stars appear.
     */
    public static function rating(Collection $comments, int $count, ?float $average): array
    {
        if ($count === 0) {
            return [];
        }

        return [
            'aggregateRating' => [
                '@type' => 'AggregateRating',
                'ratingValue' => (string) $average,
                'reviewCount' => $count,
                'bestRating' => '5',
                'worstRating' => '1',
            ],
            'review' => $comments->take(10)->map(fn (Comment $c) => [
                '@type' => 'Review',
                'author' => ['@type' => 'Person', 'name' => $c->name],
                'datePublished' => $c->created_at->toDateString(),
                'reviewBody' => Str::squish($c->body),
                'reviewRating' => [
                    '@type' => 'Rating',
                    'ratingValue' => (string) $c->rating,
                    'bestRating' => '5',
                    'worstRating' => '1',
                ],
            ])->values()->all(),
        ];
    }

    public static function offer(Product $product): array
    {
        $url = route('product.show', $product);

        return [
            '@type' => 'Offer',
            'url' => $url,
            // Prices are stored in Toman; schema.org priceCurrency must be an
            // ISO 4217 code, so we convert to Rial (x10) for JSON-LD only.
            // The displayed price on the page stays in Toman.
            'price' => (string) ($product->price * 10),
            'priceCurrency' => 'IRR',
            'validFrom' => ($product->created_at ?? now())->toDateString(),
            'priceValidUntil' => now()->addYear()->endOfYear()->toDateString(),
            'itemCondition' => 'https://schema.org/NewCondition',
            'availability' => $product->is_active
                ? 'https://schema.org/InStock'
                : 'https://schema.org/OutOfStock',
            'eligibleQuantity' => [
                '@type' => 'QuantitativeValue',
                'minValue' => $product->min_quantity,
                'unitCode' => 'C62',
            ],
            'shippingDetails' => self::shippingDetails(),
            'hasMerchantReturnPolicy' => self::returnPolicy(),
            'seller' => [
                '@type' => 'Organization',
                'name' => config('shop.name'),
                'url' => url('/'),
            ],
        ];
    }

    public static function shippingDetails(): array
    {
        return [
            '@type' => 'OfferShippingDetails',
            'shippingRate' => [
                '@type' => 'MonetaryAmount',
                // Google needs one fixed number; the real cost depends on the
                // city and is paid on delivery, so we give the maximum.
                'value' => (string) (self::SHIPPING_MAX_TOMAN * 10),
                'currency' => 'IRR',
            ],
            'shippingDestination' => [
                '@type' => 'DefinedRegion',
                'addressCountry' => 'IR',
            ],
            'deliveryTime' => [
                '@type' => 'ShippingDeliveryTime',
                // Friday and official holidays are not working days.
                'businessDays' => [
                    '@type' => 'OpeningHoursSpecification',
                    'dayOfWeek' => array_map(fn ($day) => 'https://schema.org/'.$day, [
                        'Saturday', 'Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday',
                    ]),
                ],
                'handlingTime' => [
                    '@type' => 'QuantitativeValue',
                    'minValue' => 0,
                    'maxValue' => 3,
                    'unitCode' => 'DAY',
                ],
                'transitTime' => [
                    '@type' => 'QuantitativeValue',
                    'minValue' => 2,
                    'maxValue' => 5,
                    'unitCode' => 'DAY',
                ],
            ],
        ];
    }

    public static function returnPolicy(): array
    {
        return [
            '@type' => 'MerchantReturnPolicy',
            'applicableCountry' => 'IR',
            'returnPolicyCategory' => 'https://schema.org/MerchantReturnNotPermitted',
            'merchantReturnLink' => route('rules'),
        ];
    }
}
