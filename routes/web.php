<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

Route::get('/', function () {
    return view('beranda');
})->name('beranda');

Route::get('/layanan', function () {
    return view('layanan');
})->name('layanan');

// existing routes...
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');

Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register.post');

// logout
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

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
