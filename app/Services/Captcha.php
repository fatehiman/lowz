<?php

namespace App\Services;

use Illuminate\Http\Response;
use Illuminate\Support\Facades\Session;

/**
 * Self-made image captcha (no external provider). The answer is kept in the
 * session under a key per form; the text is drawn as a PNG so it can't be
 * scraped from the page source.
 */
class Captcha
{
    /** Store the answer for $key and return the challenge as a PNG response. */
    public static function issue(string $key, string $text, string|int $answer): Response
    {
        Session::put($key, (string) $answer);

        return self::png($text);
    }

    /** True when $input matches the stored answer. The answer is used only once. */
    public static function check(string $key, ?string $input): bool
    {
        $answer = Session::pull($key);
        if ($answer === null || $input === null) {
            return false;
        }

        // A Persian keyboard types ۱۲۳ (or Arabic ١٢٣) instead of 123.
        $input = strtr(trim($input), [
            '۰' => '0', '۱' => '1', '۲' => '2', '۳' => '3', '۴' => '4',
            '۵' => '5', '۶' => '6', '۷' => '7', '۸' => '8', '۹' => '9',
            '٠' => '0', '١' => '1', '٢' => '2', '٣' => '3', '٤' => '4',
            '٥' => '5', '٦' => '6', '٧' => '7', '٨' => '8', '٩' => '9',
        ]);

        return hash_equals((string) $answer, $input);
    }

    public static function png(string $text): Response
    {
        $width = 160;
        $height = 60;
        $image = imagecreatetruecolor($width, $height);

        $bg = imagecolorallocate($image, 255, 247, 240);
        imagefill($image, 0, 0, $bg);

        // light noise lines
        for ($i = 0; $i < 6; $i++) {
            $color = imagecolorallocate($image, rand(200, 230), rand(180, 210), rand(150, 200));
            imageline($image, rand(0, $width), rand(0, $height), rand(0, $width), rand(0, $height), $color);
        }

        $textColor = imagecolorallocate($image, 120, 60, 20);
        $font = 5;
        $textWidth = imagefontwidth($font) * strlen($text);
        $x = (int) (($width - $textWidth) / 2);
        $y = (int) (($height - imagefontheight($font)) / 2);
        imagestring($image, $font, max($x, 5), $y, $text, $textColor);

        // noise dots
        for ($i = 0; $i < 80; $i++) {
            $dot = imagecolorallocate($image, rand(150, 220), rand(120, 200), rand(100, 180));
            imagesetpixel($image, rand(0, $width - 1), rand(0, $height - 1), $dot);
        }

        ob_start();
        imagepng($image);
        $data = ob_get_clean();

        return response($data, 200, [
            'Content-Type' => 'image/png',
            'Cache-Control' => 'no-store, no-cache, must-revalidate',
        ]);
    }
}
