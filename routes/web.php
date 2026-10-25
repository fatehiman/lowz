<?php

use App\Http\Controllers\BlogController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LocationController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\PreviewController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SitemapController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/sitemap.xml', [SitemapController::class, 'index'])->name('sitemap');
Route::get('/robots.txt', [SitemapController::class, 'robots'])->name('robots');

// Secret preview link while the site is "under construction" (token in .env).
Route::get('/preview/{token}', [PreviewController::class, 'enable'])->name('preview');
Route::get('/preview/{token}/off', [PreviewController::class, 'disable'])->name('preview.off');

Route::get('/shop', [ProductController::class, 'index'])->name('shop');
Route::get('/category/{category:slug}', [ProductController::class, 'category'])->name('category.show');
Route::get('/products/{product:slug}', [ProductController::class, 'show'])->name('product.show');
Route::post('/products/{product:slug}/comments', [CommentController::class, 'store'])
    ->middleware('throttle:comments')->name('product.comment');
Route::get('/comment/captcha', [CommentController::class, 'captcha'])->name('comment.captcha');

Route::get('/about', [PageController::class, 'about'])->name('about');
Route::get('/rules', [PageController::class, 'rules'])->name('rules');

Route::get('/contact', [ContactController::class, 'index'])->name('contact');
Route::post('/contact', [ContactController::class, 'submit'])->name('contact.submit');
Route::get('/contact/captcha', [ContactController::class, 'captcha'])->name('contact.captcha');

Route::get('/blog', [BlogController::class, 'index'])->name('blog');
Route::get('/blog/category/{category:slug}', [BlogController::class, 'category'])->name('blog.category');
Route::get('/article/{article:slug}', [BlogController::class, 'show'])->name('blog.show');

Route::view('/cart', 'cart')->name('cart');

Route::prefix('cart')->name('cart.')->group(function () {
    Route::match(['get', 'post'], '/data', [CartController::class, 'data'])->name('data');
    Route::post('/add', [CartController::class, 'add'])->name('add');
    Route::post('/update', [CartController::class, 'update'])->name('update');
    Route::post('/remove', [CartController::class, 'remove'])->name('remove');
});

Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout');
Route::post('/checkout', [CheckoutController::class, 'store'])->name('checkout.store');
Route::get('/checkout/proforma', [CheckoutController::class, 'proforma'])->name('checkout.proforma');

Route::get('/locations/cities/{province}', [LocationController::class, 'cities'])->name('locations.cities');

Route::get('/order/{order:order_number}/pay', [PaymentController::class, 'payOrder'])->name('order.pay');
Route::get('/order/{order:order_number}/status', [PaymentController::class, 'orderStatus'])->name('order.status');

// Placeholder payment gateway (no money moves). Replace with a real gateway later.
Route::get('/payment/demo/{order:order_number}', [PaymentController::class, 'demoGateway'])->name('payment.demo');
Route::post('/payment/demo/{order:order_number}', [PaymentController::class, 'demoCallback'])->name('payment.demo.callback');
