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
        'title',
        'slug',
        'foto',
        'description',
        'points',
        'duration_min',
        'duration_max',
        'price',
        'likes',
        'guarantee_days',
        'is_published',
        'published_at',
    ];

    protected $casts = [
        'points' => 'array',
        'likes' => 'integer',
        'is_published' => 'boolean',
        'published_at' => 'datetime',
    ];

    protected $appends = ['liked'];

    public function getLikedAttribute()
    {
        $sessionKey = 'liked_artikel_' . $this->id;
        return session()->has($sessionKey);
    }
}