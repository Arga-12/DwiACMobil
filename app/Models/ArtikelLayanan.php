<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ArtikelLayanan extends Model
{
    use HasFactory;

    protected $table = 'artikel_layanan';
    protected $primaryKey = 'id';

    protected $fillable = [
        'judul',
        'slug',
        'foto',
        'deskripsi',
        'poin',
        'durasi_min',
        'durasi_maks',
        'harga',
        'suka',
        'garansi_hari',
        'dipublikasi',
        'tanggal_publikasi',
    ];

    protected $casts = [
        'poin' => 'array',
        'suka' => 'integer',
        'dipublikasi' => 'boolean',
        'tanggal_publikasi' => 'datetime',
    ];

    protected $appends = ['liked'];

    public function getLikedAttribute()
    {
        $sessionKey = 'liked_artikel_' . $this->id;
        return session()->has($sessionKey);
    }
}