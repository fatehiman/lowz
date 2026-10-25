<?php

namespace App\Http\Middleware;

use App\Models\Setting;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\IpUtils;
use Symfony\Component\HttpFoundation\Response;
use Throwable;

/**
 * "Under construction" mode (setting `maintenance_enabled`, on after the first install).
 * Visitors and search engines get a 503 waiting page. A browser that opened the secret
 * /preview/{token} link, or an allowed IP (setting `maintenance_ips`), sees the real site.
 * Turn it on/off with: php artisan site:construction on|off
 */
class UnderConstruction
{
    public const COOKIE = 'lowz_preview';

    /** Paths that always work: health check, robots.txt (it says "Disallow: /" while closed), the preview link. */
    private const OPEN_PATHS = ['up', 'robots.txt', 'preview/*'];

    public function handle(Request $request, Closure $next): Response
    {
        if (! self::enabled() || $request->is(...self::OPEN_PATHS)) {
            return $next($request);
        }

        if (self::canPreview($request)) {
            $response = $next($request);
            // Even the preview must never be indexed.
            $response->headers->set('X-Robots-Tag', 'noindex, nofollow');

            return $response;
        }

        return response()
            ->view('maintenance', [], 503)
            ->header('Retry-After', '86400')
            ->header('X-Robots-Tag', 'noindex, nofollow')
            ->header('Cache-Control', 'no-store, private');
    }

    public static function enabled(): bool
    {
        try {
            return Setting::get('maintenance_enabled', '1') === '1';
        } catch (Throwable) {
            // No database yet (first deploy): stay closed.
            return true;
        }
    }

    public static function canPreview(Request $request): bool
    {
        $cookie = (string) $request->cookie(self::COOKIE);
        if ($cookie !== '' && hash_equals(self::cookieValue(), $cookie)) {
            return true;
        }

        $ips = self::allowedIps();

        return $ips !== [] && IpUtils::checkIp(visitor_ip($request), $ips);
    }

    /** True when the mode is on and this visitor still sees the site (shows the yellow band). */
    public static function previewing(Request $request): bool
    {
        return self::enabled() && self::canPreview($request);
    }

    public static function cookieValue(): string
    {
        return hash_hmac('sha256', 'preview:'.config('shop.preview_token'), (string) config('app.key'));
    }

    /** @return string[] IPs or CIDR ranges, from lines like "1.2.3.4 # label" */
    public static function allowedIps(): array
    {
        $ips = [];
        foreach (preg_split('/\R/', (string) Setting::get('maintenance_ips', '')) ?: [] as $line) {
            $ip = trim(explode('#', $line, 2)[0]);
            if ($ip !== '') {
                $ips[] = $ip;
            }
        }

        return $ips;
    }
}
