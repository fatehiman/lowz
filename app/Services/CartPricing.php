<?php

namespace App\Services;

use App\Models\Product;
use App\Models\Setting;

/**
 * Recomputes a cart (product_id => quantity) into priced line items plus the
 * mandatory packing and VAT surcharges, always re-reading prices/settings
 * from the DB so nothing here can be tampered with client-side.
 */
class CartPricing
{
    public static function build(array $cart): array
    {
        $items = [];
        $totalQuantity = 0;
        $itemsPrice = 0;

        foreach ($cart as $productId => $quantity) {
            $productId = (int) $productId;
            $quantity = (int) $quantity;

            if ($quantity <= 0) {
                continue;
            }

            $product = Product::find($productId);
            if (!$product || !$product->is_active) {
                continue;
            }

            $quantity = $product->normalizeQuantity($quantity);
            $lineTotal = (int) $product->price * $quantity;

            $items[] = [
                'id' => $product->id,
                'slug' => $product->slug,
                'name' => $product->name,
                'price' => (int) $product->price,
                'min_quantity' => (int) $product->min_quantity,
                'quantity_step' => (int) $product->quantity_step,
                'quantity' => $quantity,
                'subtotal' => $lineTotal,
                'image' => $product->image,
            ];

            $totalQuantity += $quantity;
            $itemsPrice += $lineTotal;
        }

        $minOrderItems = (int) Setting::get('min_order_items', '1');
        $packingPrice = (int) Setting::get('packing_price', '0');
        $packCapacity = max(1, (int) Setting::get('pack_capacity', '12'));
        $vatPercent = (float) Setting::get('vat_percent', '0');

        $packing = null;
        if (!empty($items) && $packingPrice > 0) {
            $packQuantity = (int) ceil($totalQuantity / $packCapacity);
            $packing = [
                'price' => $packingPrice,
                'quantity' => $packQuantity,
                'subtotal' => $packingPrice * $packQuantity,
            ];
        }

        $subtotalBeforeVat = $itemsPrice + ($packing['subtotal'] ?? 0);
        $vatAmount = $vatPercent > 0 ? (int) round($subtotalBeforeVat * $vatPercent / 100) : 0;
        $grandTotal = $subtotalBeforeVat + $vatAmount;

        return [
            'items' => $items,
            'total_quantity' => $totalQuantity,
            'total_price' => $itemsPrice,
            'packing' => $packing,
            'vat_percent' => $vatPercent,
            'vat_amount' => $vatAmount,
            'subtotal_before_vat' => $subtotalBeforeVat,
            'grand_total' => $grandTotal,
            'min_order_items' => $minOrderItems,
            'meets_minimum' => $totalQuantity >= $minOrderItems,
        ];
    }
}
