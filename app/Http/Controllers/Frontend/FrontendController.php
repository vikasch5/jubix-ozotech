<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
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

    public function productList($slug = null, $subSlug = null, Request $request)
    {
        $category = Category::where('slug', $slug)->first();

        if (!$category) {
            abort(404, "Category not found");
        }

        $subCategory = null;

        if ($subSlug) {
            $subCategory = SubCategory::where('status', '1')
                ->where('slug', $subSlug)
                ->first();
            if (!$subCategory) {
                abort(404, "Sub Category not found");
            }
        }

        $products = Product::where('category_id', $category->id);

        if ($subCategory) {
            $products->where('sub_category_id', $subCategory->id);
        }

        if ($request->min_price != null) {
            $products->where('price', '>=', $request->min_price);
        }

        if ($request->max_price != null) {
            $products->where('price', '<=', $request->max_price);
        }
        $products = $products->paginate(12)->appends($request->all());

        return view('frontend.pages.product-list', compact('category', 'subCategory', 'products'));
    }

    public function productDetail($slug)
    {
        $product = Product::where('slug',$slug)->first();
        $relatedProducts = Product::where('category_id', $product->category_id)
            ->where('id', '!=', $product->id)
            ->take(10) 
            ->get();
        return view('frontend.pages.product-detail', compact('product','relatedProducts'));
    }
}
