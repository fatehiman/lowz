@extends('layouts.app')

@section('title', $title)
@section('meta_description', $meta_description ?? 'اطلاعات ارسال سفارش خود را وارد کنید.')
@section('robots', 'noindex, follow')

@section('content')
<div class="page-section">
    <h1>ثبت سفارش</h1>

    @if ($errors->any())
        <div class="alert alert-error">
            <ul style="padding-inline-start: 1.25rem; list-style: disc;">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div id="checkout-empty" style="display:none;">
        <div class="text-center" style="padding-block: 3rem;">
            <p style="font-size: 1.125rem; color: var(--color-text-light);">سبد خرید شما خالی است.</p>
            <a href="{{ route('home') }}" class="btn btn-primary" style="margin-block-start: 1rem;">بازگشت به فروشگاه</a>
        </div>
    </div>

    <div id="checkout-content" class="checkout-layout" style="display:none;">
        <form method="POST" action="{{ route('checkout.store') }}" class="app-form" id="checkoutForm">
            @csrf
            <input type="hidden" name="cart_json" id="cartJson">

            <div class="form-group">
                <label for="name">نام و نام خانوادگی</label>
                <input type="text" id="name" name="name" value="{{ old('name') }}" required>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label for="phone">شماره موبایل</label>
                    <input type="text" id="phone" name="phone" value="{{ old('phone') }}" dir="ltr" placeholder="09123456789" required pattern="09[0-9]{9}">
                </div>
                <div class="form-group">
                    <label for="email">ایمیل <small>(اختیاری)</small></label>
                    <input type="email" id="email" name="email" value="{{ old('email') }}" dir="ltr">
                </div>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label for="province_id">استان</label>
                    <select id="province_id" name="province_id" required>
                        <option value="">انتخاب کنید</option>
                        @foreach ($provinces as $province)
                            <option value="{{ $province->id }}" @selected(old('province_id') == $province->id)>{{ $province->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="city_id">شهر</label>
                    <select id="city_id" name="city_id" required disabled>
                        <option value="">ابتدا استان را انتخاب کنید</option>
                    </select>
                </div>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label for="postcode">کد پستی <small>(اختیاری)</small></label>
                    <input type="text" id="postcode" name="postcode" value="{{ old('postcode') }}" dir="ltr">
                </div>
            </div>

            <div class="form-group">
                <label for="address">آدرس کامل</label>
                <textarea id="address" name="address" rows="4" required>{{ old('address') }}</textarea>
            </div>

            <div id="checkout-min-warning" class="alert alert-error" style="display:none;"></div>

            <div style="display: flex; align-items: center; gap: 0.75rem;">
                <button type="submit" id="checkoutSubmitBtn" class="btn btn-primary">ادامه و پرداخت</button>
                <button type="button" id="proformaBtn" class="btn btn-outline" style="padding-block: 0.5rem; padding-inline: 1rem; font-size: 0.8125rem;">پیش‌فاکتور</button>
            </div>
        </form>

        <aside class="checkout-summary">
            <h2 class="mb-2">خلاصه سفارش</h2>
            <div id="checkoutItems"></div>
            <div id="checkoutExtraRows"></div>
            <div class="checkout-summary-total">
                <span>مبلغ قابل پرداخت</span>
                <span id="checkoutTotal">0 تومان</span>
            </div>
        </aside>
    </div>
</div>

@section('extra_js')
<script>
(function () {
    const CART_KEY = 'lowz_cart';

    function getCart() {
        try {
            const raw = localStorage.getItem(CART_KEY);
            return raw ? JSON.parse(raw) : {};
        } catch (e) {
            return {};
        }
    }

    function faPrice(amount) {
        return new Intl.NumberFormat('fa-IR').format(amount) + ' تومان';
    }

    function faDigits(amount) {
        return new Intl.NumberFormat('fa-IR').format(amount);
    }

    let orderItems = [];
    let orderTotal = 0;
    let pricingData = null;

    const cart = getCart();
    document.getElementById('cartJson').value = JSON.stringify(cart);

    const productIds = Object.keys(cart).filter((id) => cart[id] > 0);
    if (productIds.length === 0) {
        document.getElementById('checkout-empty').style.display = 'block';
        return;
    }

    fetch('{{ route('cart.data') }}', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
            'Accept': 'application/json',
        },
        body: JSON.stringify({ cart: cart }),
    })
        .then((res) => res.json())
        .then((data) => {
            if (!data.items || data.items.length === 0) {
                document.getElementById('checkout-empty').style.display = 'block';
                return;
            }

            const list = document.getElementById('checkoutItems');
            data.items.forEach((item) => {
                const row = document.createElement('div');
                row.className = 'checkout-summary-item';
                row.innerHTML = `<span>${item.name} × ${item.quantity}</span><span>${faPrice(item.subtotal)}</span>`;
                list.appendChild(row);
            });

            const extraRows = document.getElementById('checkoutExtraRows');
            if (data.packing) {
                const row = document.createElement('div');
                row.className = 'checkout-summary-item';
                row.innerHTML = `<span>بسته‌بندی (${faDigits(data.packing.quantity)} × ${faPrice(data.packing.price)})</span><span>${faPrice(data.packing.subtotal)}</span>`;
                extraRows.appendChild(row);
            }
            if (data.vat_amount > 0) {
                const row = document.createElement('div');
                row.className = 'checkout-summary-item';
                row.innerHTML = `<span>مالیات بر ارزش افزوده</span><span>${faPrice(data.vat_amount)}</span>`;
                extraRows.appendChild(row);
            }

            document.getElementById('checkoutTotal').textContent = faPrice(data.grand_total);
            document.getElementById('checkout-content').style.display = 'grid';

            const warningEl = document.getElementById('checkout-min-warning');
            const submitBtn = document.getElementById('checkoutSubmitBtn');
            if (!data.meets_minimum) {
                warningEl.style.display = 'block';
                warningEl.innerHTML = `<p>حداقل تعداد اقلام قابل سفارش ${faDigits(data.min_order_items)} عدد است. تعداد فعلی سبد شما ${faDigits(data.total_quantity)} عدد است؛ برای ثبت سفارش، اقلام بیشتری اضافه کنید.</p>`;
                submitBtn.disabled = true;
            } else {
                warningEl.style.display = 'none';
                submitBtn.disabled = false;
            }

            orderItems = data.items;
            orderTotal = data.total_price;
            pricingData = data;
        })
        .catch(() => {
            document.getElementById('checkout-empty').style.display = 'block';
        });

    const provinceSelect = document.getElementById('province_id');
    const citySelect = document.getElementById('city_id');

    provinceSelect.addEventListener('change', function () {
        const provinceId = this.value;
        citySelect.innerHTML = '<option value="">در حال بارگذاری...</option>';
        citySelect.disabled = true;

        if (!provinceId) {
            citySelect.innerHTML = '<option value="">ابتدا استان را انتخاب کنید</option>';
            return;
        }

        fetch('/locations/cities/' + provinceId)
            .then((res) => res.json())
            .then((cities) => {
                citySelect.innerHTML = '<option value="">انتخاب کنید</option>';
                cities.forEach((city) => {
                    const opt = document.createElement('option');
                    opt.value = city.id;
                    opt.textContent = city.name;
                    citySelect.appendChild(opt);
                });
                citySelect.disabled = false;
            });
    });

    document.getElementById('proformaBtn').addEventListener('click', function () {
        const form = document.getElementById('checkoutForm');
        if (!form.reportValidity()) {
            return;
        }

        if (!orderItems.length) {
            return;
        }

        const proformaData = {
            name: document.getElementById('name').value,
            phone: document.getElementById('phone').value,
            province: provinceSelect.options[provinceSelect.selectedIndex]?.text || '',
            city: citySelect.options[citySelect.selectedIndex]?.text || '',
            postcode: document.getElementById('postcode').value,
            address: document.getElementById('address').value,
            items: orderItems,
            total_price: orderTotal,
            total_quantity: pricingData ? pricingData.total_quantity : 0,
            packing: pricingData ? pricingData.packing : null,
            vat_amount: pricingData ? pricingData.vat_amount : 0,
            vat_percent: pricingData ? pricingData.vat_percent : 0,
            grand_total: pricingData ? pricingData.grand_total : orderTotal,
        };

        try {
            localStorage.setItem('lowz_proforma', JSON.stringify(proformaData));
        } catch (e) {
            return;
        }

        window.open('{{ route('checkout.proforma') }}', '_blank');
    });
})();
</script>
@endsection
@endsection
