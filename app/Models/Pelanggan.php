<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Models\Mobil;
use App\Models\AntriStruk;
use App\Models\Rating;

class Pelanggan extends Authenticatable
{
    use Notifiable;

    protected $table = "pelanggan";
    protected $primaryKey = "id_pelanggan";
    public $incrementing = true;
    protected $keyType = "int";

    // Jika tabel menggunakan created_at/updated_at, biarkan timestamps = true
    public $timestamps = true;

    // kolom yang boleh diisi mass-assignment
    protected $fillable = [
        "nama",
        "email",
        "password",
        "no_wa",
        "alamat",
        "aktif",
        "foto_profil",
    ];

    // jangan kembalikan password ke JSON
    protected $hidden = ["password", "remember_token"];

    public function mobils()
    {
        return $this->hasMany(Mobil::class, "id_pelanggan", "id_pelanggan");
    }

    public function antriStruks()
    {
        return $this->hasMany(
            AntriStruk::class,
            "id_pelanggan",
            "id_pelanggan",
        );
    }

    public function ratings()
    {
        return $this->hasMany(Rating::class, "id_pelanggan", "id_pelanggan");
    }
}
