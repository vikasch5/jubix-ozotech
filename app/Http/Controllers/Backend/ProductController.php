<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function productAddIndex($id = null){
        $product = $id ? Product::find($id) : [];
        $categories = Category::where('status','1')->get();
        return view('backend.pages.product-add', compact('product','categories'));
    }
}
