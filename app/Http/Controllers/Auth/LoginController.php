<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
{
    $request->validate([
        'username' => 'required|string',
        'password' => 'required',
    ], [
        'username.required' => 'Username tidak boleh kosong.',
        'password.required' => 'Password tidak boleh kosong.',
    ]);

    $credentials = $request->only('username', 'password');

    if (Auth::attempt($credentials, $request->filled('remember'))) {
        $request->session()->regenerate();
        return redirect()->intended('/dashboard')
            ->with('success', 'Login berhasil!');
    }

    return back()
        ->withErrors(['username' => 'Username atau password salah!'])
        ->withInput($request->except('password'));
}

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        
        return redirect('/login')->with('success', 'Anda telah logout.');
    }
}