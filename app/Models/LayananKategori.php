<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LayananKategori extends Model
{
    use HasFactory;

    protected $table = 'layanan_kategori';
    protected $primaryKey = 'id_kategori';
    public $incrementing = true;
    protected $keyType = 'int';

    protected $fillable = [
        'nama',
        'slug',
    ];

    public function layanan()
    {
        return $this->hasMany(Layanan::class, 'id_kategori', 'id_kategori');
    }
}
