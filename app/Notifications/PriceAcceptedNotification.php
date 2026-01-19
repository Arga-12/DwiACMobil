<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use App\Models\AntriStruk;

class PriceAcceptedNotification extends Notification
{
    use Queueable;

    protected $booking;

    /**
     * Create a new notification instance.
     */
    public function __construct(AntriStruk $booking)
    {
        $this->booking = $booking;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['database'];
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            'type' => 'price_accepted',
            'nomor_booking' => $this->booking->nomor_booking,
            'customer_name' => $this->booking->pelanggan->nama ?? 'Pelanggan',
            'mobil' => $this->booking->mobil->nama_mobil ?? '—',
            'plate' => $this->booking->mobil->plat_nomor ?? '',
            'status_to' => $this->booking->status,
            'label_to' => $this->getStatusLabel($this->booking->status),
            'booking_id' => $this->booking->id_antri_struk,
            'price' => $this->booking->harga_keseluruhan,
            'message' => ($this->booking->pelanggan->nama ?? 'Pelanggan') . ' menerima harga Rp ' . number_format($this->booking->harga_keseluruhan, 0, ',', '.'),
        ];
    }

    /**
     * Get status label in Indonesian
     */
    private function getStatusLabel($status)
    {
        return match($status) {
            AntriStruk::STATUS_PENDING => 'Menunggu Konfirmasi',
            AntriStruk::STATUS_HARGA_DARI_ADMIN => 'Menunggu Persetujuan Harga',
            AntriStruk::STATUS_DALAM_ANTRIAN => 'Dalam Antrian',
            AntriStruk::STATUS_DALAM_SERVISAN => 'Sedang Dikerjakan',
            AntriStruk::STATUS_SELESAI => 'Selesai',
            AntriStruk::STATUS_CANCELLED => 'Dibatalkan',
            default => ucfirst($status),
        };
    }
}
