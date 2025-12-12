<?php

namespace App\Http\Controllers\Backend;

use App\Models\Setting;
use Illuminate\Http\Request;

class SettingController
{
    public function index()
    {
        $setting = Setting::first();
        return view('backend.pages.settings', compact('setting'));
    }

    public function update(Request $request)
    {
        // --------------------------
        // 🔥 VALIDATION
        // --------------------------
        $request->validate([
            'favicon' => 'nullable|image|mimes:png,jpg,jpeg,ico|max:1024|dimensions:max_width=50,max_height=50',
            'logo'    => 'nullable|image|mimes:png,jpg,jpeg,svg|max:2048|dimensions:max_width=200,max_height=100',
        ], [
            'favicon.dimensions' => 'Favicon must be max 50x50px.',
            'logo.dimensions' => 'Logo must be max 200x100px.',
        ]);

        // Fetch setting row
        $setting = Setting::firstOrNew();


        // --------------------------
        // 🔥 SAVE FAVICON (Like news image code)
        // --------------------------
        if ($request->hasFile('favicon')) {

            // delete old
            if (!empty($setting->favicon) && file_exists(public_path($setting->favicon))) {
                @unlink(public_path($setting->favicon));
            }

            $file      = $request->file('favicon');
            $fileName  = time() . '-' . uniqid() . '.' . $file->getClientOriginalExtension();
            $uploadDir = public_path('uploads/settings/');

            if (!file_exists($uploadDir)) {
                mkdir($uploadDir, 0775, true);
            }

            $file->move($uploadDir, $fileName);

            $setting->favicon = 'uploads/settings/' . $fileName;
        }


        // --------------------------
        // 🔥 SAVE LOGO (Like news image code)
        // --------------------------
        if ($request->hasFile('logo')) {

            // delete old
            if (!empty($setting->logo) && file_exists(public_path($setting->logo))) {
                @unlink(public_path($setting->logo));
            }

            $file      = $request->file('logo');
            $fileName  = time() . '-' . uniqid() . '.' . $file->getClientOriginalExtension();
            $uploadDir = public_path('uploads/settings/');

            if (!file_exists($uploadDir)) {
                mkdir($uploadDir, 0775, true);
            }

            $file->move($uploadDir, $fileName);

            $setting->logo = 'uploads/settings/' . $fileName;
        }


        // --------------------------
        // 🔥 SAVE OTHER FIELDS
        // --------------------------
        // $setting->font_style    = $request->font_style;
        $setting->meta_title       = $request->meta_title;
        $setting->meta_description = $request->meta_description;
        $setting->meta_keywords    = $request->meta_keywords;

        $setting->instagram = $request->instagram;
        $setting->facebook  = $request->facebook;
        $setting->twitter   = $request->twitter;
        $setting->linkedin  = $request->linkedin;
        $setting->whatsapp  = $request->whatsapp;
        $setting->youtube   = $request->youtube;

        $setting->save();


        // --------------------------
        // 🔥 JSON RESPONSE
        // --------------------------
        return response()->json([
            'success' => true,
            'message' => 'Settings updated successfully!',
            'redirect_url' => route('admin.settings')
        ]);
    }
}
