<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class KalenderLibur extends Model
{
    use HasFactory;

    protected $table = 'kalender_libur';

    protected $fillable = [
        'tanggal',
        'judul',
        'keterangan',
    ];

    protected $casts = [
        'tanggal' => 'date',
    ];

    /**
     * Scope a query to only include holidays inside a given date range.
     */
    public function scopeBetweenDates($query, Carbon $start, Carbon $end)
    {
        return $query->whereBetween('tanggal', [$start->toDateString(), $end->toDateString()]);
    }
}
