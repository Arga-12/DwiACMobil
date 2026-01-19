<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Pelanggan;
use App\Models\Montir;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create sample customers for testing

        Montir::create([
            'nama' => 'Admin DwiAC',
            'email' => 'admin@dwiacmobil.com',
            'password' => Hash::make('admin123'),
            'peran' => 'admin',
            'foto' => null,
            'tgl_dibuat' => now(),
            'aktif' => true,
        ]);

        Montir::create([
            'nama' => 'Ahmad Montir',
            'email' => 'ahmad@dwiacmobil.com',
            'password' => Hash::make('montir123'),
            'peran' => 'montir',
            'foto' => null,
            'tgl_dibuat' => now(),
            'aktif' => true,
        ]);

        Montir::create([
            'nama' => 'Budi Teknisi',
            'email' => 'budi@dwiacmobil.com',
            'password' => Hash::make('teknisi123'),
            'peran' => 'montir',
            'foto' => null,
            'tgl_dibuat' => now(),
            'aktif' => true,
        ]);
    }
}
