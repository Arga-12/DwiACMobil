# DwiACMobil

Sistem Informasi Bengkel AC Mobil.

## Cara Menjalankan Project Secara Lokal

Ikuti langkah-langkah berikut untuk menjalankan proyek ini di komputer lokal Anda.

### Prasyarat

Pastikan Anda telah menginstal:

- [PHP](https://www.php.net/downloads) (Versi 8.1 atau terbaru)
- [Composer](https://getcomposer.org/)
- [MySQL](https://www.mysql.com/) (Bisa via XAMPP/Laragon)
- [Node.js & NPM](https://nodejs.org/)

### Langkah Instalasi

1.  **Clone Repository**

    ```bash
    git clone https://github.com/Arga-12/DwiACMobil.git
    cd dwiacmobil
    ```

2.  **Install Dependencies**
    Install paket PHP dan JavaScript:

    ```bash
    composer install
    npm install
    ```

3.  **Setup Environment**
    Salin file `.env.example` menjadi `.env`:

    ```bash
    cp .env.example .env
    ```

    Generate application key:

    ```bash
    php artisan key:generate
    ```

4.  **Konfigurasi Database**
    - Buat database baru di MySQL (misal: `dwiacmobil`).
    - Buka file `.env` dan sesuaikan konfigurasi database:
        ```env
        DB_CONNECTION=mysql
        DB_HOST=127.0.0.1
        DB_PORT=3306
        DB_DATABASE=dwiacmobil
        DB_USERNAME=root
        DB_PASSWORD=
        ```

5.  **Migrate & Seed Database**
    Jalankan migrasi dan seeder untuk membuat tabel dan data awal:

    ```bash
    php artisan migrate --seed
    ```

6.  **Jalankan Aplikasi**
    Jalankan server Laravel:

    ```bash
    php artisan serve
    ```

    Jalankan build aset (Vite):

    ```bash
    npm run dev
    ```

    Buka browser dan akses: `http://localhost:8000`

## Akun Default

Gunakan akun berikut untuk login:

### Admin

- **Email**: `admin@dwiacmobil.com`
- **Password**: `admin123`

### Montir

- **Email**: `ahmad@dwiacmobil.com`
- **Password**: `montir123`
