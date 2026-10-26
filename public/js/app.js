/**
 * عطاری لوز — app.js
 * Vanilla JS, no dependencies.
 */

(function () {
    'use strict';

    // ---------- CSRF token ----------
    function csrfToken() {
        const meta = document.querySelector('meta[name="csrf-token"]');
        return meta ? meta.getAttribute('content') : '';
    }

    // ---------- Fetch helper ----------
    async function fetchJson(url, options = {}) {
        const defaults = {
            method: 'GET',
            headers: {
                'X-CSRF-TOKEN': csrfToken(),
                'Accept': 'application/json',
                'Content-Type': 'application/json',
            },
        };

        const config = Object.assign({}, defaults, options, {
            headers: Object.assign({}, defaults.headers, options.headers || {}),
        });

        if (config.body && typeof config.body === 'object' && !(config.body instanceof FormData)) {
            config.body = JSON.stringify(config.body);
        }

        const response = await fetch(url, config);

        if (!response.ok) {
            const text = await response.text();
            throw new Error(`HTTP ${response.status}: ${text}`);
        }

        const contentType = response.headers.get('content-type') || '';
        if (contentType.includes('application/json')) {
            return response.json();
        }

        return response.text();
    }

    // ---------- Hamburger menu ----------
    function initHamburger() {
        const btn = document.getElementById('hamburger');
        const nav = document.getElementById('mainNav');

        if (!btn || !nav) return;

        btn.addEventListener('click', () => {
            const expanded = btn.getAttribute('aria-expanded') === 'true';
            btn.setAttribute('aria-expanded', String(!expanded));
            nav.classList.toggle('open');
        });

        // Close menu when clicking outside
        document.addEventListener('click', (e) => {
            if (!btn.contains(e.target) && !nav.contains(e.target)) {
                btn.setAttribute('aria-expanded', 'false');
                nav.classList.remove('open');
            }
        });
    }

    // ---------- Cart ----------
    const CART_KEY = 'lowz_cart';

    function getCart() {
        try {
            const raw = localStorage.getItem(CART_KEY);
            return raw ? JSON.parse(raw) : {};
        } catch (e) {
            return {};
        }
    }

    function saveCart(cart) {
        localStorage.setItem(CART_KEY, JSON.stringify(cart));
    }

    function getCartTotals() {
        const cart = getCart();
        let totalQuantity = 0;
        let totalPrice = 0;
        return { cart, totalQuantity, totalPrice };
    }

    async function syncCart() {
        const cart = getCart();
        const productIds = Object.keys(cart).map(Number).filter((id) => cart[id] > 0);

        if (productIds.length === 0) {
            return { items: [], totalQuantity: 0, totalPrice: 0 };
        }

        try {
            const data = await fetchJson(`/cart/data`, {
                method: 'POST',
                body: { cart },
            });

            // Clean up localStorage to match server state
            const validIds = (data.items || []).map((item) => item.id);
            const cleanedCart = {};
            validIds.forEach((id) => {
                if (cart[id]) {
                    cleanedCart[id] = cart[id];
                }
            });
            saveCart(cleanedCart);

            return data;
        } catch (err) {
            console.error(err);
            return { items: [], totalQuantity: 0, totalPrice: 0 };
        }
    }

    function updateBasketIcon() {
        syncCart().then((data) => {
            const countEl = document.getElementById('basketCount');
            const priceEl = document.getElementById('basketPrice');

            if (countEl) {
                countEl.textContent = data.total_quantity;
                countEl.style.display = data.total_quantity > 0 ? 'inline-flex' : 'none';
            }

            if (priceEl) {
                if (data.total_price > 0) {
                    priceEl.textContent = faPrice(data.total_price);
                    priceEl.style.visibility = 'visible';
                } else {
                    priceEl.style.visibility = 'hidden';
                }
            }
        });
    }

    function faPrice(amount) {
        const persian = ['۰', '۱', '۲', '۳', '۴', '۵', '۶', '۷', '۸', '۹'];
        const formatted = Number(amount).toLocaleString('en-US');
        const result = String(formatted).replace(/[0-9]/g, (d) => persian[parseInt(d, 10)]);
        return result + ' تومان';
    }

    function setCartControls(productId, quantity) {
        const controls = document.getElementById(`cart-controls-${productId}`);
        if (!controls) return;

        const card = controls.closest('.product-card');
        const minQuantity = card ? (parseInt(card.dataset.minQuantity, 10) || 1) : 1;

        const addBtn = controls.querySelector('.cart-add');
        const qtyDiv = controls.querySelector('.cart-quantity');
        const qtyValue = controls.querySelector('.cart-quantity-value');
        const decreaseBtn = controls.querySelector('.cart-decrease');

        if (quantity > 0) {
            if (addBtn) addBtn.style.display = 'none';
            if (qtyDiv) qtyDiv.style.display = 'inline-flex';
            if (qtyValue) qtyValue.textContent = quantity;
            if (decreaseBtn) decreaseBtn.disabled = false;
        } else {
            if (addBtn) addBtn.style.display = 'inline-flex';
            if (qtyDiv) qtyDiv.style.display = 'none';
            if (qtyValue) qtyValue.textContent = String(minQuantity);
        }
    }

    function refreshAllCartControls() {
        const cart = getCart();
        document.querySelectorAll('.product-card').forEach((card) => {
            const productId = card.getAttribute('data-product-id');
            if (productId) {
                setCartControls(productId, cart[productId] || 0);
            }
        });
    }

    async function addToCart(productId, quantity = 1) {
        const card = document.querySelector(`.product-card[data-product-id="${productId}"]`);
        const btn = card ? card.querySelector('.cart-add') : null;
        const originalText = btn ? btn.textContent : '';

        if (btn) {
            btn.disabled = true;
            btn.textContent = 'در حال افزودن...';
        }

        try {
            const data = await fetchJson(`/cart/add`, {
                method: 'POST',
                body: { product_id: productId, quantity },
            });

            if (data.error) {
                throw new Error(data.error);
            }

            const cart = getCart();
            const currentQty = cart[productId] || 0;
            cart[productId] = currentQty + quantity;
            saveCart(cart);

            setCartControls(productId, cart[productId]);
            updateBasketIcon();
        } catch (err) {
            console.error(err);
            alert('خطا در افزودن به سبد خرید');
        } finally {
            if (btn) {
                btn.disabled = false;
                btn.textContent = originalText;
            }
        }
    }

    async function updateCartItem(productId, quantity) {
        const card = document.querySelector(`.product-card[data-product-id="${productId}"]`);
        const controls = card ? card.querySelector('.cart-quantity') : null;
        const qtyValue = card ? card.querySelector('.cart-quantity-value') : null;

        if (controls) controls.style.opacity = '0.6';

        try {
            const data = await fetchJson(`/cart/update`, {
                method: 'POST',
                body: { product_id: productId, quantity },
            });

            if (data.error) {
                throw new Error(data.error);
            }

            const cart = getCart();

            if (quantity <= 0 || data.removed) {
                delete cart[productId];
                saveCart(cart);
                setCartControls(productId, 0);
            } else {
                cart[productId] = quantity;
                saveCart(cart);
                setCartControls(productId, quantity);
            }

            updateBasketIcon();

            if (document.getElementById('cart-items')) {
                renderCartPage();
            }
        } catch (err) {
            console.error(err);
            alert('خطا در به‌روزرسانی سبد خرید');
        } finally {
            if (controls) controls.style.opacity = '1';
        }
    }

    async function removeFromCart(productId) {
        try {
            const data = await fetchJson(`/cart/remove`, {
                method: 'POST',
                body: { product_id: productId },
            });

            if (data.error) {
                throw new Error(data.error);
            }

            const cart = getCart();
            delete cart[productId];
            saveCart(cart);

            setCartControls(productId, 0);
            updateBasketIcon();

            if (document.getElementById('cart-items')) {
                renderCartPage();
            }
        } catch (err) {
            console.error(err);
            alert('خطا در حذف از سبد خرید');
        }
    }

    function renderCartSummary(data) {
        const rowsEl = document.getElementById('cart-summary-rows');
        const warningEl = document.getElementById('cart-min-warning');
        const continueBtn = document.getElementById('cart-continue-btn');

        if (rowsEl) {
            let rowsHtml = `
                <div class="cart-summary-row">
                    <span>جمع کالاها:</span>
                    <span>${faPrice(data.total_price)}</span>
                </div>
            `;

            if (data.packing) {
                rowsHtml += `
                    <div class="cart-summary-row">
                        <span>بسته‌بندی (${fa_digits(data.packing.quantity)} × ${faPrice(data.packing.price)}):</span>
                        <span>${faPrice(data.packing.subtotal)}</span>
                    </div>
                `;
            }

            if (data.vat_amount > 0) {
                rowsHtml += `
                    <div class="cart-summary-row">
                        <span>مالیات بر ارزش افزوده:</span>
                        <span>${faPrice(data.vat_amount)}</span>
                    </div>
                `;
            }

            rowsHtml += `
                <div class="cart-summary-row cart-summary-total">
                    <span>مبلغ قابل پرداخت:</span>
                    <span>${faPrice(data.grand_total)}</span>
                </div>
            `;

            rowsEl.innerHTML = rowsHtml;
        }

        if (warningEl) {
            if (!data.meets_minimum) {
                warningEl.style.display = 'block';
                warningEl.innerHTML = `<p>حداقل تعداد اقلام قابل سفارش ${fa_digits(data.min_order_items)} عدد است. تعداد فعلی سبد شما ${fa_digits(data.total_quantity)} عدد است؛ برای ثبت سفارش، اقلام بیشتری اضافه کنید.</p>`;
            } else {
                warningEl.style.display = 'none';
                warningEl.innerHTML = '';
            }
        }

        if (continueBtn) {
            if (!data.meets_minimum) {
                continueBtn.setAttribute('aria-disabled', 'true');
                continueBtn.classList.add('btn-disabled');
            } else {
                continueBtn.removeAttribute('aria-disabled');
                continueBtn.classList.remove('btn-disabled');
            }
        }
    }

    function fa_digits(amount) {
        const persian = ['۰', '۱', '۲', '۳', '۴', '۵', '۶', '۷', '۸', '۹'];
        return String(amount).replace(/[0-9]/g, (d) => persian[parseInt(d, 10)]);
    }

    function renderCartPage() {
        const itemsContainer = document.getElementById('cart-items');
        const loadingEl = document.getElementById('cart-loading');
        const emptyEl = document.getElementById('cart-empty');
        const wrapperEl = document.getElementById('cart-items-wrapper');
        const summaryEl = document.getElementById('cart-summary');

        if (!itemsContainer) return;

        syncCart().then((data) => {
            if (data.items.length === 0) {
                if (loadingEl) loadingEl.style.display = 'none';
                if (emptyEl) emptyEl.style.display = 'block';
                if (wrapperEl) wrapperEl.style.display = 'none';
                return;
            }

            if (loadingEl) loadingEl.style.display = 'none';
            if (emptyEl) emptyEl.style.display = 'none';
            if (wrapperEl) wrapperEl.style.display = 'block';
            if (summaryEl) summaryEl.style.display = 'block';

            const items = data.items;
            let html = '<div class="cart-items-list">';

            items.forEach((item) => {
                html += `
                    <div class="cart-item" data-product-id="${item.id}">
                        <div class="cart-item-image">
                            <img src="${item.image}" alt="${item.name}" width="80" height="80">
                        </div>
                        <div class="cart-item-details">
                            <h3>${item.name}</h3>
                            <p class="cart-item-price">${faPrice(item.price)}</p>
                        </div>
                        <div class="cart-item-quantity">
                            <button type="button" class="btn btn-outline cart-page-decrease" data-product-id="${item.id}" data-min-quantity="${item.min_quantity}" data-quantity-step="${item.quantity_step}">-</button>
                            <span class="cart-quantity-value">${item.quantity}</span>
                            <button type="button" class="btn btn-outline cart-page-increase" data-product-id="${item.id}" data-quantity-step="${item.quantity_step}">+</button>
                        </div>
                        <div class="cart-item-subtotal">
                            <span>${faPrice(item.subtotal)}</span>
                        </div>
                        <div class="cart-item-remove">
                            <button type="button" class="btn btn-outline cart-page-remove" data-product-id="${item.id}">حذف</button>
                        </div>
                    </div>
                `;
            });

            html += '</div>';
            itemsContainer.innerHTML = html;

            renderCartSummary(data);

            // Attach event listeners
            itemsContainer.querySelectorAll('.cart-page-decrease').forEach((btn) => {
                btn.addEventListener('click', () => {
                    const pid = Number(btn.getAttribute('data-product-id'));
                    const minQuantity = parseInt(btn.getAttribute('data-min-quantity'), 10) || 1;
                    const step = parseInt(btn.getAttribute('data-quantity-step'), 10) || 1;
                    const qty = getCart()[pid] || 0;
                    // At the minimum quantity the minus button removes the product.
                    if (qty <= minQuantity) {
                        removeFromCart(pid);
                        return;
                    }
                    updateCartItem(pid, qty - step);
                });
            });

            itemsContainer.querySelectorAll('.cart-page-increase').forEach((btn) => {
                btn.addEventListener('click', () => {
                    const pid = Number(btn.getAttribute('data-product-id'));
                    const step = parseInt(btn.getAttribute('data-quantity-step'), 10) || 1;
                    const qty = getCart()[pid] || 0;
                    updateCartItem(pid, qty + step);
                });
            });

            itemsContainer.querySelectorAll('.cart-page-remove').forEach((btn) => {
                btn.addEventListener('click', () => {
                    const pid = Number(btn.getAttribute('data-product-id'));
                    removeFromCart(pid);
                });
            });
        }).catch((err) => {
            console.error(err);
            if (loadingEl) loadingEl.innerHTML = '<p style="color: red;">خطا در بارگذاری سبد خرید</p>';
        });
    }

    function initCart() {
        updateBasketIcon();
        refreshAllCartControls();

        // Product card add buttons
        document.querySelectorAll('.cart-add').forEach((btn) => {
            btn.addEventListener('click', () => {
                const productId = Number(btn.getAttribute('data-product-id'));
                const card = btn.closest('.product-card');
                const minQuantity = card ? (parseInt(card.dataset.minQuantity, 10) || 1) : 1;
                addToCart(productId, minQuantity);
            });
        });

        // Product card increase buttons
        document.querySelectorAll('.cart-increase').forEach((btn) => {
            btn.addEventListener('click', () => {
                const productId = Number(btn.getAttribute('data-product-id'));
                const card = btn.closest('.product-card');
                const step = card ? (parseInt(card.dataset.quantityStep, 10) || 1) : 1;
                const qty = getCart()[productId] || 0;
                updateCartItem(productId, qty + step);
            });
        });

        // Product card decrease buttons
        document.querySelectorAll('.cart-decrease').forEach((btn) => {
            btn.addEventListener('click', () => {
                const productId = Number(btn.getAttribute('data-product-id'));
                const card = btn.closest('.product-card');
                const minQuantity = card ? (parseInt(card.dataset.minQuantity, 10) || 1) : 1;
                const step = card ? (parseInt(card.dataset.quantityStep, 10) || 1) : 1;
                const qty = getCart()[productId] || 0;
                // At the minimum quantity the minus button removes the product.
                if (qty <= minQuantity) {
                    removeFromCart(productId);
                    return;
                }
                updateCartItem(productId, qty - step);
            });
        });

        // Cart page
        if (document.getElementById('cart-items')) {
            renderCartPage();
        }
    }

    // ---------- Initialize ----------
    document.addEventListener('DOMContentLoaded', () => {
        initHamburger();
        initCart();
    });

    // Expose helpers globally for later phases
    window.app = {
        csrfToken,
        fetchJson,
        getCart,
        saveCart,
        updateBasketIcon,
        addToCart,
        updateCartItem,
        removeFromCart,
        faPrice,
    };
})();
