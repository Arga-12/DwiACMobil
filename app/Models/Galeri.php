<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Galeri extends Model
{
    use HasFactory;

    protected $table = "website_galeri";
    protected $primaryKey = "id_galeri";
    public $timestamps = true;

    protected $fillable = ["foto", "nama_foto"];

    // Accessor untuk URL foto
    public function getFotoUrlAttribute()
    {
        if ($this->foto) {
            return asset("storage/galeri/" . $this->foto);
        }
        return "https://via.placeholder.com/300x300?text=No+Image";
    }

    // Accessor untuk path foto lengkap
    public function getFotoPathAttribute()
    {
        return "galeri/" . $this->foto;
    }
}
