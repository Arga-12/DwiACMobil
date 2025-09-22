<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Layanan extends Model
{
    use HasFactory;

    protected $table = 'layanan';
    protected $primaryKey = 'id_layanan';
    public $incrementing = true;
    protected $keyType = 'int';

    protected $fillable = [
        'id_kategori',
        'nama',
        'harga_default',
        'is_active',
    ];

    public function kategori()
    {
        return $this->belongsTo(LayananKategori::class, 'id_kategori', 'id_kategori');
    }

    public function detailStruk()
    {
        return $this->hasMany(DetailStruk::class, 'id_layanan', 'id_layanan');
    }
}
