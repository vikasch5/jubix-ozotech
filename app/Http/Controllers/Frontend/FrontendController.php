<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class FrontendController extends Controller
{
    public function index()
    {
        return view('frontend.pages.home');
    }
    public function aboutUs()
    {
        return view('frontend.pages.about-us');
    }
    public function contactUs()
    {
        return view('frontend.pages.contact-us');
    }
}
