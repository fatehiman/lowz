<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->prepend(\App\Http\Middleware\RedirectToCanonicalHost::class);
        $middleware->web(append: [\App\Http\Middleware\UnderConstruction::class]);

        // The preview cookie is an HMAC already; it does not need Laravel's encryption.
        $middleware->encryptCookies(except: [\App\Http\Middleware\UnderConstruction::COOKIE]);

        $middleware->validateCsrfTokens(except: [
            'cart/*',
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
