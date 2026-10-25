<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\PageSeo;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Illuminate\View\View;

/**
 * Payment with a placeholder ("demo") gateway: no money moves. The customer
 * chooses "successful" or "cancel" on a fake bank page. To connect a real
 * gateway later, replace payOrder() (create the ticket, redirect) and the
 * callback (verify), and keep the order/payment status updates.
 */
class PaymentController extends Controller
{
    public function payOrder(Order $order): RedirectResponse
    {
        if ($order->status === 'paid') {
            return redirect()->route('order.status', $order);
        }

        $order->payments()->create([
            'reference' => $order->order_number,
            'gateway' => 'demo',
            'amount' => $order->amount,
            'status' => 'pending',
        ]);

        return redirect()->route('payment.demo', $order);
    }

    public function demoGateway(Order $order): View|RedirectResponse
    {
        if ($order->status === 'paid') {
            return redirect()->route('order.status', $order);
        }

        return view('payment-demo', ['order' => $order]);
    }

    public function demoCallback(Request $request, Order $order): RedirectResponse
    {
        if ($order->status === 'paid') {
            return redirect()->route('order.status', $order);
        }

        $payment = $order->payments()->latest('id')->first();

        if ($request->input('result') !== 'success') {
            $payment?->update(['status' => 'failed', 'payload' => ['result' => 'cancelled']]);
            $order->update(['status' => 'failed']);

            return redirect()->route('order.status', $order)
                ->withErrors(['payment' => 'پرداخت لغو شد.']);
        }

        $trackingCode = 'DEMO-'.strtoupper(Str::random(8));

        $payment?->update([
            'status' => 'success',
            'transaction_id' => $trackingCode,
            'method' => 'آزمایشی',
            'payload' => ['result' => 'success', 'demo' => true],
        ]);

        $order->update([
            'status' => 'paid',
            'gateway' => 'demo',
            'payment_method' => 'درگاه آزمایشی',
            'gateway_reference' => $trackingCode,
            'paid_at' => now(),
        ]);

        Log::info('Demo order paid', ['order' => $order->order_number, 'amount' => $order->amount]);

        return redirect()->route('order.status', $order)->with('success', 'پرداخت آزمایشی با موفقیت انجام شد.');
    }

    public function orderStatus(Order $order): View
    {
        $seo = PageSeo::for('order-status');

        return view('order-status', [
            'title' => $seo->title,
            'meta_description' => $seo->meta_description,
            'order' => $order,
        ]);
    }
}
