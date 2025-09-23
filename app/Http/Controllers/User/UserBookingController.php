<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\AntriStruk;
use App\Models\DetailStruk;
use App\Models\Mobil;
use App\Models\Layanan;
use App\Models\LayananKategori;
use App\Models\Pelanggan;

class UserBookingController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $mobils = Mobil::where('id_pelanggan', $user->id_pelanggan)->get();
        $kategoris = LayananKategori::with('layanan')->orderBy('nama')->get();
        $layanans = Layanan::where('is_active', true)->orderBy('nama')->get();
        
        return view('user.booking', compact('mobils', 'kategoris', 'layanans'));
    }

    public function store(Request $request)
    {
        $user = Auth::user();
        
        $validated = $request->validate([
            'tanggal_booking' => 'required|date|after_or_equal:today',
            'jam_booking' => 'required|string',
            'id_mobil' => 'required|exists:mobil,id_mobil',
            'layanan_ids' => 'required|array|min:1',
            'layanan_ids.*' => 'exists:layanan,id_layanan',
            'catatan' => 'nullable|string|max:500',
            'pengambilan' => 'nullable|boolean',
            'pengiriman' => 'nullable|boolean',
            'alamat_pengambilan' => 'required_if:pengambilan,1|nullable|string|max:1000',
            'alamat_pengiriman' => 'required_if:pengiriman,1|nullable|string|max:1000',
        ]);

        // Verify mobil belongs to user
        $mobil = Mobil::where('id_mobil', $validated['id_mobil'])
                     ->where('id_pelanggan', $user->id_pelanggan)
                     ->first();
        
        if (!$mobil) {
            return back()->withErrors(['id_mobil' => 'Mobil tidak ditemukan atau bukan milik Anda.']);
        }

        // Capacity rule (simple): max 2 active bookings per day (pending, harga_dari_admin, dalam_antrian, dalam_servisan)
        $existingCount = AntriStruk::active()
            ->whereDate('tanggal_pesan', $validated['tanggal_booking'])
            ->count();

        if ($existingCount >= 2) {
            return back()
                ->withErrors(['tanggal_booking' => 'Kuota servis untuk tanggal tersebut sudah penuh. Silakan pilih tanggal lain.'])
                ->withInput();
        }

        // Generate booking number
        $lastBooking = AntriStruk::whereYear('created_at', date('Y'))
                                ->whereMonth('created_at', date('m'))
                                ->orderBy('id_antri_struk', 'desc')
                                ->first();
        
        $bookingNumber = 'BWK-' . date('Ym') . '-' . str_pad(($lastBooking ? $lastBooking->id_antri_struk + 1 : 1), 3, '0', STR_PAD_LEFT);

        // Create booking
        $booking = AntriStruk::create([
            'id_pelanggan' => $user->id_pelanggan,
            'id_mobil' => $validated['id_mobil'],
            'nomor_booking' => $bookingNumber,
            'catatan' => $validated['catatan'],
            'pengambilan' => $validated['pengambilan'] ?? false,
            'pengiriman' => $validated['pengiriman'] ?? false,
            'alamat_pengambilan' => $validated['alamat_pengambilan'] ?? null,
            'alamat_pengiriman' => $validated['alamat_pengiriman'] ?? null,
            'status' => 'pending',
            'tanggal_pesan' => $validated['tanggal_booking'] . ' ' . $validated['jam_booking'],
            // New meta fields per agreed design
            'durasi_hari' => 1,
            'menginap' => false,
            'jam_booking' => $validated['tanggal_booking'], // start date (not time)
            'jam_selesai' => null, // end date if overnight approved later
        ]);

        // Create detail records for each selected service
        foreach ($validated['layanan_ids'] as $layananId) {
            $layanan = Layanan::find($layananId);
            $price = $layanan->harga_default ?? 0;

            DetailStruk::create([
                'id_antri_struk' => $booking->id_antri_struk,
                'id_layanan' => $layananId,
                'tipe' => 'layanan',
                'deskripsi' => $layanan->nama ?? 'Layanan',
                'qty' => 1,
                'harga_satuan' => $price,
                'subtotal' => $price,
            ]);
        }

        return redirect()->route('booking')->with('success', 
            'Booking berhasil dibuat dengan nomor: ' . $bookingNumber . 
            '. Kami akan segera menghubungi Anda untuk konfirmasi.'
        );
    }

    public function addCar(Request $request)
    {
        $user = Auth::user();
        
        $validated = $request->validate([
            'nama_mobil' => 'required|string|max:100',
            'jenis_mobil' => 'required|string|max:50',
            'plat_nomor' => 'required|string|max:20|unique:mobil,plat_nomor',
        ]);

        Mobil::create([
            'nama_mobil' => $validated['nama_mobil'],
            'jenis_mobil' => $validated['jenis_mobil'],
            'plat_nomor' => strtoupper($validated['plat_nomor']),
            'id_pelanggan' => $user->id_pelanggan,
        ]);

        return redirect()->route('booking')->with('success', 'Mobil berhasil ditambahkan!');
    }

    // Tampilkan halaman Antrian Saya sesuai logika status
    public function antrian(Request $request)
    {
        $user = Auth::user();

        // Aktif: pending, harga_dari_admin, dalam_antrian, dalam_servisan
        $currentBookings = AntriStruk::with(['mobil', 'details'])
            ->where('id_pelanggan', $user->id_pelanggan)
            ->active()
            ->orderBy('tanggal_pesan')
            ->get();

        // Riwayat: selesai
        $riwayat = AntriStruk::with(['mobil', 'details'])
            ->where('id_pelanggan', $user->id_pelanggan)
            ->history()
            ->orderByDesc('tanggal_selesai')
            ->limit(20)
            ->get();

        // Handle show_receipt parameter for modal display
        $selectedBooking = null;
        if ($request->has('show_receipt')) {
            $bookingId = $request->get('show_receipt');
            
            // Find booking in current bookings or history
            $selectedBooking = AntriStruk::with(['mobil', 'details', 'montir'])
                ->where('id_pelanggan', $user->id_pelanggan)
                ->where(function($q) use ($bookingId) {
                    $q->where('nomor_booking', $bookingId)
                      ->orWhere('id_antri_struk', $bookingId);
                })
                ->first();
        }

        return view('user.antrian', [
            'currentBooking' => $currentBookings,
            'riwayat' => $riwayat,
            'selectedBooking' => $selectedBooking, // Pass selected booking for modal
        ]);
    }

    public function cancel(Request $request, $id)
    {
        $user = Auth::user();

        $booking = AntriStruk::where('id_pelanggan', $user->id_pelanggan)
            ->where(function($q) use ($id) {
                $q->where('nomor_booking', $id)
                  ->orWhere('id_antri_struk', $id);
            })
            ->firstOrFail();

        // Optional: block cancellation after service started or finished
        if (in_array(strtolower((string)$booking->status), [AntriStruk::STATUS_DALAM_SERVISAN, AntriStruk::STATUS_SELESAI])) {
            return redirect()->route('antrian')->withErrors('Tidak dapat membatalkan setelah servis dimulai/selesai.');
        }

        $booking->status = 'cancelled';
        $booking->save();

        return redirect()->route('antrian')->with('success', 'Booking berhasil dibatalkan.');
    }

    public function confirmPrice(Request $request, $id)
    {
        $user = Auth::user();

        $booking = AntriStruk::where('id_pelanggan', $user->id_pelanggan)
            ->where(function($q) use ($id) {
                $q->where('nomor_booking', $id)
                  ->orWhere('id_antri_struk', $id);
            })
            ->firstOrFail();

        if (strtolower((string)$booking->status) !== AntriStruk::STATUS_HARGA_DARI_ADMIN) {
            return redirect()->route('antrian')->withErrors('Status tidak valid untuk konfirmasi harga.');
        }

        // Move booking to queue after user confirms price
        $booking->status = AntriStruk::STATUS_DALAM_ANTRIAN;
        $booking->save();

        return redirect()->route('antrian')->with('success', 'Harga berhasil dikonfirmasi. Booking Anda telah masuk antrian.');
    }
}
