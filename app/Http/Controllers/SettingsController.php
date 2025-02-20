<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class SettingsController extends Controller
{
    public function index()
    {
        return view('settings');
    }

    public function update(Request $request)
    {
        // Different validation rules based on login method
        if (Auth::user()->provider) {
            // Social login user validation (no password validation)
            $request->validate([
                'first_name' => 'required|string|max:255',
                'last_name' => 'required|string|max:255',
                'username' => 'required|string|max:255|unique:users,username,' . Auth::id(),
                'avatar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:5120',
            ]);
        } else {
            // Regular login user validation (includes password validation)
            $request->validate([
                'first_name' => 'required|string|max:255',
                'last_name' => 'required|string|max:255',
                'username' => 'required|string|max:255|unique:users,username,' . Auth::id(),
                'avatar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:5120',
                'password' => 'nullable|string|min:8|confirmed',
            ]);
        }

        $user = Auth::user();

        // Update name fields
        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->username = $request->username;

        // Handle avatar upload
        if ($request->hasFile('avatar')) {
            // Create avatars directory if it doesn't exist
            if (!Storage::disk('public')->exists('avatars')) {
                Storage::disk('public')->makeDirectory('avatars');
            }
            
            // Delete old avatar if exists
            if ($user->avatar && Storage::disk('public')->exists($user->avatar)) {
                Storage::disk('public')->delete($user->avatar);
            }
            
            $avatar = $request->file('avatar');
            $filename = 'avatars/' . time() . '.' . $avatar->getClientOriginalExtension();
            
            // Store the new avatar
            Storage::disk('public')->putFileAs('', $avatar, $filename);
            $user->avatar = $filename;
        }

        // Update password if provided (only for non-social login users)
        if (!$user->provider && $request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        $user->save();

        return redirect()->back()->with('success', 'Profile updated successfully!');
    }
}