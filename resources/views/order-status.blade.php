@extends('layouts.app')

@section('title', $title)
@section('meta_description', $meta_description)
@section('robots', 'noindex, follow')

@section('content')
<div class="page-section">
    <div class="order-status-card">
        @if ($order->status === 'paid')
            <div class="order-status-icon">
                <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <circle cx="12" cy="12" r="12" fill="#22c55e"/>
                    <path d="m7 12.5 3 3 7-7" stroke="#fff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
            </div>
            <h1>پرداخت با موفقیت انجام شد</h1>
            <p style="color: var(--color-text-light);">سفارش شما ثبت شد و به‌زودی برای شما ارسال می‌شود.</p>
            @if ($order->gateway === 'demo')
                <p class="demo-note">این پرداخت با درگاه آزمایشی انجام شد و سفارش واقعی نیست.</p>
            @endif
        @elseif ($order->status === 'failed')
            <div class="order-status-icon">
                <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <circle cx="12" cy="12" r="12" fill="#ef4444"/>
                    <path d="M8 8l8 8M16 8l-8 8" stroke="#fff" stroke-width="2" stroke-linecap="round"/>
                </svg>
            </div>
            <h1>پرداخت ناموفق بود</h1>
            <p style="color: var(--color-text-light);">می‌توانید دوباره تلاش کنید.</p>
            <a href="{{ route('order.pay', $order) }}" class="btn btn-primary" style="margin-block-start: 1rem;">تلاش مجدد برای پرداخت</a>
        @else
            <h1>در انتظار پرداخت</h1>
            <p style="color: var(--color-text-light);">پرداخت این سفارش هنوز تکمیل نشده است.</p>
            <a href="{{ route('order.pay', $order) }}" class="btn btn-primary" style="margin-block-start: 1rem;">پرداخت سفارش</a>
        @endif

        <div class="order-status-details">
            <div class="row"><span>شماره سفارش</span><strong>{{ $order->order_number }}</strong></div>
            <div class="row"><span>مبلغ</span><strong>{{ fa_price($order->amount) }}</strong></div>
            @if ($order->gateway_reference)
                <div class="row"><span>کد پیگیری</span><strong dir="ltr">{{ $order->gateway_reference }}</strong></div>
            @endif
            <div class="row"><span>نام</span><strong>{{ $order->customer_name }}</strong></div>
            <div class="row"><span>موبایل</span><strong dir="ltr">{{ $order->customer_phone }}</strong></div>
        </div>

        <a href="{{ route('home') }}" class="btn btn-outline" style="margin-block-start: 1.5rem;">بازگشت به فروشگاه</a>
    </div>
</div>

@if ($order->status === 'paid')
    @section('extra_js')
    <script>
        try { localStorage.removeItem('lowz_cart'); } catch (e) {}
    </script>
    @endsection
@endif
@endsection
