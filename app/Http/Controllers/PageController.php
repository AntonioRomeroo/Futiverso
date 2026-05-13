<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PageController extends Controller
{
    public function about()
    {
        return view('pages.about');
    }

    public function faq()
    {
        return view('pages.faq');
    }

    public function shipping()
    {
        return view('pages.shipping');
    }

    public function contact()
    {
        return view('pages.contact');
    }

    public function tracking()
    {
        return view('pages.tracking');
    }

    public function privacy()
    {
        return view('pages.privacy');
    }

    public function cookies()
    {
        return view('pages.cookies');
    }

    public function terms()
    {
        return view('pages.terms');
    }
}
