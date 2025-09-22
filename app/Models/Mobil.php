<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\AntriStruk;
use App\Models\Pelanggan;

class Mobil extends Model
{
    use HasFactory;

    protected $table = 'mobil';
    protected $primaryKey = 'id_mobil';
    public $incrementing = true;
    protected $keyType = 'int';

    protected $fillable = [
        'nama_mobil',
        'jenis_mobil',
        'plat_nomor',
        'id_pelanggan',
    ];

    // Use custom route key for implicit model binding
    public function getRouteKeyName()
    {
        return 'id_mobil';
    }

    public function pelanggan()
    {
        return $this->belongsTo(Pelanggan::class, 'id_pelanggan', 'id_pelanggan');
    }

    public function antriStruk()
    {
        return $this->hasMany(AntriStruk::class, 'id_mobil', 'id_mobil');
    }
}
