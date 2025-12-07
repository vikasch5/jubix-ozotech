<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
class AuthController
{
    public function showLoginForm()
    {
        return view('backend.auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email'    => 'required|email',
            'password' => 'required',
        ]);

        $remember = $request->has('remember_me');

        if (Auth::attempt($credentials, $remember)) {
            $request->session()->regenerate();

            return response()->json([
                'success' => true,
                'message' => 'Login successful.',
                'user'    => Auth::user(),
                'redirect_url' => route('admin.dashboard'),
            ]);
        }

        return response()->json([
            'success' => false,
            'message' => 'Invalid credentials.',
        ], 200);
    }

    public function editProfile()
    {
        return view('backend.auth.edit-profile');
    }
    public function updatePassword(Request $request)
    {
        // Validation
        $validator = Validator::make($request->all(), [
            'new_password' => 'required|min:6',
            'confirm_new_password' => 'required|same:new_password',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'errors' => $validator->errors()
            ], 422);
        }

        $user = Auth::user();
        $user->password = Hash::make($request->new_password);

        // Save hashed password in users table
        if ($user->save()) {

            return response()->json([
                'status' => true,
                'message' => 'Password changed successfully!'
            ]);
        } else {
            return response()->json([
                'status' => false,
                'message' => 'Password could not be changed.'
            ]);
        }
    }

    public function updateProfilePhoto(Request $request)
    {

        $request->validate([
            'name' => 'required|min:3',
            'profile_photo' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $user = auth()->user();
        if ($request->hasFile('profile_photo')) {
            $path = $request->file('profile_photo')->store('profile_photos', 'public');

            if ($user->profile_photo && \Storage::disk('public')->exists($user->profile_photo)) {
                \Storage::disk('public')->delete($user->profile_photo);
            }

            $user->profile_photo = $path;
        }
        $user->name = $request->name;
        $user->save();
        return response()->json([
            'status' => 'success',
            'message' => 'Profile updated successfully!',
            'profile_photo_url' => $user->profile_photo ? asset('storage/' . $user->profile_photo) : null,
            'redirect_url' => route('edit.profile.page')
        ]);
    }
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/admin/login');
    }
}
