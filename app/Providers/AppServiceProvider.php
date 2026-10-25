<?php

namespace App\Providers;

use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Paginator::useBootstrapFive();

        // Product reviews: 5 per 10 minutes per visitor. Behind Cloudflare
        // $request->ip() is the Cloudflare edge, so use the visitor IP header.
        RateLimiter::for('comments', function (Request $request) {
            return Limit::perMinutes(10, 5)->by(visitor_ip($request));
        });
    }
}
