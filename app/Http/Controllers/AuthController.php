<?php

namespace App\Http\Controllers;

use App\Models\Pelanggan;
use App\Models\Montir;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class AuthController extends Controller
{
    // Tampilkan form login
    public function showLogin()
    {
        // Cek apakah sudah login sebagai pelanggan
        if (Auth::guard('web')->check()) {
            return redirect()->route('dashboard');
        }
        
        // Cek apakah sudah login sebagai montir/admin
        if (Auth::guard('montir')->check()) {
            return redirect()->route('admin.dashboard');
        }
        
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

        // Coba login sebagai montir/admin dulu menggunakan guard montir
        if (Auth::guard('montir')->attempt(['email' => $data['email'], 'password' => $data['password']], $remember)) {
            $request->session()->regenerate();
            return redirect()->intended(route('admin.dashboard'));
        }

        // Jika gagal, coba login sebagai pelanggan menggunakan guard web
        if (Auth::guard('web')->attempt(['email' => $data['email'], 'password' => $data['password']], $remember)) {
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
            'nama' => ['required','string','max:150'],
            'no_wa' => ['nullable','string','max:30'],
            'email' => ['required','email','max:255','unique:pelanggan,email'],
            'password' => ['required','confirmed', Password::min(8)],
        ]);

        $pelanggan = Pelanggan::create([
            'nama' => $validated['nama'],
            'no_wa' => $validated['no_wa'] ?? null,
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'aktif' => 1,
        ]);

        // login otomatis setelah registrasi
        Auth::login($pelanggan);

        return redirect()->route('dashboard');
    }

    // Logout
    public function logout(Request $request)
    {
        // Debug: Log current authentication state
        \Log::info('Logout attempt', [
            'web_authenticated' => Auth::guard('web')->check(),
            'montir_authenticated' => Auth::guard('montir')->check(),
            'session_id' => $request->session()->getId()
        ]);
        
        // Logout dari semua guards
        Auth::guard('web')->logout();
        Auth::guard('montir')->logout();
        
        // Clear session
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        
        \Log::info('Logout completed, redirecting to beranda');
        
        // Redirect ke beranda dengan URL absolut
        return redirect('/');
    }
}
