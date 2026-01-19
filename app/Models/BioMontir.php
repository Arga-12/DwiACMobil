<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BioMontir extends Model
{
    use HasFactory;

    protected $table = "bio_montir";

    protected $fillable = [
        "nama",
        "peringkat",
        "email",
        "nomor_telepon",
        "kutipan",
        "foto",
    ];

    protected $casts = [
        "created_at" => "datetime",
        "updated_at" => "datetime",
    ];
}
