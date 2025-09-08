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
            'no_wa' => '08123456789',
            'facebook' => 'dwiacmobil',
            'peran' => 'admin',
            'keterangan' => 'Administrator utama sistem DwiAC Mobil',
            'foto' => null,
            'tgl_dibuat' => now(),
            'is_active' => true,
        ]);

        Montir::create([
            'nama' => 'Ahmad Montir',
            'email' => 'ahmad@dwiacmobil.com',
            'password' => Hash::make('montir123'),
            'no_wa' => '08987654321',
            'facebook' => 'ahmad.montir',
            'peran' => 'montir',
            'keterangan' => 'Montir spesialis AC mobil dengan pengalaman 5 tahun',
            'foto' => null,
            'tgl_dibuat' => now(),
            'is_active' => true,
        ]);

        Montir::create([
            'nama' => 'Budi Teknisi',
            'email' => 'budi@dwiacmobil.com',
            'password' => Hash::make('teknisi123'),
            'no_wa' => '08111222333',
            'facebook' => 'budi.teknisi',
            'peran' => 'montir',
            'keterangan' => 'Teknisi ahli engine dan sistem kelistrikan mobil',
            'foto' => null,
            'tgl_dibuat' => now(),
            'is_active' => true,
        ]);
    }
}
