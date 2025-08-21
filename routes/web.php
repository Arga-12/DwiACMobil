<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ExampleController;

Route::get('/', function () {
    return view('beranda');
})->name('beranda');

Route::get('/layanan', function () {
    return view('layanan');
})->name('layanan');

// Authentication Routes (Frontend Only)
Route::get('/login', function () {
    return view('auth.login');
});

Route::get('/register', function () {
    return view('auth.register');
});

// Dashboard Routes
Route::get('/dashboard', function () {
    return view('user.dashboard');
})->name('dashboard');

Route::get('/booking', function () {
    return view('user.booking');
})->name('booking');

Route::get('/profile', function () {
    return view('user.profile');
})->name('profile');

Route::get('/history', function () {
    return view('user.history');
})->name('history');

Route::get('/notifications', function () {
    return view('user.notifications');
})->name('notifications');
