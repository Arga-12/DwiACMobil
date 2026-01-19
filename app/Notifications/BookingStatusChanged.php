<?php

namespace App\Notifications;

use App\Models\AntriStruk;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Carbon;

class BookingStatusChanged extends Notification
{
    use Queueable;

    private AntriStruk $booking;
    private string $from;
    private string $to;

    public function __construct(AntriStruk $booking, string $from, string $to)
    {
        $this->booking = $booking;
        $this->from = strtolower((string)$from);
        $this->to = strtolower((string)$to);
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
     * Get the database representation of the notification.
     */
    public function toDatabase(object $notifiable): array
    {
        return [
            'nomor_booking' => $this->booking->nomor_booking,
            'status_from' => $this->from,
            'status_to' => $this->to,
            'label_from' => $this->label($this->from),
            'label_to' => $this->label($this->to),
            'mobil' => optional($this->booking->mobil)->nama_mobil,
            'plate' => optional($this->booking->mobil)->plat_nomor,
            'harga' => $this->booking->harga_keseluruhan,
            'at' => Carbon::now()->toDateTimeString(),
            'url' => route('antrian'),
        ];
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            //
        ];
    }

    private function label(string $status): string
    {
        return match ($status) {
            AntriStruk::STATUS_PENDING => 'Menunggu Konfirmasi Harga',
            AntriStruk::STATUS_HARGA_DARI_ADMIN => 'Harga dari Admin',
            AntriStruk::STATUS_DALAM_ANTRIAN => 'Dalam Antrian',
            AntriStruk::STATUS_DALAM_SERVISAN => 'Dalam Servisan',
            AntriStruk::STATUS_SELESAI => 'Selesai',
            'cancelled' => 'Dibatalkan',
            default => ucfirst(str_replace('_', ' ', $status)),
        };
    }
}
