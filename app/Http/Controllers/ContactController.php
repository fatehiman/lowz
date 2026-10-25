<?php

namespace App\Http\Controllers;

use App\Models\PageSeo;
use App\Services\Captcha;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class ContactController extends Controller
{
    /**
     * Options of the optional "subject" listbox, in display order. The key is
     * sent by the form and can be preselected with /contact?subject=<key>.
     */
    public const SUBJECTS = [
        'products' => 'سوال درباره محصولات',
        'advice' => 'مشاوره برای انتخاب گیاه یا دمنوش',
        'order-payment' => 'سوال درباره سفارش، ارسال یا پرداخت',
        'wholesale' => 'خرید عمده و همکاری',
        'feedback' => 'پیشنهاد یا انتقاد',
        'other' => 'موضوعات دیگر',
    ];

    public function index(Request $request): View
    {
        $seo = PageSeo::for('contact');
        $subject = (string) $request->query('subject', '');

        return view('contact', [
            'title' => $seo->title,
            'meta_description' => $seo->meta_description,
            'subjects' => self::SUBJECTS,
            'selectedSubject' => array_key_exists($subject, self::SUBJECTS) ? $subject : '',
        ]);
    }

    /**
     * Render a new captcha challenge (a + b = ?) as a PNG image, so the
     * answer can't just be scraped as text from the page source.
     */
    public function captcha(): Response
    {
        $a = rand(1, 9);
        $b = rand(1, 9);

        return Captcha::issue('contact_captcha', "{$a} + {$b} = ?", $a + $b);
    }

    public function submit(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255'],
            'phone' => ['nullable', 'string', 'max:50'],
            'subject' => ['nullable', Rule::in(array_keys(self::SUBJECTS))],
            'message' => ['required', 'string', 'max:5000'],
            'captcha' => ['required', 'numeric'],
        ]);

        if (! Captcha::check('contact_captcha', $request->input('captcha'))) {
            return back()->withErrors(['captcha' => 'پاسخ کپچا اشتباه است.'])->withInput();
        }

        $subject = self::SUBJECTS[$request->input('subject')] ?? null;

        $data = [
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'phone' => $request->input('phone'),
            'subject' => $subject,
            'message' => $request->input('message'),
            'ip' => visitor_ip($request),
            'user_agent' => $request->userAgent(),
            'submitted_at' => now()->toDateTimeString(),
        ];

        $filename = 'contact_' . now()->format('Ymd_His') . '_' . uniqid() . '.txt';
        $content = json_encode($data, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT) . PHP_EOL;

        Storage::disk('local')->put('contacts/' . $filename, $content);

        return back()->with('success', 'پیام شما با موفقیت ارسال شد.');
    }
}
