<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pelanggan;
use App\Models\Montir;
use App\Models\ArtikelLayanan;
use App\Models\AntriStruk;
use App\Models\KalenderLibur;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Carbon;

class AdminController extends Controller
{
    public function dashboard()
    {
        // Get admin dashboard statistics
        $stats = $this->getDashboardStats();
        $calendarContext = $this->buildCalendarContext();
        
        return view('admin.dashboard-admin', compact('stats', 'calendarContext'));
    }
    
    public function galeri()
    {
        // TODO: Implement real gallery data from database
        return view('admin.galeri.index');
    }
    
    public function montir()
    {
        // Get real mechanic data from database
        $mechanics = Montir::orderBy('nama')->get();
        
        return view('admin.montir.index', compact('mechanics'));
    }
    
    /**
     * Artikel Layanan index page (list)
     */
    public function artikelIndex()
    {
        $items = ArtikelLayanan::orderByDesc('updated_at')->paginate(10);
        return view('admin.artikel.index', compact('items'));
    }

    public function artikelCreate()
    {
        return view('admin.artikel.create');
    }

    public function artikelEdit($id)
    {
        $item = ArtikelLayanan::findOrFail($id);
        return view('admin.artikel.edit', compact('item'));
    }
    
    /**
     * Show admin/montir profile page
     */
    public function profile()
    {
        $admin = Auth::guard('montir')->user();
        $montirs = Montir::orderBy('nama')->get();

        return view('admin.profil-admin', compact('admin', 'montirs'));
    }

    /**
     * Update current admin/montir profile
     */
    public function updateProfile(Request $request)
    {
        $admin = Auth::guard('montir')->user();

        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'email' => 'required|email|unique:montir,email,' . $admin->id_montir . ',id_montir',
            'peran' => 'required|in:admin,montir',
            'password' => 'nullable|string|min:6',
            'foto' => 'nullable|image|max:2048',
        ]);

        // Handle photo upload
        if ($request->hasFile('foto')) {
            $file = $request->file('foto');
            $filename = time() . '_' . preg_replace('/\s+/', '_', $file->getClientOriginalName());
            $destination = public_path('images/montir');
            if (!is_dir($destination)) {
                @mkdir($destination, 0755, true);
            }
            $file->move($destination, $filename);
            $admin->foto = 'images/montir/' . $filename;
        }

        $admin->nama = $validated['nama'];
        $admin->email = $validated['email'];
        $admin->peran = $validated['peran'];
        if (!empty($validated['password'])) {
            // Will be hashed automatically by model casts
            $admin->password = $validated['password'];
        }
        $admin->save();

        return back()->with('success', 'Profil berhasil diperbarui.');
    }

    /**
     * Create a new montir (from modal on profile page)
     */
    public function storeMontir(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'email' => 'required|email|unique:montir,email',
            'password' => 'required|string|min:6',
            'peran' => 'required|in:admin,montir',
            'foto' => 'nullable|image|max:2048',
        ]);

        $data = [
            'nama' => $validated['nama'],
            'email' => $validated['email'],
            'password' => $validated['password'], // hashed by model casts
            'peran' => $validated['peran'],
            'tgl_dibuat' => now(),
            'is_active' => true,
        ];

        if ($request->hasFile('foto')) {
            $file = $request->file('foto');
            $filename = time() . '_' . preg_replace('/\s+/', '_', $file->getClientOriginalName());
            $destination = public_path('images/montir');
            if (!is_dir($destination)) {
                @mkdir($destination, 0755, true);
            }
            $file->move($destination, $filename);
            $data['foto'] = 'images/montir/' . $filename;
        }

        Montir::create($data);

        return back()->with('success', 'Montir baru berhasil ditambahkan.');
    }

    private function getDashboardStats()
    {
        // Admin dashboard statistics with real data
        return [
            'total_customers' => Pelanggan::count(),
            'active_bookings' => 15, // TODO: Get from AntriStruk::active()->count()
            'completed_today' => 8, // TODO: Get from AntriStruk::whereDate('tanggal_selesai', today())->count()
            'revenue_today' => 2500000, // TODO: Calculate from completed bookings today
            'pending_queue' => 5, // TODO: Get from AntriStruk::where('status', 'pending')->count()
            'total_services' => 42, // TODO: Get from ArtikelLayanan::count()
            'monthly_revenue' => 75000000 // TODO: Calculate from completed bookings this month
        ];
    }

    private function buildCalendarContext(): array
    {
        $currentMonth = Carbon::now()->startOfMonth();
        $start = $currentMonth->copy();
        $end = $currentMonth->copy()->endOfMonth();

        $bookings = AntriStruk::with([
                'pelanggan:id_pelanggan,nama',
                'mobil:id_mobil,nama_mobil,plat_nomor',
            ])
            ->whereBetween('tanggal_pesan', [$start->copy()->startOfDay(), $end->copy()->endOfDay()])
            ->orderBy('tanggal_pesan')
            ->get();

        $holidays = KalenderLibur::betweenDates($start, $end)
            ->orderBy('tanggal')
            ->get();

        $days = [];

        foreach ($bookings as $booking) {
            $dateKey = optional($booking->tanggal_pesan)?->toDateString();
            if (!$dateKey) {
                continue;
            }

            if (!isset($days[$dateKey])) {
                $days[$dateKey] = [
                    'bookings' => [],
                    'booking_count' => 0,
                    'statuses' => [],
                ];
            }

            $days[$dateKey]['bookings'][] = [
                'id' => $booking->id_antri_struk,
                'nomor_booking' => $booking->nomor_booking,
                'status' => $booking->status,
                'pelanggan' => optional($booking->pelanggan)->nama,
                'mobil' => optional($booking->mobil)->nama_mobil,
                'plat_nomor' => optional($booking->mobil)->plat_nomor,
                'waktu' => optional($booking->tanggal_pesan)?->format('H:i'),
            ];
        }

        foreach ($days as $dateKey => &$info) {
            $info['booking_count'] = count($info['bookings']);
            $info['statuses'] = collect($info['bookings'])
                ->groupBy('status')
                ->map->count()
                ->toArray();
        }
        unset($info);

        foreach ($holidays as $holiday) {
            $dateKey = $holiday->tanggal->toDateString();

            if (!isset($days[$dateKey])) {
                $days[$dateKey] = [
                    'bookings' => [],
                    'booking_count' => 0,
                    'statuses' => [],
                ];
            }

            $days[$dateKey]['holiday'] = [
                'title' => $holiday->judul,
                'note' => $holiday->keterangan,
            ];
        }

        ksort($days);

        return [
            'month_start' => $start,
            'month_name' => $currentMonth->locale('id')->translatedFormat('F Y'),
            'days_in_month' => $currentMonth->daysInMonth,
            'start_day_of_week' => (int) $currentMonth->copy()->day(1)->dayOfWeekIso,
            'days' => $days,
        ];
    }
}
