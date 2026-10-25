@extends('layouts.app')

@php
    $pageSeo = \App\Models\PageSeo::for('cart');
@endphp

@section('title', $pageSeo->title)
@section('meta_description', $pageSeo->meta_description)
@section('robots', 'noindex, follow')

@section('content')
<div class="page-section">
    <h1>سبد خرید</h1>

    @if ($errors->any())
        <div class="alert alert-error">
            @foreach ($errors->all() as $error)
                <p>{{ $error }}</p>
            @endforeach
        </div>
    @endif

    <div id="cart-loading" class="text-center" style="padding-block: 2rem;">
        <p>در حال بارگذاری سبد خرید...</p>
    </div>

    <div id="cart-empty" style="display:none;">
        <div class="text-center" style="padding-block: 4rem;">
            <p style="font-size: 1.125rem; color: var(--color-text-light);">سبد خرید شما خالی است.</p>
            <a href="{{ route('home') }}" class="btn btn-primary" style="margin-block-start: 1rem;">بازگشت به فروشگاه</a>
        </div>
    </div>

    <div id="cart-items-wrapper" style="display:none;">
        <div id="cart-items"></div>

        <div id="cart-min-warning" class="alert alert-error" style="display:none;"></div>

        <div id="cart-summary">
            <div class="cart-summary" id="cart-summary-rows"></div>
            <div class="text-center" style="margin-block-start: 1.5rem;">
                <a href="{{ route('checkout') }}" id="cart-continue-btn" class="btn btn-primary" style="padding-block: 0.75rem; padding-inline: 2rem; font-size: 1rem;">ادامه</a>
            </div>
        </div>
    </div>
</div>
@endsection
