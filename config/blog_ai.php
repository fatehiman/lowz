<?php

/*
|--------------------------------------------------------------------------
| Daily AI blog article (php artisan blog:generate)
|--------------------------------------------------------------------------
|
| DeepSeek writes the Persian article plus an English image prompt, and
| SiliconFlow draws the cover image. Keys live in .env (and in Bitwarden,
| folder "AI Providers") — never in git.
|
*/

return [

    'deepseek' => [
        'key' => env('DEEPSEEK_API_KEY'),
        'base_url' => env('DEEPSEEK_BASE_URL', 'https://api.deepseek.com'),
        'model' => env('DEEPSEEK_MODEL', 'deepseek-flash'),
    ],

    'siliconflow' => [
        'key' => env('SILICONFLOW_API_KEY'),
        'base_url' => env('SILICONFLOW_BASE_URL', 'https://api.siliconflow.com/v1'),
        // Tried in order; the next one is used only if the previous one fails.
        'models' => array_filter(explode(',', env(
            'SILICONFLOW_IMAGE_MODELS',
            'Qwen/Qwen-Image,black-forest-labs/FLUX.1-schnell'
        ))),
        'image_size' => '1024x1024',
    ],

    // The saved cover image is resized to this square size (px) and stored as WebP.
    'image_output_size' => 800,

    'min_words' => 200,
    'max_words' => 600,

    // Subjects live in the article_subjects table (seeded by ArticleSubjectSeeder).

];
