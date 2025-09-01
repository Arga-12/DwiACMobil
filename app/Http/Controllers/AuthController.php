<?php

namespace App\Http\Controllers;

use App\Models\Pelanggan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class AuthController extends Controller
{
    // Tampilkan form login
    public function showLogin()
    {
        if (Auth::check()) return redirect()->route('dashboard');
        return view('auth.login');
    }

    // Proses login
    public function login(Request $request)
    {
        $data = $request->validate([
            'email' => ['required','email'],
            'password' => ['required'],
        ]);

        $remember = $request->has('remember');

        // Guard default (web) menggunakan provider yang sudah kita atur di config/auth.php
        if (Auth::attempt(['email' => $data['email'], 'password' => $data['password']], $remember)) {
            $request->session()->regenerate();
            return redirect()->intended(route('dashboard'));
        }

        return back()->withErrors([
            'email' => 'Kredensial tidak sesuai atau user tidak ditemukan.'
        ])->withInput($request->only('email'));
    }

    // Tampilkan form register
    public function showRegister()
    {
        if (Auth::check()) return redirect()->route('dashboard');
        return view('auth.register');
    }

    // Proses register
    public function register(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required','string','max:150'],
            'whatsapp' => ['nullable','string','max:30'],
            'email' => ['required','email','max:255','unique:pelanggan,email'],
            'password' => ['required','confirmed', Password::min(8)],
        ]);

        $pelanggan = Pelanggan::create([
            'nama' => $validated['name'],
            'no_wa' => $validated['whatsapp'] ?? null,
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'is_active' => 1,
        ]);

        // login otomatis setelah registrasi
        Auth::login($pelanggan);

        return redirect()->route('dashboard');
    }

    // Logout
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('beranda');
    }
}
