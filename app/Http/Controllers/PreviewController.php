<?php

namespace App\Http\Controllers;

use App\Http\Middleware\UnderConstruction;
use Illuminate\Http\RedirectResponse;

class PreviewController extends Controller
{
    /**
     * Secret link /preview/{token}: this browser sees the real site while it is "under construction".
     * /preview/{token}/off removes the cookie again.
     */
    public function enable(string $token): RedirectResponse
    {
        $this->check($token);

        return redirect()->route('home')
            ->withCookie(cookie(UnderConstruction::COOKIE, UnderConstruction::cookieValue(), 60 * 24 * 180));
    }

    public function disable(string $token): RedirectResponse
    {
        $this->check($token);

        return redirect()->route('home')->withoutCookie(UnderConstruction::COOKIE);
    }

    private function check(string $token): void
    {
        $expected = (string) config('shop.preview_token');

        abort_if($expected === '' || ! hash_equals($expected, $token), 404);
    }
}
