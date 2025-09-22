<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AntriStruk extends Model
{
    use HasFactory;

    // Status constants based on business logic
    public const STATUS_PENDING = 'pending'; // menunggu konfirmasi harga
    public const STATUS_HARGA_DARI_ADMIN = 'harga_dari_admin'; // admin memberi harga
    public const STATUS_DALAM_ANTRIAN = 'dalam_antrian'; // belum masuk servis, menunggu hari servis
    public const STATUS_DALAM_SERVISAN = 'dalam_servisan'; // sedang dikerjakan di bengkel
    public const STATUS_SELESAI = 'selesai'; // sudah dikembalikan ke pelanggan

    public const ACTIVE_STATUSES = [
        self::STATUS_PENDING,
        self::STATUS_HARGA_DARI_ADMIN,
        self::STATUS_DALAM_ANTRIAN,
        self::STATUS_DALAM_SERVISAN,
    ];

    public const HISTORY_STATUSES = [
        self::STATUS_SELESAI,
    ];

    protected $table = 'antri_struk';
    protected $primaryKey = 'id_antri_struk';
    public $incrementing = true;
    protected $keyType = 'int';

    protected $fillable = [
        'id_pelanggan',
        'id_mobil',
        'id_montir',
        'nomor_booking',
        'catatan',
        'pengambilan',
        'pengiriman',
        'alamat_pengambilan',
        'alamat_pengiriman',
        'status',
        'tanggal_pesan',
        'tanggal_selesai',
        'durasi_hari',
        'menginap',
        'harga_keseluruhan',
        'price_status',
    ]; 

    protected $casts = [
        'tanggal_pesan' => 'datetime',
        'tanggal_selesai' => 'datetime',
        'menginap' => 'boolean',
    ];

    public function pelanggan()
    {
        return $this->belongsTo(Pelanggan::class, 'id_pelanggan', 'id_pelanggan');
    }

    public function montir()
    {
        return $this->belongsTo(Montir::class, 'id_montir', 'id_montir');
    }

    public function details()
    {
        return $this->hasMany(DetailStruk::class, 'id_antri_struk', 'id_antri_struk');
    }
    public function mobil()
    {
        return $this->belongsTo(Mobil::class, 'id_mobil', 'id_mobil');
    }

    // Scopes
    public function scopeActive($query)
    {
        return $query->whereIn('status', self::ACTIVE_STATUSES);
    }

    public function scopeHistory($query)
    {
        return $query->whereIn('status', self::HISTORY_STATUSES);
    }
}
