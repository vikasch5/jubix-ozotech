<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::with('category')->orderByDesc('id')->paginate(10);
        return view('backend.pages.product-list', compact('products'));
    }
    public function productAddIndex($id = null)
    {
        $product = $id ? Product::find($id) : [];
        $categories = Category::where('status', '1')->get();
        $subcategories = SubCategory::where('status', '1')->where('category_id', $product->category_id)->get();
        return view('backend.pages.product-add', compact('product', 'categories', 'subcategories'));
    }

    public function storeOrUpdate(Request $request)
    {
        $id = $request->product_id;
        $validator = \Validator::make($request->all(), [
            'product_name' => 'required|string|max:255',
            'category_id' => 'required|integer',
            'sub_category_id' => 'nullable|integer',
            'price' => 'required|numeric',
            'images.*' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'status' => 'required|in:0,1',
            'description' => 'nullable|string',
            'remove_images' => 'array',
            'remove_images.*' => 'string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors(),
            ], 422);
        }

        $product = $id ? Product::find($id) : new Product();

        if ($id && !$product) {
            return response()->json([
                'success' => false,
                'message' => 'Product not found'
            ], 404);
        }

        $product->fill([
            'product_name' => $request->product_name,
            'category_id' => $request->category_id,
            'sub_category_id' => $request->sub_category_id,
            'price' => $request->price,
            'status' => $request->status,
            'description' => $request->description,
        ]);

        $existingImages = $product->images ? json_decode($product->images, true) : [];

        if ($request->remove_images) {
            foreach ($request->remove_images as $img) {

                if (Storage::disk('public')->exists($img)) {
                    Storage::disk('public')->delete($img);
                }

                $existingImages = array_filter($existingImages, fn($i) => $i !== $img);
            }
        }

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $img) {
                $fileName = uniqid() . '.' . $img->getClientOriginalExtension();
                $path = $img->storeAs('products', $fileName, 'public');
                $existingImages[] = $path;
            }
        }

        $product->images = json_encode(array_values($existingImages));

        $product->save();

        return response()->json([
            'success' => true,
            'message' => $id ? 'Product Updated Successfully' : 'Product Created Successfully',
        ]);
    }


    public function delete(Request $request)
    {
        $id = $request->id;

        $product = Product::find($id);

        if (!$product) {
            return response()->json([
                'success' => false,
                'message' => 'Product not found'
            ], 404);
        }

        // Delete product images from storage
        if ($product->images) {
            $images = json_decode($product->images, true);

            foreach ($images as $img) {
                if (Storage::disk('public')->exists($img)) {
                    Storage::disk('public')->delete($img);
                }
            }
        }

        // Delete product
        $product->delete();

        return response()->json([
            'success' => true,
            'message' => 'Product deleted successfully'
        ]);
    }

    public function deleteImage(Request $request)
    {
        $product = Product::find($request->product_id);

        if (!$product) {
            return response()->json(['success' => false]);
        }

        $images = json_decode($product->images, true);

        if (($key = array_search($request->image, $images)) !== false) {

            // Delete from disk
            if (\Storage::disk('public')->exists($request->image)) {
                \Storage::disk('public')->delete($request->image);
            }

            // Remove from array
            unset($images[$key]);

            // Save updated array
            $product->images = json_encode(array_values($images));
            $product->save();
        }

        return response()->json(['success' => true]);
    }

}
