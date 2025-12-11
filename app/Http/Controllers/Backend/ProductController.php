<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::with('category')->orderByDesc('id')->paginate(10);
        return view('backend.pages.product-list', compact('products'));
    }
    public function productAddIndex($id = null)
    {
        $product = $id ? Product::find($id) : null;
        $categories = Category::where('status', '1')->get();
        $subcategories = SubCategory::where('status', '1')->where('category_id', optional($product)->category_id)->get();
        return view('backend.pages.product-add', compact('product', 'categories', 'subcategories'));
    }

    public function storeOrUpdate(Request $request)
    {
        $id = $request->product_id;

        // ==========================
        // VALIDATION
        // ==========================
        $validator = Validator::make($request->all(), [
            'product_name'     => 'required|string|max:255',
            'category_id'      => 'required|integer',
            'sub_category_id'  => 'nullable|integer',
            'price'            => 'required|numeric',
            'images.*'         => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'status'           => 'required|in:0,1',
            'description'      => 'nullable|string',

            // for deleting images
            'remove_images'    => 'nullable|array',
            'remove_images.*'  => 'string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors'  => $validator->errors()
            ], 422);
        }

        // ==========================
        // FIND OR CREATE PRODUCT
        // ==========================
        $product = $id ? Product::find($id) : new Product();

        if ($id && !$product) {
            return response()->json([
                'success' => false,
                'message' => 'Product not found'
            ], 404);
        }

        // ==========================
        // FILL BASIC DATA
        // ==========================
        $product->product_name    = $request->product_name;
        $product->category_id     = $request->category_id;
        $product->sub_category_id = $request->sub_category_id;
        $product->price           = $request->price;
        $product->status          = $request->status;
        $product->description     = $request->description;

        // ==========================
        // HANDLE EXISTING IMAGES
        // ==========================
        $existingImages = $product->images ? json_decode($product->images, true) : [];

        // ---- Delete old images if requested ----
        if (!empty($request->remove_images)) {
            foreach ($request->remove_images as $path) {
                if (Storage::disk('public')->exists($path)) {
                    Storage::disk('public')->delete($path);
                }

                // Remove from list
                $existingImages = array_filter($existingImages, function ($img) use ($path) {
                    return $img !== $path;
                });
            }
        }

        // ==========================
        // HANDLE NEW UPLOADED IMAGES
        // ==========================
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $file) {

                $fileName = uniqid() . '.' . $file->getClientOriginalExtension();

                // Store in storage/app/public/products
                $path = $file->storeAs('products', $fileName, 'public');

                // Add to list
                $existingImages[] = $path;
            }
        }

        // reset array keys
        $product->images = json_encode(array_values($existingImages));

        // ==========================
        // SAVE PRODUCT
        // ==========================
        $product->save();

        return response()->json([
            'success' => true,
            'message' => $id ? 'Product Updated Successfully' : 'Product Created Successfully'
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
