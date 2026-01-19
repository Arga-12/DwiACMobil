<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\AntriStruk;
use Illuminate\Support\Carbon;
use App\Models\LayananKategori;
use App\Notifications\BookingStatusChanged;
use App\Models\DetailStruk;
use App\Models\Layanan;
use Illuminate\Support\Facades\DB;

class AntrianController extends Controller
{
    // List and filter customer queues for admin
    public function index(Request $request)
    {
        $status = $request->query("status");
        $q = $request->query("q");
        $date = $request->query("date");
        $category = $request->query("category");

        $query = AntriStruk::with([
            "pelanggan",
            "mobil",
            "montir",
            "details.layanan",
        ])->orderByDesc("created_at");

        if (!empty($status)) {
            $query->where("status", $status);
        }
        if (!empty($q)) {
            $query->where(function ($sub) use ($q) {
                $sub->where("nomor_booking", "like", "%$q%")
                    ->orWhereHas("pelanggan", function ($qq) use ($q) {
                        $qq->where("nama", "like", "%$q%");
                    })
                    ->orWhereHas("mobil", function ($qq) use ($q) {
                        $qq->where("plat_nomor", "like", "%$q%");
                    });
            });
        }
        if (!empty($date)) {
            $query->whereDate("tanggal_pesan", $date);
        }
        if (!empty($category)) {
            // Filter berdasarkan kategori layanan melalui relasi details.layanan (id_kategori)
            $query->whereHas("details.layanan", function ($qq) use ($category) {
                $qq->where("id_kategori", $category);
            });
        }

        // Get collection instead of paginated results to avoid property access issues
        $bookings = $query->get();

        // Ambil daftar kategori untuk filter dropdown
        $categories = LayananKategori::orderBy("nama")->get();

        return view(
            "admin.antrian",
            compact(
                "bookings",
                "status",
                "q",
                "date",
                "category",
                "categories",
            ),
        );
    }

    // Admin sets final price; move status to harga_dari_admin
    public function setPrice(Request $request, $id)
    {
        $request->validate([
            "harga_keseluruhan" => "required|numeric|min:0",
            "details" => "nullable",
            "estimasi_tanggal" => "required|date",
            "estimasi_jam" => "required",
        ]);

        $booking = AntriStruk::where("nomor_booking", $id)
            ->orWhere("id_antri_struk", $id)
            ->firstOrFail();

        DB::transaction(function () use ($request, $booking) {
            $total = (int) $request->harga_keseluruhan;
            $detailsJson = $request->input("details");
            if (!empty($detailsJson)) {
                $decoded = json_decode($detailsJson, true);
                if (is_array($decoded)) {
                    $booking->details()->delete();
                    $sum = 0;
                    foreach ($decoded as $row) {
                        $name =
                            (string) ($row["nama"] ??
                                ($row["name"] ??
                                    ($row["deskripsi"] ?? "-")));
                        $jumlah = (int) ($row["jumlah"] ?? 1);
                        if ($jumlah < 1) {
                            $jumlah = 1;
                        }
                        $price = (int) ($row["harga_satuan"] ?? 0);
                        $subtotal = $jumlah * max(0, $price);
                        $sum += $subtotal;
                        $layananId = null;
                        $layanan = Layanan::where("nama", $name)->first();
                        if ($layanan) {
                            $layananId = $layanan->id_layanan;
                        }
                        DetailStruk::create([
                            "id_antri_struk" => $booking->id_antri_struk,
                            "id_layanan" => $layananId,
                            "tipe" => "layanan",
                            "deskripsi" => $name,
                            "jumlah" => $jumlah,
                            "harga_satuan" => $price,
                            "subtotal" => $subtotal,
                        ]);
                    }
                    $total = $sum;
                }
            }

            // Combine date and time for estimated completion
            if (
                $request->filled("estimasi_tanggal") &&
                $request->filled("estimasi_jam")
            ) {
                $estimasiDateTime =
                    $request->input("estimasi_tanggal") .
                    " " .
                    $request->input("estimasi_jam");
                $booking->estimasi_selesai = Carbon::createFromFormat(
                    "Y-m-d H:i",
                    $estimasiDateTime,
                    "Asia/Jakarta",
                );
            }

            $booking->harga_keseluruhan = $total;
            $from = strtolower((string) $booking->status);
            $booking->status = AntriStruk::STATUS_HARGA_DARI_ADMIN;
            $booking->save();

            $pelanggan =
                $booking->pelanggan ?:
                \App\Models\Pelanggan::find($booking->id_pelanggan);
            if ($pelanggan) {
                $pelanggan->notify(
                    new BookingStatusChanged($booking, $from, $booking->status),
                );
            }
        });

        return redirect()
            ->route("admin.antrian")
            ->with(
                "success",
                "Harga berhasil ditetapkan dan menunggu konfirmasi pelanggan.",
            );
    }

    // Admin marks service as started
    public function startService(Request $request, $id)
    {
        $booking = AntriStruk::where("nomor_booking", $id)
            ->orWhere("id_antri_struk", $id)
            ->firstOrFail();

        // Hanya boleh mulai jika sudah dikonfirmasi pelanggan (dalam_antrian)
        if (
            strtolower((string) $booking->status) !==
            AntriStruk::STATUS_DALAM_ANTRIAN
        ) {
            return $this->errorBack(
                $request,
                "Status belum siap untuk dimulai.",
            );
        }

        $from = strtolower((string) $booking->status);
        $booking->status = AntriStruk::STATUS_DALAM_SERVISAN;
        $booking->mulai_servis = Carbon::now("Asia/Jakarta");
        $booking->save();
        $pelanggan =
            $booking->pelanggan ?:
            \App\Models\Pelanggan::find($booking->id_pelanggan);
        if ($pelanggan) {
            $pelanggan->notify(
                new BookingStatusChanged($booking, $from, $booking->status),
            );
        }

        return $this->okBack($request, "Servis dimulai.");
    }

    // Admin marks service as finished
    public function finish(Request $request, $id)
    {
        $booking = AntriStruk::where("nomor_booking", $id)
            ->orWhere("id_antri_struk", $id)
            ->firstOrFail();

        if (
            strtolower((string) $booking->status) !==
            AntriStruk::STATUS_DALAM_SERVISAN
        ) {
            return $this->errorBack($request, "Status belum dalam pengerjaan.");
        }

        $from = strtolower((string) $booking->status);
        $booking->status = AntriStruk::STATUS_SELESAI;
        $booking->tanggal_selesai = Carbon::now("Asia/Jakarta");
        $booking->save();
        $pelanggan =
            $booking->pelanggan ?:
            \App\Models\Pelanggan::find($booking->id_pelanggan);
        if ($pelanggan) {
            $pelanggan->notify(
                new BookingStatusChanged($booking, $from, $booking->status),
            );
        }

        return $this->okBack($request, "Servis selesai.");
    }

    // Admin cancels a booking
    public function cancel(Request $request, $id)
    {
        $booking = AntriStruk::where("nomor_booking", $id)
            ->orWhere("id_antri_struk", $id)
            ->firstOrFail();

        if (
            strtolower((string) $booking->status) === AntriStruk::STATUS_SELESAI
        ) {
            return $this->errorBack(
                $request,
                "Tidak dapat membatalkan booking yang sudah selesai.",
            );
        }

        $from = strtolower((string) $booking->status);
        $booking->status = "cancelled";
        $booking->save();
        $pelanggan =
            $booking->pelanggan ?:
            \App\Models\Pelanggan::find($booking->id_pelanggan);
        if ($pelanggan) {
            $pelanggan->notify(
                new BookingStatusChanged($booking, $from, $booking->status),
            );
        }

        return $this->okBack($request, "Booking dibatalkan.");
    }

    // Permanently delete a booking and its details (allowed for any status)
    public function destroy(Request $request, $id)
    {
        $booking = AntriStruk::where("nomor_booking", $id)
            ->orWhere("id_antri_struk", $id)
            ->firstOrFail();

        DB::transaction(function () use ($booking) {
            // delete details first then parent
            $booking->details()->delete();
            $booking->delete();
        });

        return $this->okBack($request, "Booking dihapus permanen.");
    }

    private function okBack(Request $request, string $msg)
    {
        if ($request->wantsJson()) {
            return response()->json(["ok" => true]);
        }
        return back()->with("success", $msg);
    }

    private function errorBack(Request $request, string $msg, int $code = 422)
    {
        if ($request->wantsJson()) {
            return response()->json(["error" => $msg], $code);
        }
        return back()->withErrors($msg);
    }
}
