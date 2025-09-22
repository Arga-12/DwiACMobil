<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\AntriStruk;
use Illuminate\Support\Carbon;
use App\Models\LayananKategori;

class AntrianController extends Controller
{
    // List and filter customer queues for admin
    public function index(Request $request)
    {
        $status = $request->query('status');
        $q = $request->query('q');
        $date = $request->query('date');
        $category = $request->query('category');

        $query = AntriStruk::with(['pelanggan', 'mobil', 'montir', 'details'])
            ->orderByDesc('created_at');

        if (!empty($status)) {
            $query->where('status', $status);
        }
        if (!empty($q)) {
            $query->where(function($sub) use ($q) {
                $sub->where('nomor_booking', 'like', "%$q%")
                    ->orWhereHas('pelanggan', function($qq) use ($q){ $qq->where('nama', 'like', "%$q%"); })
                    ->orWhereHas('mobil', function($qq) use ($q){ $qq->where('plat_nomor', 'like', "%$q%"); });
            });
        }
        if (!empty($date)) {
            $query->whereDate('tanggal_pesan', $date);
        }
        if (!empty($category)) {
            // Filter berdasarkan kategori layanan melalui relasi details.layanan (id_kategori)
            $query->whereHas('details.layanan', function($qq) use ($category) {
                $qq->where('id_kategori', $category);
            });
        }

        // Get collection instead of paginated results to avoid property access issues
        $bookings = $query->get();

        // Ambil daftar kategori untuk filter dropdown
        $categories = LayananKategori::orderBy('nama')->get();

        return view('admin.antrian', compact('bookings', 'status', 'q', 'date', 'category', 'categories'));
    }

    // Admin sets final price; move status to harga_dari_admin
    public function setPrice(Request $request, $id)
    {
        $request->validate([
            'harga_keseluruhan' => 'required|numeric|min:0',
        ]);

        $booking = AntriStruk::where('nomor_booking', $id)
            ->orWhere('id_antri_struk', $id)
            ->firstOrFail();

        $booking->harga_keseluruhan = $request->harga_keseluruhan;
        $booking->status = AntriStruk::STATUS_HARGA_DARI_ADMIN; // user must confirm on client
        $booking->save();

        return redirect()->route('admin.antrian')->with('success', 'Harga berhasil ditetapkan dan menunggu konfirmasi pelanggan.');
    }

    // Admin marks service as started
    public function startService(Request $request, $id)
    {
        $booking = AntriStruk::where('nomor_booking', $id)
            ->orWhere('id_antri_struk', $id)
            ->firstOrFail();

        // Hanya boleh mulai jika sudah dikonfirmasi pelanggan (dalam_antrian)
        if (strtolower((string)$booking->status) !== AntriStruk::STATUS_DALAM_ANTRIAN) {
            return $this->errorBack($request, 'Status belum siap untuk dimulai.');
        }

        $booking->status = AntriStruk::STATUS_DALAM_SERVISAN;
        $booking->save();

        return $this->okBack($request, 'Servis dimulai.');
    }

    // Admin marks service as finished
    public function finish(Request $request, $id)
    {
        $booking = AntriStruk::where('nomor_booking', $id)
            ->orWhere('id_antri_struk', $id)
            ->firstOrFail();

        if (strtolower((string)$booking->status) !== AntriStruk::STATUS_DALAM_SERVISAN) {
            return $this->errorBack($request, 'Status belum dalam pengerjaan.');
        }

        $booking->status = AntriStruk::STATUS_SELESAI;
        $booking->tanggal_selesai = now();
        $booking->save();

        return $this->okBack($request, 'Servis selesai.');
    }

    // Admin cancels a booking
    public function cancel(Request $request, $id)
    {
        $booking = AntriStruk::where('nomor_booking', $id)
            ->orWhere('id_antri_struk', $id)
            ->firstOrFail();

        if (strtolower((string)$booking->status) === AntriStruk::STATUS_SELESAI) {
            return $this->errorBack($request, 'Tidak dapat membatalkan booking yang sudah selesai.');
        }

        $booking->status = 'cancelled';
        $booking->save();

        return $this->okBack($request, 'Booking dibatalkan.');
    }

    private function okBack(Request $request, string $msg)
    {
        if ($request->wantsJson()) return response()->json(['ok' => true]);
        return back()->with('success', $msg);
    }

    private function errorBack(Request $request, string $msg, int $code = 422)
    {
        if ($request->wantsJson()) return response()->json(['error' => $msg], $code);
        return back()->withErrors($msg);
    }
}