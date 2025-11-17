<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\User\DashboardController;
use App\Http\Controllers\User\ProfileController;
use App\Http\Controllers\User\UserBookingController;
use App\Http\Controllers\User\UserMobilController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\AdminLayananController;
use \App\Http\Controllers\Admin\AntrianController;
// use App\Http\Controllers\Website\WebsiteController;

// Public Routes
Route::get('/', function () {
    return view('beranda');
})->name('beranda');

Route::get('/layanan', function () {
    return view('layanan');
})->name('layanan');

// Halaman detail artikel layanan (sample UI) - path utama yang diminta
Route::get('/layanan/detail-layanan', function () {
    $service = [
        'title' => 'Isi Freon',
        'image' => asset('images/layanan/isi-freon.png'),
        'quote' => 'Isi freon di Dwi AC Mobil dijamin aman, berkualitas, dan sesuai standar pabrik.',
        'description' => 'Freon adalah komponen utama yang membuat AC mobil mengeluarkan udara dingin. Jika freon berkurang atau habis, AC tidak akan bekerja maksimal dan udara yang keluar menjadi panas. Oleh karena itu, isi ulang freon perlu dilakukan secara berkala. Pengisian freon harus sesuai dengan tekanan dan jenis yang direkomendasikan agar kinerja AC tetap optimal dan kompresor tidak cepat rusak. Dengan servis freon yang tepat, kenyamanan berkendara tetap terjaga, terutama di cuaca panas.',
        'points' => [
            'Setiap kali isi freon, sebaiknya dilakukan pengecekan tekanan dan kebocoran sistem AC agar freon tidak cepat habis.',
            'Jenis freon harus disesuaikan dengan spesifikasi mobil Anda untuk hasil yang maksimal dan aman bagi sistem AC.',
            'Pengisian freon sebaiknya dilakukan setiap 1 tahun atau saat AC mulai terasa kurang dingin.',
            'Jika Anda mencium bau gas atau AC tiba-tiba tidak dingin, bisa jadi ada kebocoran pada sistem freon.',
            'Mengemudi dengan AC yang kekurangan freon bisa membuat kompresor dan menyebabkan kerusakan pada sistem AC mobil Anda.',
        ],
    ];
    return view('layanan-detail-contoh', compact('service'));
})->name('layanan.detail');

// Guest Routes (Only for non-authenticated users)
Route::middleware('auth.middleware:guest,web')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.post');
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register'])->name('register.post');
});

// Logout route - accessible by both guards
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Authenticated User Routes
Route::middleware('auth.middleware:auth,web')->group(function () {
    // User Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Booking Pelanggan
    Route::get('/booking', [UserBookingController::class, 'index'])->name('booking');
    Route::post('/booking', [UserBookingController::class, 'store'])->name('booking.store');
    Route::post('/booking/add-car', [UserBookingController::class, 'addCar'])->name('booking.add-car');

    // Profile
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');

     // Cars Management
     Route::resource('mobil', UserMobilController::class, [
        'names' => [
            'create' => 'user.mobil.create',
            'store' => 'user.mobil.store',
            'edit' => 'user.mobil.edit',
            'update' => 'user.mobil.update',
            'destroy' => 'user.mobil.destroy'
        ],
        'except' => ['index', 'show']
    ]);

    // Manajemen Antrian
    Route::get('/antrian', [UserBookingController::class, 'antrian'])
    ->name('antrian');

    // Notifications
    Route::get('/notifications', function () {
        return view('user.notifications');
    })->name('notifications');
});

// User Antrian actions (called from booking receipt modal)
Route::middleware('auth.middleware:auth,web')->prefix('user')->group(function () {
    Route::post('/antrian/{id}/confirm-price', [UserBookingController::class, 'confirmPrice'])
        ->name('user.antrian.confirm_price');
    Route::post('/antrian/{id}/cancel', [UserBookingController::class, 'cancel'])
        ->name('user.antrian.cancel');
});

// Admin Routes - separate middleware group
Route::middleware('auth.middleware:auth,montir')->prefix('admin')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');

    // Admin Antrian management
    Route::get('/antrian', [AntrianController::class, 'index'])->name('admin.antrian');
    Route::post('/antrian/{id}/set-price', [AntrianController::class, 'setPrice'])->name('admin.antrian.set_price');
    Route::post('/antrian/{id}/start', [AntrianController::class, 'startService'])->name('admin.antrian.start');
    Route::post('/antrian/{id}/finish', [AntrianController::class, 'finish'])->name('admin.antrian.finish');
    Route::post('/antrian/{id}/cancel', [AntrianController::class, 'cancel'])->name('admin.antrian.cancel');

    // Layanan Management (CRUD)
    Route::get('/layanan', [AdminLayananController::class, 'index'])->name('admin.layanan');
    Route::get('/layanan/create', [AdminLayananController::class, 'create'])->name('admin.layanan.create');
    Route::post('/layanan', [AdminLayananController::class, 'storeLayanan'])->name('admin.layanan.store');
    Route::get('/layanan/{id}/edit', [AdminLayananController::class, 'edit'])->name('admin.layanan.edit');
    Route::put('/layanan/{id}', [AdminLayananController::class, 'updateLayanan'])->name('admin.layanan.update');
    Route::delete('/layanan/{id}', [AdminLayananController::class, 'destroyLayanan'])->name('admin.layanan.destroy');

    // Kategori Management 
    Route::post('/kategori', [AdminLayananController::class, 'storeKategori'])->name('admin.kategori.store');
    Route::delete('/kategori/{id}', [AdminLayananController::class, 'destroyKategori'])->name('admin.kategori.destroy');
    Route::get('/galeri', [AdminController::class, 'galeri'])->name('admin.galeri.index');
    Route::get('/montir', [AdminController::class, 'montir'])->name('admin.montir.index');
    // Artikel Layanan (Admin)
    Route::get('/artikel', [AdminController::class, 'artikelIndex'])->name('admin.artikel.index');
    // Admin Profile
    Route::get('/profile', [AdminController::class, 'profile'])->name('admin.profil-admin');
    Route::put('/profile', [AdminController::class, 'updateProfile'])->name('admin.profile.update');
    // Montir Management (create via modal on profile page)
    Route::post('/montir', [AdminController::class, 'storeMontir'])->name('admin.montir.store');
});
