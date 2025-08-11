<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ExampleController;

Route::get('/', function () {
    return view('beranda');
})->name('beranda');

// Sections are handled in beranda via anchors; no separate routes for galeri/kontak/review

Route::get('/pelanggan', function () {
    return view('pelanggan');
});

Route::get('/layanan', function () {
    return view('layanan');
})->name('layanan');

Route::get('/welcome', function () {
    return view('welcome');
});

// Authentication Routes (Frontend Only)
Route::get('/login', function () {
    return view('auth.login');
});

Route::get('/register', function () {
    return view('auth.register');
});
