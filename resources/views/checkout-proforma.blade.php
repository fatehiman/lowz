@extends('layouts.bare')

@section('title', 'پیش‌فاکتور — '.config('shop.name'))

@section('content')
<div class="proforma" id="proforma">
    <div class="proforma-header">
        <img src="{{ versioned_asset('images/logo.svg') }}" alt="{{ config('shop.name') }}" class="proforma-logo">
        <div>
            <h1>پیش‌فاکتور فروش</h1>
            <div class="proforma-date" id="proformaDate"></div>
        </div>
    </div>

    <table class="proforma-parties">
        <tr>
            <th>خریدار</th>
            <td id="buyerLine"></td>
        </tr>
        <tr>
            <th>فروشنده</th>
            <td>{{ $sellerInfo }}</td>
        </tr>
    </table>

    <table class="proforma-items">
        <thead>
            <tr>
                <th>ردیف</th>
                <th>شرح کالا</th>
                <th>تعداد</th>
                <th>قیمت واحد (تومان)</th>
                <th>قیمت کل (تومان)</th>
            </tr>
        </thead>
        <tbody id="proformaItems"></tbody>
        <tfoot id="proformaFoot">
            <tr>
                <td colspan="2">جمع کل</td>
                <td id="proformaTotalQty">0</td>
                <td></td>
                <td id="proformaTotal">0</td>
            </tr>
        </tfoot>
    </table>

    @if ($paymentNote)
        <p class="proforma-note">{{ $paymentNote }}</p>
    @endif
</div>

<style>
    body { background: #fff; }
    .proforma { max-width: 800px; margin: 2rem auto; padding: 1.5rem; }
    .proforma-header { display: flex; align-items: center; gap: 0.75rem; margin-block-end: 1rem; }
    .proforma-logo { width: 48px; height: 48px; flex-shrink: 0; }
    .proforma-header h1 { font-size: 1.25rem; margin: 0 0 0.25rem; }
    .proforma-date { color: #666; font-size: 0.875rem; }
    .proforma-parties { width: 100%; border-collapse: collapse; margin-block-end: 1.5rem; }
    .proforma-parties th, .proforma-parties td { border: 1px solid #000; padding: 0.5rem 0.75rem; font-size: 0.9rem; text-align: start; vertical-align: middle; }
    .proforma-parties th { width: 6.5rem; white-space: nowrap; background: #f7f7f7; font-weight: 700; }
    .proforma-items { width: 100%; border-collapse: collapse; margin-block: 1rem; }
    .proforma-items th, .proforma-items td { border: 1px solid #000; padding: 0.5rem; text-align: center; font-size: 0.875rem; }
    .proforma-items tfoot td { font-weight: 700; }
    .proforma-note { margin-block-start: 1.5rem; font-size: 0.875rem; background: #fff8e1; padding: 0.75rem 1rem; border-radius: 0.5rem; }
</style>

<script>
(function () {
    function faPrice(amount) {
        return new Intl.NumberFormat('en-US').format(amount || 0);
    }

    let data = {};
    try {
        data = JSON.parse(localStorage.getItem('lowz_proforma') || '{}');
    } catch (e) {
        data = {};
    }

    document.getElementById('proformaDate').textContent = new Intl.DateTimeFormat('fa-IR').format(new Date());

    const addressParts = [data.province, data.city, data.address].filter(Boolean).join('، ');
    const buyerLine = `${data.name || ''} (${data.phone || ''}) ${addressParts}${data.postcode ? ' (کدپستی: ' + data.postcode + ')' : ''}`;
    document.getElementById('buyerLine').textContent = buyerLine;

    const tbody = document.getElementById('proformaItems');
    let rowIndex = 0;
    (data.items || []).forEach((item) => {
        rowIndex += 1;
        const tr = document.createElement('tr');
        tr.innerHTML = `<td>${rowIndex}</td><td>${item.name}</td><td>${item.quantity}</td><td>${faPrice(item.price)}</td><td>${faPrice(item.subtotal)}</td>`;
        tbody.appendChild(tr);
    });

    if (data.packing) {
        rowIndex += 1;
        const tr = document.createElement('tr');
        tr.innerHTML = `<td>${rowIndex}</td><td>بسته‌بندی</td><td>${data.packing.quantity}</td><td>${faPrice(data.packing.price)}</td><td>${faPrice(data.packing.subtotal)}</td>`;
        tbody.appendChild(tr);
    }

    const foot = document.getElementById('proformaFoot');
    if (data.vat_amount > 0) {
        const vatRow = document.createElement('tr');
        vatRow.innerHTML = `<td colspan="4">مالیات بر ارزش افزوده</td><td>${faPrice(data.vat_amount)}</td>`;
        foot.insertBefore(vatRow, foot.firstElementChild);
    }

    document.getElementById('proformaTotalQty').textContent = data.total_quantity ?? 0;
    document.getElementById('proformaTotal').textContent = faPrice(data.grand_total !== undefined ? data.grand_total : data.total_price);
})();
</script>
@endsection
