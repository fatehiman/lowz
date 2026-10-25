<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * 301 any other hostname (www.lowz.ir, ...) to the
 * APP_URL host, so search engines see one copy of each page, not several.
 * Production only — local/staging answer on their own hostnames.
 */
class RedirectToCanonicalHost
{
    public function handle(Request $request, Closure $next): Response
    {
        $canonical = parse_url(config('app.url'), PHP_URL_HOST);

        if (app()->environment('production') && $canonical && $request->getHost() !== $canonical) {
            return redirect()->away(rtrim(config('app.url'), '/').$request->getRequestUri(), 301);
        }

        return $next($request);
    }
}
