<?php

namespace Tests\Feature;

use App\Models\City;
use App\Models\Order;
use App\Models\Product;
use App\Models\Province;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class DemoPaymentTest extends TestCase
{
    use RefreshDatabase;

    private Order $order;

    protected function setUp(): void
    {
        parent::setUp();
        $this->withoutMiddleware(\Illuminate\Foundation\Http\Middleware\ValidateCsrfToken::class);

        $product = Product::create([
            'slug' => 'saffron', 'name' => 'زعفران', 'short_description' => 'تست', 'price' => 100000,
            'image' => 'images/products/saffron.webp', 'is_active' => true,
        ]);
        $province = Province::create(['name' => 'تهران']);
        $city = City::create(['province_id' => $province->id, 'name' => 'تهران']);

        $this->post(route('checkout.store'), [
            'cart_json' => json_encode([$product->id => 3]),
            'name' => 'تست', 'phone' => '09120000000',
            'province_id' => $province->id, 'city_id' => $city->id, 'address' => 'نشانی',
        ])->assertRedirect();

        $this->order = Order::sole();
    }

    public function test_order_total_comes_from_the_database(): void
    {
        $this->assertSame(300000, (int) $this->order->amount);
        $this->assertSame('pending', $this->order->status);
    }

    public function test_successful_demo_payment_marks_the_order_paid(): void
    {
        $this->get(route('order.pay', $this->order))->assertRedirect(route('payment.demo', $this->order));
        $this->get(route('payment.demo', $this->order))->assertOk()->assertSee('درگاه پرداخت آزمایشی');

        $this->post(route('payment.demo.callback', $this->order), ['result' => 'success'])
            ->assertRedirect(route('order.status', $this->order));

        $this->order->refresh();
        $this->assertSame('paid', $this->order->status);
        $this->assertStringStartsWith('DEMO-', $this->order->gateway_reference);
        $this->assertSame('success', $this->order->payments()->sole()->status);
    }

    public function test_cancelled_demo_payment_marks_the_order_failed(): void
    {
        $this->get(route('order.pay', $this->order));
        $this->post(route('payment.demo.callback', $this->order), ['result' => 'cancel']);

        $this->assertSame('failed', $this->order->refresh()->status);
    }
}
