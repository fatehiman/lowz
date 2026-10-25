<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\PageSeo;
use App\Models\Province;
use App\Models\Setting;
use App\Services\CartPricing;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CheckoutController extends Controller
{
    public function index(): View
    {
        $seo = PageSeo::for('checkout');

        return view('checkout', [
            'title' => $seo->title,
            'meta_description' => $seo->meta_description,
            'provinces' => Province::orderBy('name')->get(['id', 'name']),
        ]);
    }

    public function proforma(): View
    {
        return view('checkout-proforma', [
            'sellerInfo' => Setting::get('seller_info', config('shop.name')),
            'paymentNote' => Setting::get('proforma_payment_note', ''),
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'cart_json' => ['required', 'string'],
            'name' => ['required', 'string', 'max:255'],
            'phone' => ['required', 'regex:/^09\d{9}$/'],
            'email' => ['nullable', 'email', 'max:255'],
            'province_id' => ['required', 'exists:provinces,id'],
            'city_id' => ['required', 'exists:cities,id'],
            'postcode' => ['nullable', 'string', 'max:20'],
            'address' => ['required', 'string', 'max:2000'],
        ], [
            'phone.regex' => 'شماره موبایل باید به‌صورت ۰۹۱۲۳۴۵۶۷۸۹ باشد.',
        ]);

        $cart = json_decode($validated['cart_json'], true) ?: [];
        $pricing = CartPricing::build($cart);

        if (empty($pricing['items'])) {
            return redirect()->route('cart')->withErrors(['cart' => 'سبد خرید شما خالی است.']);
        }

        if (!$pricing['meets_minimum']) {
            return redirect()->route('cart')->withErrors([
                'cart' => 'حداقل تعداد اقلام سفارش '.fa_number($pricing['min_order_items']).' عدد است. تعداد فعلی سبد شما '.fa_number($pricing['total_quantity']).' عدد است.',
            ]);
        }

        $order = Order::create([
            'order_number' => Order::makeOrderNumber(),
            'customer_name' => $validated['name'],
            'customer_phone' => $validated['phone'],
            'customer_email' => $validated['email'] ?? null,
            'province_id' => $validated['province_id'],
            'city_id' => $validated['city_id'],
            'postcode' => $validated['postcode'] ?? null,
            'address' => $validated['address'],
            'amount' => $pricing['grand_total'],
            'status' => 'pending',
        ]);

        foreach ($pricing['items'] as $item) {
            $order->items()->create([
                'product_id' => $item['id'],
                'name' => $item['name'],
                'quantity' => $item['quantity'],
                'unit_price' => $item['price'],
                'line_total' => $item['subtotal'],
            ]);
        }

        if ($pricing['packing']) {
            $order->items()->create([
                'product_id' => null,
                'name' => 'بسته‌بندی',
                'quantity' => $pricing['packing']['quantity'],
                'unit_price' => $pricing['packing']['price'],
                'line_total' => $pricing['packing']['subtotal'],
            ]);
        }

        if ($pricing['vat_amount'] > 0) {
            $vatLabel = rtrim(rtrim(number_format($pricing['vat_percent'], 2), '0'), '.');

            $order->items()->create([
                'product_id' => null,
                'name' => "مالیات بر ارزش افزوده ({$vatLabel}٪)",
                'quantity' => 1,
                'unit_price' => $pricing['vat_amount'],
                'line_total' => $pricing['vat_amount'],
            ]);
        }

        return redirect()->route('order.pay', $order);
    }
}
