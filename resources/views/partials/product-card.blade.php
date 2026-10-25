<article class="product-card" data-product-id="{{ $product->id }}" data-product-name="{{ $product->name }}" data-product-price="{{ $product->price }}" data-min-quantity="{{ $product->min_quantity }}" data-quantity-step="{{ $product->quantity_step }}" data-product-image="{{ asset($product->image) }}">
    <a href="{{ route('product.show', $product) }}" class="product-card-image">
        <img src="{{ asset($product->image) }}" alt="{{ \Illuminate\Support\Str::squish($product->name) }}" loading="lazy" decoding="async" width="300" height="300">
    </a>
    <div class="product-card-body">
        <div class="product-card-meta">
            @if ($product->category)
                <a href="{{ route('category.show', $product->category) }}">{{ $product->category->name }}</a>
            @endif
            @if ($product->unit)
                <span>{{ $product->unit }}</span>
            @endif
        </div>
        <h2><a href="{{ route('product.show', $product) }}">{{ $product->name }}</a></h2>
        <p>{{ $product->short_description }}</p>
        <div class="product-card-footer">
            <span class="price">{{ fa_price($product->price) }}</span>
            <div class="cart-controls" id="cart-controls-{{ $product->id }}">
                <button type="button" class="btn btn-primary cart-add" data-product-id="{{ $product->id }}">افزودن به سبد</button>
                <div class="cart-quantity" style="display:none;">
                    <button type="button" class="btn btn-outline cart-decrease" data-product-id="{{ $product->id }}">-</button>
                    <span class="cart-quantity-value">{{ $product->min_quantity }}</span>
                    <button type="button" class="btn btn-outline cart-increase" data-product-id="{{ $product->id }}">+</button>
                </div>
            </div>
        </div>
    </div>
</article>
