@extends('layouts.bare')

@section('title', 'درگاه پرداخت آزمایشی — '.config('shop.name'))

@section('content')
<main class="container" style="padding-block: 2rem;">
    <div class="demo-gateway">
        <div class="demo-gateway-head">
            <h1>درگاه پرداخت آزمایشی</h1>
            <p style="margin: 0; color: rgb(255 255 255 / 0.9);">{{ config('shop.name') }}</p>
        </div>
        <div class="demo-gateway-body">
            <p class="demo-note">
                این درگاه فقط برای نمایش است و هیچ پولی جابه‌جا نمی‌شود. پس از اتصال درگاه بانکی واقعی، این صفحه حذف می‌شود.
            </p>

            <div class="row"><span>شماره سفارش</span><strong dir="ltr">{{ $order->order_number }}</strong></div>
            <div class="row"><span>پذیرنده</span><strong>{{ config('shop.name') }}</strong></div>
            <div class="row"><span>مبلغ قابل پرداخت</span><strong>{{ fa_price($order->amount) }}</strong></div>

            <div class="demo-gateway-actions">
                <form method="POST" action="{{ route('payment.demo.callback', $order) }}">
                    @csrf
                    <input type="hidden" name="result" value="success">
                    <button type="submit" class="btn btn-primary">پرداخت موفق</button>
                </form>
                <form method="POST" action="{{ route('payment.demo.callback', $order) }}">
                    @csrf
                    <input type="hidden" name="result" value="cancel">
                    <button type="submit" class="btn btn-danger">انصراف</button>
                </form>
            </div>
        </div>
    </div>
</main>
@endsection
