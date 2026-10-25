<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Services\CartPricing;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function data(Request $request): JsonResponse
    {
        $request->validate([
            'cart' => 'nullable|array',
        ]);

        return response()->json(CartPricing::build($request->input('cart', [])));
    }

    public function add(Request $request): JsonResponse
    {
        $request->validate([
            'product_id' => 'required|integer|exists:products,id',
            'quantity' => 'nullable|integer|min:1',
        ]);

        $productId = (int) $request->input('product_id');

        $product = Product::find($productId);
        if (!$product || !$product->is_active) {
            return response()->json(['error' => 'محصول یافت نشد'], 404);
        }

        $quantity = $product->normalizeQuantity((int) $request->input('quantity', $product->min_quantity));

        return response()->json([
            'success' => true,
            'product' => [
                'id' => $product->id,
                'name' => $product->name,
                'price' => (int) $product->price,
                'image' => $product->image,
            ],
            'quantity' => $quantity,
            'message' => 'محصول به سبد اضافه شد',
        ]);
    }

    public function update(Request $request): JsonResponse
    {
        $request->validate([
            'product_id' => 'required|integer|exists:products,id',
            'quantity' => 'required|integer|min:0',
        ]);

        $productId = (int) $request->input('product_id');
        $quantity = (int) $request->input('quantity');

        $product = Product::find($productId);
        if (!$product) {
            return response()->json(['error' => 'محصول یافت نشد'], 404);
        }

        if ($quantity <= 0) {
            return response()->json([
                'success' => true,
                'removed' => true,
            ]);
        }

        $quantity = $product->normalizeQuantity($quantity);

        return response()->json([
            'success' => true,
            'product' => [
                'id' => $product->id,
                'name' => $product->name,
                'price' => (int) $product->price,
                'image' => $product->image,
            ],
            'quantity' => $quantity,
        ]);
    }

    public function remove(Request $request): JsonResponse
    {
        $request->validate([
            'product_id' => 'required|integer|exists:products,id',
        ]);

        return response()->json([
            'success' => true,
            'removed' => true,
        ]);
    }
}
