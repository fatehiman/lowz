@extends('layouts.app')

@section('title', $title)
@section('meta_description', $meta_description)
@section('canonical', route('contact'))

@section('content')
<div class="page-section">
    <h1>تماس با ما</h1>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="contact-grid">
        <div class="contact-form-card">
            <h2 class="mb-2">ارسال پیام</h2>
            <form method="POST" action="{{ route('contact.submit') }}" class="app-form">
                @csrf
                <div class="form-group">
                    <label for="name">نام و نام خانوادگی</label>
                    <input type="text" id="name" name="name" value="{{ old('name') }}" required>
                    @error('name') <span class="field-error">{{ $message }}</span> @enderror
                </div>

                <div class="form-group">
                    <label for="email">ایمیل</label>
                    <input type="email" id="email" name="email" value="{{ old('email') }}" required>
                    @error('email') <span class="field-error">{{ $message }}</span> @enderror
                </div>

                <div class="form-group">
                    <label for="phone">شماره تماس <small>(اختیاری)</small></label>
                    <input type="text" id="phone" name="phone" value="{{ old('phone') }}" dir="ltr">
                    @error('phone') <span class="field-error">{{ $message }}</span> @enderror
                </div>

                <div class="form-group">
                    <label for="subject">موضوع <small>(اختیاری)</small></label>
                    @php($currentSubject = old('subject', $selectedSubject))
                    <select id="subject" name="subject">
                        <option value="">یک موضوع را انتخاب کنید</option>
                        @foreach ($subjects as $key => $label)
                            <option value="{{ $key }}" @selected($currentSubject === $key)>{{ $label }}</option>
                        @endforeach
                    </select>
                    @error('subject') <span class="field-error">{{ $message }}</span> @enderror
                </div>

                <div class="form-group">
                    <label for="message">پیام</label>
                    <textarea id="message" name="message" rows="5" required>{{ old('message') }}</textarea>
                    @error('message') <span class="field-error">{{ $message }}</span> @enderror
                </div>

                <div class="form-group">
                    <label for="captcha">کد امنیتی تصویر را وارد کنید</label>
                    <div class="captcha-row">
                        <img src="{{ route('contact.captcha') }}" alt="کد امنیتی" class="captcha-image" id="captchaImage">
                        <button type="button" class="btn btn-outline captcha-refresh" id="captchaRefresh" aria-label="کد جدید">↻</button>
                    </div>
                    <input type="text" id="captcha" name="captcha" required autocomplete="off" inputmode="numeric" placeholder="حاصل جمع را وارد کنید">
                    @error('captcha') <span class="field-error">{{ $message }}</span> @enderror
                </div>

                <button type="submit" class="btn btn-primary">ارسال پیام</button>
            </form>
        </div>

        <div class="contact-info-card">
            <h2 class="mb-2">راه‌های ارتباطی</h2>
            <ul class="contact-info-list">
                <li class="contact-info-item">
                    <span class="contact-icon contact-icon-address" aria-hidden="true">
                        <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M12 22s7-7.58 7-12.5A7 7 0 0 0 5 9.5C5 14.42 12 22 12 22Z" fill="#ef4444"/>
                            <circle cx="12" cy="9.5" r="2.5" fill="#fff"/>
                        </svg>
                    </span>
                    <div>
                        <strong>نشانی فروشگاه</strong>
                        <p>{{ config('shop.address') }}</p>
                        <p>{{ config('shop.hours') }}</p>
                    </div>
                </li>
                @if (config('shop.phone') || config('shop.mobile'))
                <li class="contact-info-item">
                    <span class="contact-icon contact-icon-phone" aria-hidden="true">
                        <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M6.6 10.8c1.4 2.8 3.8 5.2 6.6 6.6l2.2-2.2c.3-.3.7-.4 1.1-.2 1.2.4 2.5.6 3.8.6.6 0 1 .4 1 1V20c0 .6-.4 1-1 1C10.6 21 3 13.4 3 4c0-.6.4-1 1-1h3.4c.6 0 1 .4 1 1 0 1.3.2 2.6.6 3.8.1.4 0 .8-.2 1.1L6.6 10.8Z" fill="#22c55e"/>
                        </svg>
                    </span>
                    <div>
                        <strong>تلفن</strong>
                        @if (config('shop.phone'))
                            <p dir="ltr"><a href="tel:{{ preg_replace('/[^\d+]/', '', config('shop.phone')) }}">{{ config('shop.phone') }}</a></p>
                        @endif
                        @if (config('shop.mobile'))
                            <p dir="ltr"><a href="tel:{{ config('shop.mobile') }}">{{ config('shop.mobile') }}</a></p>
                        @endif
                    </div>
                </li>
                @endif
                <li class="contact-info-item">
                    <span class="contact-icon contact-icon-email" aria-hidden="true">
                        <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <rect x="2" y="4" width="20" height="16" rx="3" fill="#3b82f6"/>
                            <path d="m4 6 8 6 8-6" stroke="#fff" stroke-width="1.5" fill="none" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </span>
                    <div>
                        <strong>ایمیل</strong>
                        <p><a id="email-obfuscated" data-user="{{ \Illuminate\Support\Str::before(config('shop.email'), '@') }}" data-domain="{{ \Illuminate\Support\Str::after(config('shop.email'), '@') }}"></a></p>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</div>

@section('extra_js')
<script>
(function () {
    const emailEl = document.getElementById('email-obfuscated');
    if (emailEl) {
        const user = emailEl.getAttribute('data-user') || '';
        const domain = emailEl.getAttribute('data-domain') || '';
        emailEl.textContent = user + '@' + domain;
        emailEl.setAttribute('href', 'mailto:' + user + '@' + domain);
    }

    const captchaImg = document.getElementById('captchaImage');
    const refreshBtn = document.getElementById('captchaRefresh');
    if (captchaImg && refreshBtn) {
        refreshBtn.addEventListener('click', function () {
            captchaImg.src = captchaImg.src.split('?')[0] + '?t=' + Date.now();
        });
    }
})();
</script>
@endsection
@endsection
