<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Models\Mobil;
use App\Models\AntriStruk;

class Pelanggan extends Authenticatable
{
    use Notifiable;

    protected $table = 'pelanggan';
    protected $primaryKey = 'id_pelanggan';
    public $incrementing = true;
    protected $keyType = 'int';

    // Jika tabel menggunakan created_at/updated_at, biarkan timestamps = true
    public $timestamps = true;

    // kolom yang boleh diisi mass-assignment
    protected $fillable = [
        'nama',
        'email',
        'password',
        'no_wa',
        'alamat',
        'is_active',
        'profile_photo',
    ];

    // jangan kembalikan password ke JSON
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function mobils()
    {
        return $this->hasMany(Mobil::class, 'id_pelanggan', 'id_pelanggan');
    }

    public function antriStruks()
    {
        return $this->hasMany(AntriStruk::class, 'id_pelanggan', 'id_pelanggan');
    }
}
