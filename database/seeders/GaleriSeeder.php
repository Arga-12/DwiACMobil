<?php

namespace Database\Seeders;

use App\Models\Galeri;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class GaleriSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $galeris = [
            [
                "foto" => null, // akan diisi nanti dengan upload foto
                "nama_foto" => "Proses Service AC Mobil Avanza",
            ],
            [
                "foto" => null,
                "nama_foto" => "Hasil Cuci Steam AC Mobil",
            ],
            [
                "foto" => null,
                "nama_foto" => "Service AC Mobil Honda Jazz",
            ],
            [
                "foto" => null,
                "nama_foto" => "Perbaikan Kompresor AC Mobil",
            ],
            [
                "foto" => null,
                "nama_foto" => "Before After Service AC",
            ],
            [
                "foto" => null,
                "nama_foto" => "Pembersihan Ducting AC",
            ],
            [
                "foto" => null,
                "nama_foto" => "Service AC Mobil Innova",
            ],
            [
                "foto" => null,
                "nama_foto" => "Cuci Evaporator AC Mobil",
            ],
            [
                "foto" => null,
                "nama_foto" => "Service AC Mobil Fortuner",
            ],
            [
                "foto" => null,
                "nama_foto" => "Perbaikan Kebocoran Freon",
            ],
            [
                "foto" => null,
                "nama_foto" => "Service AC Mobil Xenia",
            ],
            [
                "foto" => null,
                "nama_foto" => "Instalasi AC Double Blower",
            ],
        ];

        foreach ($galeris as $galeri) {
            Galeri::create($galeri);
        }
    }
}
