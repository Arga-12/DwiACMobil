<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pelanggan;
use App\Models\AntriStruk;
use App\Models\Mobil;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        
        // Get active bookings list for dashboard (pending, harga_dari_admin, dalam_antrian, dalam_servisan)
        // The view will limit to 3 and map labels.
        $currentBooking = AntriStruk::with(['mobil', 'details'])
            ->where('id_pelanggan', $user->id_pelanggan)
            ->active() // uses model scope with new statuses
            ->orderBy('tanggal_pesan')
            ->get();
        
        // Get activity summary
        $activitySummary = $this->getActivitySummary($user);
        
        // Get user's cars from database
        $userCars = $this->getUserCars($user);
        
        return view('user.dashboard', compact('currentBooking', 'activitySummary', 'userCars'));
    }
    
    public function antrian()
    {
        $user = Auth::user();
        // Current booking (array prepared by getCurrentBooking)
        $currentBooking = $this->getCurrentBooking($user);

        // Build simple riwayat collection (example using AntriStruk)
        // Adjust statuses according to your actual schema
        $riwayat = AntriStruk::with('mobil')
            ->where('id_pelanggan', $user->id_pelanggan)
            ->whereIn('status', ['completed', 'cancelled', 'selesai', 'dibatalkan'])
            ->orderByDesc('created_at')
            ->get()
            ->map(function($row){
                return [
                    'judul' => 'Booking AC',
                    'tanggal' => optional($row->created_at)->format('d F Y'),
                    'mobil' => optional($row->mobil)->nama_mobil ? optional($row->mobil)->nama_mobil . ' (' . optional($row->mobil)->plat_nomor . ')' : '—',
                    'status' => $row->status ?? 'Selesai',
                    'waktu' => $row->tanggal_pesan ? optional(\Carbon\Carbon::parse($row->tanggal_pesan))->format('H:i') . ' - •••' : null,
                ];
            });

        return view('user.antrian', compact('currentBooking', 'riwayat'));
    }

    private function getCurrentBooking($user)
    {
        // Get the latest booking for the user
        $latestBooking = AntriStruk::with(['mobil', 'details.layanan'])
            ->where('id_pelanggan', $user->id_pelanggan)
            ->orderBy('created_at', 'desc')
            ->first();

        if (!$latestBooking) {
            return null;
        }

        // Format services list
        $services = $latestBooking->details->map(function($detail) {
            return $detail->layanan->nama;
        })->toArray();

        // Format date
        $tanggalPesan = Carbon::parse($latestBooking->tanggal_pesan);
        $formattedDate = $tanggalPesan->format('d F Y');
        $formattedTime = $tanggalPesan->format('H:i');

        // Handle pickup/delivery address
        $address = '';
        if ($latestBooking->pengambilan && $latestBooking->alamat_pengambilan) {
            $address .= 'Jemput: ' . $latestBooking->alamat_pengambilan;
        }
        if ($latestBooking->pengiriman && $latestBooking->alamat_pengiriman) {
            if ($address) $address .= ' | ';
            $address .= 'Antar: ' . $latestBooking->alamat_pengiriman;
        }
        if (!$address) {
            $address = 'Datang langsung ke bengkel';
        }

        // Calculate total price from details
        $totalHarga = $latestBooking->details->sum('harga');

        // Format status for display
        $statusDisplay = $this->formatStatusForDisplay($latestBooking->status);

        return [
            'id' => $latestBooking->nomor_booking,
            'service_name' => count($services) > 1 ? $services[0] . ' +' . (count($services) - 1) . ' lainnya' : ($services[0] ?? 'Tidak ada layanan'),
            'service_date' => $formattedDate,
            'car_name' => $latestBooking->mobil->nama_mobil . ' (' . $latestBooking->mobil->plat_nomor . ')',
            'price' => $totalHarga > 0 ? 'Rp ' . number_format($totalHarga, 0, ',', '.') : 'Belum ada harga',
            'time_slot' => $formattedTime . ' - •••',
            'status' => $statusDisplay,
            'notes' => $latestBooking->catatan ?: 'Tidak ada catatan',
            'address' => $address,
            'services' => $services,
            'pickup_delivery' => [
                'pengambilan' => $latestBooking->pengambilan,
                'pengiriman' => $latestBooking->pengiriman,
                'alamat_pengambilan' => $latestBooking->alamat_pengambilan,
                'alamat_pengiriman' => $latestBooking->alamat_pengiriman,
            ],
            'pricing' => $totalHarga > 0 ? [
                'service_cost' => 'Rp ' . number_format($totalHarga, 0, ',', '.'),
                'sparepart_cost' => 'Rp 0',
                'delivery_cost' => 'Rp 0',
                'total_cost' => 'Rp ' . number_format($totalHarga, 0, ',', '.')
            ] : null
        ];
    }

    private function formatStatusForDisplay($status)
    {
        // Map to the new business terms
        $statusMap = [
            'pending' => 'Menunggu Konfirmasi Harga',
            'harga_dari_admin' => 'Harga dari Admin',
            'dalam_antrian' => 'Dalam Antrian',
            'dalam_servisan' => 'Dalam Servisan',
            'selesai' => 'Selesai',
            'cancelled' => 'Dibatalkan',
        ];

        return $statusMap[$status] ?? ucfirst($status);
    }
    
    private function getActivitySummary($user)
    {
        // Get real data from bookings with new statuses
        $totalServices = AntriStruk::where('id_pelanggan', $user->id_pelanggan)
            ->whereIn('status', [
                AntriStruk::STATUS_PENDING,
                AntriStruk::STATUS_HARGA_DARI_ADMIN,
                AntriStruk::STATUS_DALAM_ANTRIAN,
                AntriStruk::STATUS_DALAM_SERVISAN,
                AntriStruk::STATUS_SELESAI,
            ])
            ->count();
        
        $totalSpent = AntriStruk::where('id_pelanggan', $user->id_pelanggan)
            ->where('status', AntriStruk::STATUS_SELESAI)
            ->whereNotNull('harga_keseluruhan')
            ->sum('harga_keseluruhan');

        // Untuk akun baru atau tanpa data, biarkan 0 (jangan pakai fallback simulasi)
         
         return [
             'total_services' => $totalServices,
             'total_spent' => $totalSpent,
             'formatted_spent' => $this->formatCurrency($totalSpent)
         ];
    }
    
    private function calculateTotalServices($user)
    {
        // Simulated calculation based on user data
        $baseServices = 8;
        $userFactor = ($user->id_pelanggan % 5) + 1;
        return $baseServices + $userFactor;
    }
    
    private function calculateTotalSpent($user)
    {
        // Simulated calculation based on user data
        $baseAmount = 1500000;
        $userFactor = ($user->id_pelanggan % 10) + 1;
        return $baseAmount + ($userFactor * 100000);
    }
    
    private function formatCurrency($amount)
    {
        if ($amount >= 1000000) {
            return number_format($amount / 1000000, 1) . 'Jt';
        } elseif ($amount >= 1000) {
            return number_format($amount / 1000, 0) . 'K';
        }
        return number_format($amount, 0);
    }
    
    private function getUserCars($user)
    {
        // Get real user cars from database
        $userCars = Mobil::where('id_pelanggan', $user->id_pelanggan)
            ->get()
            ->map(function($mobil) {
                // Get last service date for this car
                $lastService = AntriStruk::where('id_mobil', $mobil->id_mobil)
                    ->where('status', 'completed')
                    ->orderBy('tanggal_selesai', 'desc')
                    ->first();

                $lastServiceText = 'Belum pernah service';
                if ($lastService && $lastService->tanggal_selesai) {
                    $lastServiceDate = Carbon::parse($lastService->tanggal_selesai);
                    $lastServiceText = $lastServiceDate->diffForHumans();
                }

                return [
                    'id' => $mobil->id_mobil,
                    'nama' => $mobil->nama_mobil,
                    'jenis_mobil' => $mobil->jenis_mobil,
                    'plat_nomor' => $mobil->plat_nomor
                ];
            })
            ->toArray();

        if (empty($userCars)) {
            return [];
        }

        return $userCars;
    }
}