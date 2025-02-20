<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    public function register(Request $request)
{
    // Validate input
    $validator = Validator::make($request->all(), [
        'first_name' => ['required', 'string', 'max:255'],
        'last_name' => ['required', 'string', 'max:255'],
        'username' => ['required', 'string', 'max:255', 'unique:users'],
        'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
        'password' => ['required', 'confirmed', 'min:8', Rules\Password::defaults()],
        'terms' => ['required', 'accepted'],
    ], [
        'first_name.required' => 'Nama depan tidak boleh kosong.',
        'last_name.required' => 'Nama belakang tidak boleh kosong.',
        'username.required' => 'Username tidak boleh kosong.',
        'username.unique' => 'Username sudah digunakan.',
        'email.required' => 'Email tidak boleh kosong.',
        'email.email' => 'Format email tidak valid.',
        'email.unique' => 'Email sudah digunakan.',
        'password.required' => 'Password tidak boleh kosong.',
        'password.confirmed' => 'Konfirmasi password tidak cocok.',
        'terms.required' => 'Anda harus menyetujui syarat dan ketentuan.',
        'terms.accepted' => 'Anda harus menyetujui syarat dan ketentuan.',
    ]);

    if ($validator->fails()) {
        return redirect()
            ->route('register')
            ->withErrors($validator)
            ->withInput($request->except('password', 'password_confirmation'));
    }

    // Create user
    $user = User::create([
        'first_name' => $request->first_name,
        'last_name' => $request->last_name,
        'username' => $request->username,
        'email' => $request->email,
        'password' => Hash::make($request->password),
    ]);

    return redirect()
        ->route('login')
        ->with('success', 'Akun berhasil dibuat! Silakan login.');
}

}