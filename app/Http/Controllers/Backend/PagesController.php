<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Page;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PagesController extends Controller
{
    public function index()
    {
        return view('backend.pages.pages-list');
    }

    public function pagesAddIndex($id = null)
    {
        $page = [];
        return view('backend.pages.pages-add', compact('page'));
    }

    public function store(Request $request)
    {
        $rules = [
            'page_name'         => 'required|string|max:100|unique:pages,page_name,' . $request->page_id,
            'content'           => 'nullable|string',
            'meta_title'        => 'nullable|string|max:255',
            'meta_description'  => 'nullable|string',
            'meta_keywords'     => 'nullable|string',
            'status'            => 'required|boolean',
        ];

        // ✅ If About Us → image required
        if ($request->page_name === 'about-us') {
            $rules['image'] = 'required|image|mimes:jpg,jpeg,png,webp|max:2048';
        } else {
            $rules['image'] = 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048';
        }

        $request->validate($rules);

        $page = Page::find($request->page_id);

        // ✅ Handle Image Upload
        $imageName = $page->image ?? null;

        if ($request->hasFile('image')) {
            $imageName = time() . '_' . $request->image->getClientOriginalName();
            $request->image->move(public_path('uploads/pages'), $imageName);
        }

        Page::updateOrCreate(
            ['id' => $request->page_id],
            [
                'page_name'        => $request->page_name,
                'image'            => $imageName,
                'content'          => $request->content,
                'meta_title'       => $request->meta_title,
                'meta_description' => $request->meta_description,
                'meta_keywords'    => $request->meta_keywords,
                'status'           => $request->status,
            ]
        );

        return response()->json([
            'success'  => true,
            'message' => 'Page saved successfully'
        ]);
    }
}
