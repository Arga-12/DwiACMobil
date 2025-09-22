<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ArtikelLayanan extends Model
{
    use HasFactory;

    protected $table = 'artike_layanan';
    protected $primaryKey = 'id';

    protected $fillable = [
        'title',
        'slug',
        'foto',
        'quote',
        'description',
        'points',
    ];

    protected $casts = [
        'points' => 'array',
    ];
}
