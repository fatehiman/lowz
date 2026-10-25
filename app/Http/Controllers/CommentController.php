<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Product;
use App\Services\Captcha;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

/**
 * Product reviews: name, email (never shown), 1-5 stars, text. Saved with
 * is_accepted = false; it is written to the log and the admin accepts (or deletes)
 * the row by hand in the DB. Only accepted reviews are shown and used for the
 * Google stars (aggregateRating) on the product page.
 */
class CommentController extends Controller
{
    private const CAPTCHA_KEY = 'comment_captcha';

    /** 4 random English digits as a PNG. */
    public function captcha(): Response
    {
        $code = (string) random_int(1000, 9999);

        return Captcha::issue(self::CAPTCHA_KEY, implode(' ', str_split($code)), $code);
    }

    public function store(Request $request, Product $product): RedirectResponse
    {
        $back = route('product.show', $product).'#comments';

        // Honeypot: a hidden field real visitors never fill. Bots get a fake "OK".
        if (filled($request->input('website'))) {
            return redirect()->to($back)->with('comment_success', true);
        }

        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:100'],
            'email' => ['required', 'email', 'max:255'],
            'rating' => ['required', 'integer', 'between:1,5'],
            'body' => ['required', 'string', 'min:3', 'max:2000'],
            'captcha' => ['required', 'string', 'max:10'],
        ], [
            'name.required' => 'نام را وارد کنید.',
            'email.required' => 'ایمیل را وارد کنید.',
            'email.email' => 'ایمیل درست نیست.',
            'rating.required' => 'تعداد ستاره را انتخاب کنید.',
            'rating.*' => 'تعداد ستاره را انتخاب کنید.',
            'body.required' => 'متن نظر را بنویسید.',
            'body.min' => 'متن نظر خیلی کوتاه است.',
            'body.max' => 'متن نظر حداکثر ۲۰۰۰ حرف است.',
            'captcha.required' => 'کد امنیتی را وارد کنید.',
        ]);

        if ($validator->fails()) {
            return redirect()->to($back)->withErrors($validator)->withInput();
        }

        if (! Captcha::check(self::CAPTCHA_KEY, $request->input('captcha'))) {
            return redirect()->to($back)->withErrors(['captcha' => 'کد امنیتی اشتباه است.'])->withInput();
        }

        $comment = $product->comments()->create([
            'name' => Str::squish($request->input('name')),
            'email' => Str::lower(trim($request->input('email'))),
            'rating' => (int) $request->input('rating'),
            'body' => trim($request->input('body')),
            'is_accepted' => false,
            'ip' => visitor_ip($request),
            'user_agent' => Str::limit((string) $request->userAgent(), 490, ''),
        ]);

        $this->notify($comment, $product);

        return redirect()->to($back)->with('comment_success', true);
    }

    private function notify(Comment $comment, Product $product): void
    {
        // Demo site: no Telegram message, only a log line. Accept with:
        // UPDATE comments SET is_accepted=1 WHERE id=N;
        Log::info('New product comment waiting for review', [
            'comment_id' => $comment->id,
            'product' => Str::squish($product->name),
            'rating' => $comment->rating,
        ]);
    }
}
