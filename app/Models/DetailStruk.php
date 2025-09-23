<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailStruk extends Model
{
    use HasFactory;

    protected $table = 'detail_struk';
    protected $primaryKey = 'id_detail_struk';
    public $incrementing = true;
    protected $keyType = 'int';

    protected $fillable = [
        'id_antri_struk',
        'id_layanan',
        'tipe',
        'deskripsi',
        'qty',
        'harga_satuan',
        'subtotal',
    ];

    public function antriStruk()
    {
        return $this->belongsTo(AntriStruk::class, 'id_antri_struk', 'id_antri_struk');
    }

    public function layanan()
    {
        return $this->belongsTo(Layanan::class, 'id_layanan', 'id_layanan');
    }
}
