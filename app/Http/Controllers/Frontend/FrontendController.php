<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use App\Models\Category;
use App\Models\Enquiry;
use App\Models\Product;
use App\Models\Service;
use App\Models\SubCategory;
use Illuminate\Http\Request;

class FrontendController extends Controller
{
    public function index()
    {
        $services = Service::where('status', '1')->get();
        $homeCategories = Category::with('products')->where([['status', '1'], ['show_on_home', '1']])->get();
        // dd($homeCategories);
        $banners = Banner::where('status', 1)
            ->orderBy('sort_order', 'asc')
            ->get();
        return view('frontend.pages.home', compact('services', 'homeCategories', 'banners'));
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

    public function productList(Request $request, $slug = NUll, $subSlug = Null)
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
        $product = Product::where('slug', $slug)->first();
        $relatedProducts = Product::where('category_id', $product->category_id)
            ->where('id', '!=', $product->id)
            ->take(10)
            ->get();
        return view('frontend.pages.product-detail', compact('product', 'relatedProducts'));
    }

    public function enquirySave(Request $request)
    {
        // dd($request->all());
        $validated = $request->validate([
            'product_name' => 'nullable|string|max:255',
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:20',
            'quantity' => 'required|integer|min:1',
            'message' => 'nullable|string'
        ]);

        Enquiry::create([
            ...$validated,
            'ip_address' => $request->ip()
        ]);

        return response()->json([
            'status' => true,
            'message' => 'Your enquiry has been submitted successfully.'
        ]);
    }
}
