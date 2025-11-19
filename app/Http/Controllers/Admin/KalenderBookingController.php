<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AntriStruk;
use App\Models\KalenderLibur;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class KalenderBookingController extends Controller
{
    /**
     * Return aggregated booking data and holiday markers for the dashboard calendar.
     */
    public function index(Request $request): JsonResponse
    {
        [$start, $end] = $this->resolveRange($request);
        $onlyActive = $request->boolean('only_active', true);

        $bookingQuery = AntriStruk::query()
            ->with([
                'pelanggan:id_pelanggan,nama',
                'mobil:id_mobil,nama_mobil,plat_nomor',
            ])
            ->whereBetween('tanggal_pesan', [$start->copy()->startOfDay(), $end->copy()->endOfDay()])
            ->orderBy('tanggal_pesan');

        if ($onlyActive) {
            $bookingQuery->whereIn('status', AntriStruk::ACTIVE_STATUSES);
        }

        $bookings = $bookingQuery->get();

        $days = $bookings
            ->groupBy(fn ($booking) => optional($booking->tanggal_pesan)->toDateString())
            ->map(function ($items, $date) {
                $statusBreakdown = $items->groupBy('status')->map->count();

                return [
                    'date' => $date,
                    'total' => $items->count(),
                    'status_breakdown' => $statusBreakdown,
                    'bookings' => $items->map(function (AntriStruk $booking) {
                        return [
                            'id' => $booking->id_antri_struk,
                            'nomor_booking' => $booking->nomor_booking,
                            'status' => $booking->status,
                            'pelanggan' => $booking->pelanggan?->nama,
                            'mobil' => $booking->mobil?->nama_mobil,
                            'plat_nomor' => $booking->mobil?->plat_nomor,
                            'waktu' => optional($booking->tanggal_pesan)->format('H:i'),
                        ];
                    })->values(),
                ];
            })
            ->values();

        $holidays = KalenderLibur::betweenDates($start, $end)
            ->orderBy('tanggal')
            ->get()
            ->map(fn ($holiday) => [
                'id' => $holiday->id,
                'tanggal' => $holiday->tanggal->toDateString(),
                'judul' => $holiday->judul,
                'keterangan' => $holiday->keterangan,
            ])
            ->values();

        return response()->json([
            'range' => [
                'start' => $start->toDateString(),
                'end' => $end->toDateString(),
            ],
            'holidays' => $holidays,
            'days' => $days,
        ]);
    }

    /**
     * Resolve the date range for the calendar query.
     *
     * @return array{0: \Illuminate\Support\Carbon, 1: \Illuminate\Support\Carbon}
     */
    protected function resolveRange(Request $request): array
    {
        $startInput = $request->input('start_date');
        $endInput = $request->input('end_date');

        $start = $startInput
            ? Carbon::parse($startInput)->startOfDay()
            : Carbon::now()->startOfMonth();

        $end = $endInput
            ? Carbon::parse($endInput)->endOfDay()
            : $start->copy()->endOfMonth();

        if ($end->lessThan($start)) {
            [$start, $end] = [$end, $start];
        }

        return [$start, $end];
    }
}

