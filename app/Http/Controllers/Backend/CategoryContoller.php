<?php

namespace App\Http\Controllers\Backend;

use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CategoryContoller
{
    public function index()
    {
        $categories = Category::paginate('10');
        return view('backend.pages.category-list', compact('categories'));
    }

    public function categoryAddIndex($id = null)
    {
        $category = [];
        if ($id) {
            $category = Category::find($id);
        }
        return view('backend.pages.category-add', compact('category'));
    }

    public function storeOrUpdate(Request $request)
    {
        $id = $request->category_id;

        // ---------------- VALIDATION ----------------
        $request->validate([
            'category_name'     => 'required|string|max:255',
            'slug'              => 'nullable|string|max:255|unique:categories,slug,' . $id,
            'status'            => 'required|in:0,1',
            'meta_title'        => 'nullable|string|max:255',
            'meta_description'  => 'nullable|string',
            'meta_keywords'     => 'nullable|string',
            'description'       => 'nullable|string',
            'category_image'    => 'nullable|image|mimes:jpeg,png,jpg|max:1024', // max 1MB
            'show_on_home'    => 'nullable',
        ]);

        // Auto-generate slug if empty
        $slug = $request->slug ?: Str::slug($request->category_name);

        // ---------------- DIMENSION CHECK ----------------
        // if ($request->hasFile('category_image')) {
        //     [$width, $height] = getimagesize($request->category_image);
        //     if ($width > 100 || $height > 100) {
        //         return response()->json([
        //             'status' => false,
        //             'errors' => ['category_image' => 'Image dimensions must be 100x100 or less.']
        //         ], 422);
        //     }
        // }

        // ---------------- CREATE / UPDATE DATA ----------------
        $data = [
            'category_name'    => $request->category_name,
            'slug'             => $slug,
            'status'           => $request->status,
            'meta_title'       => $request->meta_title,
            'meta_description' => $request->meta_description,
            'meta_keywords'    => $request->meta_keywords,
            'description'      => $request->description,
            'show_on_home'     => $request->show_on_home ?? '0',
        ];

        $category = Category::updateOrCreate(['id' => $id], $data);

        // ---------------- IMAGE UPLOAD ----------------
        if ($request->hasFile('category_image')) {

            // delete old
            if ($category->image && file_exists(public_path("uploads/category/{$category->image}"))) {
                @unlink(public_path("uploads/category/{$category->image}"));
            }

            $file = $request->file('category_image');
            $filename = time() . "_" . uniqid() . "." . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/category/'), $filename);

            $category->update(['image' => $filename]);
        }

        // ---------------- RESPONSE ----------------
        return response()->json([
            'success'  => true,
            'message' => $id ? 'Category Updated Successfully' : 'Category Created Successfully',
            'redirect_url' => route('admin.category.index')
        ]);
    }

    public function delete(Request $request)
    {
        $category = Category::find($request->id);
        if ($category) {
            $category->delete();
            return response()->json([
                'success' => true,
                'message' => 'Category deleted successfully!'
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Category not found!'
            ]);
        }
    }

    public function subCategoryIndex()
    {
        $categories = SubCategory::with('category')->paginate('10');
        return view('backend.pages.sub-category-list', compact('categories'));
    }

    public function subCategoryAddIndex($id = null)
    {
        $category = [];
        if ($id) {
            $category = SubCategory::find($id);
        }
        $all_categories = Category::where('status', '1')->get();
        return view('backend.pages.sub-category-add', compact('category', 'all_categories'));
    }

    public function subCategoryStorOrUpdate(Request $request)
    {
        $id = $request->sub_category_id;

        // ---------------- VALIDATION ----------------
        $request->validate([
            'sub_category_name'     => 'required|string|max:255',
            'slug'              => 'nullable|string|max:255|unique:sub_categories,slug,' . $id,
            'status'            => 'required|in:0,1',
            'meta_title'        => 'nullable|string|max:255',
            'meta_description'  => 'nullable|string',
            'meta_keywords'     => 'nullable|string',
            'description'       => 'nullable|string',
            'category_image'    => 'nullable|image|mimes:jpeg,png,jpg|max:1024', // max 1MB
            // 'show_on_home'    => 'nullable',
            'category_id'      => 'required|exists:categories,id',
        ]);

        // Auto-generate slug if empty
        $slug = Str::slug($request->slug) ?: Str::slug($request->category_name);

        // ---------------- DIMENSION CHECK ----------------
        // if ($request->hasFile('category_image')) {
        //     [$width, $height] = getimagesize($request->category_image);
        //     if ($width > 100 || $height > 100) {
        //         return response()->json([
        //             'status' => false,
        //             'errors' => ['category_image' => 'Image dimensions must be 100x100 or less.']
        //         ], 422);
        //     }
        // }

        // ---------------- CREATE / UPDATE DATA ----------------
        $data = [
            'category_id'       => $request->category_id,
            'sub_category_name'    => $request->sub_category_name,
            'slug'             => $slug,
            'status'           => $request->status,
            'meta_title'       => $request->meta_title,
            'meta_description' => $request->meta_description,
            'meta_keywords'    => $request->meta_keywords,
            'description'      => $request->description,
            // 'show_on_home'     => $request->show_on_home ?? '0',
        ];

        $category = SubCategory::updateOrCreate(['id' => $id], $data);

        // ---------------- IMAGE UPLOAD ----------------
        if ($request->hasFile('sub_category_image')) {

            // delete old
            if ($category->image && file_exists(public_path("uploads/sub-category/{$category->image}"))) {
                @unlink(public_path("uploads/sub-category/{$category->image}"));
            }

            $file = $request->file('sub_category_image');
            $filename = time() . "_" . uniqid() . "." . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/sub-category/'), $filename);

            $category->update(['image' => $filename]);
        }

        // ---------------- RESPONSE ----------------
        return response()->json([
            'success'  => true,
            'message' => $id ? 'Sub Category Updated Successfully' : 'Sub Category Created Successfully',
            'redirect_url' => route('admin.sub.category.index')
        ]);
    }

    public function deleteSubCategory(Request $request)
    {
        $category = SubCategory::find($request->id);
        if ($category) {
            $category->delete();
            return response()->json([
                'success' => true,
                'message' => 'Sub Category deleted successfully!'
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Sub Category not found!'
            ]);
        }
    }

    public function getSubcategories($category_id)
    {
        $subcategories = SubCategory::where('category_id', $category_id)
            ->where('status', '1')
            ->get();

        return response()->json([
            'success' => true,
            'data' => $subcategories
        ]);
    }
}
