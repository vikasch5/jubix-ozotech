<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Service;
use App\Models\SubCategory;
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

    public function serviceDetail($slug)
    {
        $service = Service::where([['slug', $slug], ['status', '1']])->first();
        // dd($service->toArray());
        return view('frontend.pages.service-detail', compact('service'));
    }

    public function productList($slug,$subSlug)
    {
        $category = Category::with('subCategories')->where('slug', $slug)->first();
        $subCategory = SubCategory::where('status','1')->where('slug',$subSlug)->first();
        
        return view('frontend.pages.product-list', compact('category'));
    }
}
