<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PageController extends Controller
{
    function home()
    {
        return view('pages.home', [
            'title' => getTitle(),
            'description' => getDescription(),
        ]);
    }

    function how()
    {
        return view('pages.how', [
            'title' => __('How it works?'),
            'description' => getDescription(),
        ]);
    }

    function faq()
    {
        return view('pages.faq', [
            'title' => __('Frequent Asked questions'),
            'description' => getDescription(),
        ]);
    }

    function about()
    {
        return view('pages.about', [
            'title' => __('About'),
            'description' => getDescription(),
        ]);
    }

    function contact()
    {
        return view('pages.contact', [
            'title' => __('Contact Us'),
            'description' => getDescription(),
        ]);
    }
}
