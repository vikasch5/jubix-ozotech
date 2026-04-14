<?php

namespace App\Http\Controllers\Backend;

use App\Models\Category;
use App\Models\Contact;
use App\Models\Product;
use App\Models\Service;
use App\Models\SubCategory;

class DashboardController
{
    public function index()
    {
        return view('backend.pages.dashboard', [
            'categories' => Category::count(),
            'subcategories' => SubCategory::count(),
            'services' => Service::count(),
            'products' => Product::count(),
            'leads' => Contact::count(),
        ]);
    }
}
