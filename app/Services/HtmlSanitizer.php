<?php

namespace App\Services;

use HTMLPurifier;
use HTMLPurifier_Config;

class HtmlSanitizer
{
    public static function article(string $html): string
    {
        return static::purify(static::autoParagraph($html), 'article');
    }

    /**
     * Legacy article bodies are plain text with blank-line-separated paragraphs.
     * If the content has no HTML tags at all, wrap it into <p> tags so it still
     * renders correctly once we start purifying/outputting raw HTML.
     */
    protected static function autoParagraph(string $text): string
    {
        if ($text !== strip_tags($text)) {
            return $text;
        }

        $paragraphs = preg_split('/\n{2,}/', trim($text));

        return implode('', array_map(
            fn ($paragraph) => '<p>'.nl2br(e(trim($paragraph))).'</p>',
            $paragraphs
        ));
    }

    public static function inline(string $html): string
    {
        return static::purify($html, 'inline');
    }

    protected static function purify(string $html, string $profile): string
    {
        static $purifiers = [];

        if (! isset($purifiers[$profile])) {
            $config = HTMLPurifier_Config::createDefault();
            $config->set('Cache.DefinitionImpl', null);
            $config->set('HTML.TargetBlank', true);

            if ($profile === 'inline') {
                $config->set('HTML.Allowed', 'b,strong,i,em,u,br');
            } else {
                $config->set('HTML.Allowed', 'p,br,b,strong,i,em,u,ul,ol,li,h2,h3,h4,blockquote,a[href],img[src|alt]');
            }

            $purifiers[$profile] = new HTMLPurifier($config);
        }

        return $purifiers[$profile]->purify($html);
    }
}
