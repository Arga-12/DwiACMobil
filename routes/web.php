<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\User\DashboardController;
use App\Http\Controllers\User\ProfileController;
use App\Http\Controllers\Admin\AdminController;
// use App\Http\Controllers\Website\WebsiteController;

// Public Routes
Route::get('/', function () {
    return view('beranda');
})->name('beranda');

Route::get('/layanan', function () {
    return view('layanan');
})->name('layanan');


// Guest Routes (Only for non-authenticated users)
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.post');
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register'])->name('register.post');
});

// Logout route - accessible by both guards
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Authenticated User Routes
Route::middleware('auth')->group(function () {
    // User Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Booking
    Route::get('/booking', function () {
        return view('user.booking');
    })->name('booking');

    // Profile
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');

    // History
    Route::get('/history', function () {
        return view('user.history');
    })->name('history');

    // Notifications
    Route::get('/notifications', function () {
        return view('user.notifications');
    })->name('notifications');
});

// Admin Routes - separate middleware group
Route::middleware('auth:montir')->prefix('admin')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::get('/antrian', [AdminController::class, 'antrian'])->name('admin.antrian');
    Route::get('/layanan', [AdminController::class, 'layanan'])->name('admin.layanan');
    Route::get('/galeri', [AdminController::class, 'galeri'])->name('admin.galeri.index');
    Route::get('/montir', [AdminController::class, 'montir'])->name('admin.montir.index');
});
