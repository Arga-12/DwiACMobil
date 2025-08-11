# Sistem Autentikasi Dwi AC Mobil

## File yang Telah Dibuat

### 1. Controller
- `app/Http/Controllers/AuthController.php` - Controller untuk menangani login, register, dan logout

### 2. Views
- `resources/views/auth/login.blade.php` - Halaman login
- `resources/views/auth/register.blade.php` - Halaman registrasi
- `resources/views/components/alert.blade.php` - Komponen untuk menampilkan pesan

### 3. Middleware
- `app/Http/Middleware/CheckAuth.php` - Middleware untuk mengecek status autentikasi

### 4. Routes
Routes telah ditambahkan di `routes/web.php`:
```php
// Authentication Routes
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
```

## Fitur yang Tersedia

### 1. Login
- Form login dengan email dan password
- Validasi input
- Remember me functionality
- Social login (Google & Facebook) - placeholder
- Error handling

### 2. Register
- Form registrasi dengan nama, email, password, dan konfirmasi password
- Validasi input
- Terms and conditions checkbox
- Social register (Google & Facebook) - placeholder
- Error handling

### 3. Logout
- Logout dengan session cleanup
- Redirect ke halaman utama

### 4. Navigation
- Menu dinamis berdasarkan status login
- Dropdown menu untuk user yang sudah login
- Mobile responsive

## Cara Penggunaan

### 1. Akses Halaman Login
```
http://localhost/dwiacmobil/login
```

### 2. Akses Halaman Register
```
http://localhost/dwiacmobil/register
```

### 3. Melindungi Halaman dengan Middleware
Tambahkan middleware ke route yang memerlukan autentikasi:
```php
Route::get('/protected-page', function () {
    return view('protected-page');
})->middleware('auth');
```

### 4. Mengecek Status Login di View
```php
@guest
    <!-- Konten untuk user yang belum login -->
@else
    <!-- Konten untuk user yang sudah login -->
    {{ Auth::user()->name }}
@endguest
```

## Validasi

### Login
- Email: required, valid email format
- Password: required, minimum 6 karakter

### Register
- Name: required, maksimal 255 karakter
- Email: required, valid email format, unique
- Password: required, minimum 8 karakter, confirmed

## Keamanan

- Password di-hash menggunakan bcrypt
- CSRF protection
- Session regeneration setelah login
- Session invalidation setelah logout

## Styling

- Menggunakan Tailwind CSS
- Responsive design
- Konsisten dengan design system yang ada
- Logo Dwi AC Mobil terintegrasi

## Langkah Selanjutnya

1. **Setup Database**: Pastikan migration users table sudah dijalankan
2. **Konfigurasi Email**: Untuk fitur reset password
3. **Social Login**: Implementasi Google dan Facebook OAuth
4. **Email Verification**: Verifikasi email setelah registrasi
5. **Password Reset**: Fitur lupa password
6. **Profile Management**: Halaman edit profil user 