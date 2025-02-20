<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class SocialAuthController extends Controller
{
    // Redirect ke provider
    public function redirectToProvider($provider)
    {
        return Socialite::driver($provider)->redirect();
    }

    // Handle callback dari provider
    public function handleProviderCallback($provider)
    {
    try {
        $socialUser = Socialite::driver($provider)->user();
        $username = explode('@', $socialUser->getEmail())[0]; // Ambil username dari email

        // Tentukan first_name (5 karakter pertama) dan last_name (5 karakter terakhir)
        $first_name = substr($username, 0, min(5, strlen($username)));
        $last_name = substr($username, -min(5, strlen($username)));

        $user = User::where('provider', $provider)
                    ->where('provider_id', $socialUser->getId())
                    ->orWhere('email', $socialUser->getEmail()) // Jika email sudah ada
                    ->first();

        if (!$user) {
            $user = User::create([
                'first_name' => ucfirst($first_name), // Ubah huruf pertama menjadi kapital
                'last_name' => ucfirst($last_name),
                'username' => $username, 
                'email' => $socialUser->getEmail(),
                'password' => bcrypt(uniqid()), 
                'avatar' => $socialUser->getAvatar(),
                'provider' => $provider,
                'provider_id' => $socialUser->getId(),
            ]);
        }

        Auth::login($user);
        return redirect()->route('dashboard')->with('success', 'Login berhasil!');
    } catch (\Exception $e) {
        return redirect()->route('login')->with('error', 'Login gagal, coba lagi.');
    }
    }
}
