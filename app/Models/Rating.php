<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rating extends Model
{
    use HasFactory;

    protected $table = "rating";
    protected $primaryKey = "id_rating";

    protected $fillable = ["email", "bintang", "ulasan", "id_pelanggan"];

    protected $casts = [
        "bintang" => "integer",
        "created_at" => "datetime",
        "updated_at" => "datetime",
    ];

    /**
     * Relationship with Pelanggan
     */
    public function pelanggan()
    {
        return $this->belongsTo(
            Pelanggan::class,
            "id_pelanggan",
            "id_pelanggan",
        );
    }

    /**
     * Scope for filtering by rating
     */
    public function scopeWithRating($query, $rating)
    {
        return $query->where("bintang", $rating);
    }

    /**
     * Scope for recent ratings
     */
    public function scopeRecent($query, $limit = 10)
    {
        return $query->orderBy("created_at", "desc")->limit($limit);
    }

    /**
     * Get average rating
     */
    public static function getAverageRating()
    {
        return static::avg("bintang");
    }

    /**
     * Get rating distribution
     */
    public static function getRatingDistribution()
    {
        return static::selectRaw("bintang, COUNT(*) as count")
            ->groupBy("bintang")
            ->orderBy("bintang", "desc")
            ->pluck("count", "bintang")
            ->toArray();
    }
}
