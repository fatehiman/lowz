<?php

namespace App\Http\Controllers;

use App\Models\PageSeo;
use Illuminate\View\View;

class PageController extends Controller
{
    public function about(): View
    {
        $seo = PageSeo::for('about');

        return view('about', [
            'title' => $seo->title,
            'meta_description' => $seo->meta_description,
        ]);
    }

    public function rules(): View
    {
        $seo = PageSeo::for('rules');

        return view('rules', [
            'title' => $seo->title,
            'meta_description' => $seo->meta_description,
        ]);
    }
}
