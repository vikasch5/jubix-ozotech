<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ServiceController extends Controller
{
    public function index()
    {
        $services = Service::orderByDesc('id')->paginate(10);
        return view('backend.pages.service-list', compact('services'));
    }
    public function serviceAddIndex($id = null)
    {
        $service = $id ? Service::find($id) : [];
        return view('backend.pages.service-add', compact('service'));
    }

    public function storeOrUpdate(Request $request)
    {
        $id = $request->service_id;

        // ---------------- VALIDATION ----------------
        $request->validate([
            'title'       => 'required|string|max:255',
            'slug'        => 'nullable|string|max:255|unique:services,slug,' . $id,
            'description' => 'nullable|string',
            'status'      => 'required|in:0,1',
            'image'       => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        // ---------------- SLUG AUTO-GENERATE ----------------
        $slug = $request->slug ?: Str::slug($request->title);

        // ---------------- CREATE / UPDATE DATA ----------------
        $data = [
            'title'       => $request->title,
            'slug'        => $slug,
            'description' => $request->description,
            'status'      => $request->status,
        ];

        $service = Service::updateOrCreate(
            ['id' => $id],
            $data
        );

        // ---------------- IMAGE UPLOAD ----------------
        if ($request->hasFile('image')) {

            // delete old image
            if ($service->image && file_exists(public_path("uploads/services/{$service->image}"))) {
                @unlink(public_path("uploads/services/{$service->image}"));
            }

            $file = $request->file('image');
            $filename = time() . "_" . uniqid() . "." . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/services/'), $filename);

            $service->update([
                'image' => $filename
            ]);
        }

        // ---------------- RESPONSE ----------------
        return response()->json([
            'success' => true,
            'message' => $id
                ? 'Service Updated Successfully'
                : 'Service Created Successfully',
        ]);
    }

    public function delete(Request $request)
    {
        $id = $request->id;

        $service = Service::find($id);

        if (!$service) {
            return response()->json([
                'success' => false,
                'message' => 'Record not found'
            ]);
        }
        if ($service->image && file_exists(public_path('uploads/services/' . $service->image))) {
            @unlink(public_path('uploads/services/' . $service->image));
        }
        $service->delete();
        return response()->json([
            'success' => true,
            'message' => 'Service deleted successfully'
        ]);
    }
}
