<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Validation\Rule;

class BannerController extends Controller
{
    public function index(Request $request)
    {
        $banners = Banner::latest()->paginate(10);
        return view('backend.pages.banner-list', compact('banners'));
    }
    public function bannerAddIndex($id = null)
    {
        $banner = $id ? Banner::find($id) : null;
        return view('backend.pages.banner-add', compact('banner'));
    }

    public function storeOrUpdate(Request $request)
    {
        $request->validate(
            [
                'banner_id' => 'nullable|exists:banners,id',
                'status' => 'required|in:0,1',
                'image' => [
                    $request->banner_id ? 'nullable' : 'required',
                    'image',
                    'mimes:jpg,jpeg,png,webp',
                    'max:2048',
                    'dimensions:width=1700,height=500',
                ],
            ],
            [
                'image.required' => 'Banner image is required.',
                'image.image' => 'The uploaded file must be an image.',
                'image.mimes' => 'Only JPG, JPEG, PNG or WEBP images are allowed.',
                'image.max' => 'Banner image size must not exceed 2MB.',
                'image.dimensions' => 'Banner image must be exactly 1700 × 500 pixels.',
            ]
        );

        // ---------------------------
        // UPDATE
        // ---------------------------
        if ($request->banner_id) {

            $banner = Banner::findOrFail($request->banner_id);
            $banner->status = $request->status;

            if ($request->hasFile('image')) {

                if ($banner->image && File::exists(public_path($banner->image))) {
                    File::delete(public_path($banner->image));
                }

                $imageName = 'banner_' . time() . '.' . $request->image->extension();
                $path = 'uploads/banners/';
                $request->image->move(public_path($path), $imageName);

                $banner->image = $path . $imageName;
            }

            $banner->save();
        }

        // ---------------------------
        // CREATE
        // ---------------------------
        else {

            // Upload image FIRST
            $imageName = 'banner_' . time() . '.' . $request->image->extension();
            $path = 'uploads/banners/';
            $request->image->move(public_path($path), $imageName);

            $banner = Banner::create([
                'status' => $request->status,
                'image' => $path . $imageName,
            ]);
        }

        return response()->json([
            'success' => true,
            'message' => $request->banner_id
                ? 'Banner updated successfully'
                : 'Banner added successfully'
        ]);
    }

    public function delete(Request $request)
    {
        $request->validate([
            'id' => 'required|exists:banners,id',
        ]);

        $banner = Banner::findOrFail($request->id);
        if (!empty($banner->image) && File::exists(public_path($banner->image))) {
            File::delete(public_path($banner->image));
        }
        $banner->delete();
        return response()->json([
            'success' => true,
            'message' => 'Banner deleted successfully'
        ]);
    }
}
