<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use App\Models\AntriStruk;

class UserReceiptController extends Controller
{
    // List user's receipts
    public function index()
    {
        $user = Auth::user();
        $items = AntriStruk::with('details')
            ->where('id_pelanggan', $user->id_pelanggan)
            ->latest('created_at')
            ->paginate(10);
        return view('user.receipts.index', compact('items'));
    }

    // Create a new queue/receipt (without pricing yet)
    public function store(Request $request)
    {
        $user = Auth::user();
        $data = $request->validate([
            'catatan' => 'nullable|string|max:1000',
        ]);

        $nomor = 'BK-' . now()->format('YmdHis') . '-' . $user->id_pelanggan;

        $model = AntriStruk::create([
            'id_pelanggan' => $user->id_pelanggan,
            'nomor_booking' => $nomor,
            'catatan' => $data['catatan'] ?? null,
            'status' => 'pending',
            'status_harga' => 'pending',
        ]);

        return redirect()->back()->with('success', 'Permintaan antrian dibuat. Nomor: ' . $model->nomor_booking);
    }

    // Upload receipt image/file by user
    public function uploadReceipt(Request $request, $id)
    {
        $user = Auth::user();
        $request->validate([
            'bukti_struk' => 'required|file|mimes:jpg,jpeg,png,pdf|max:4096',
        ]);

        $model = AntriStruk::where('id_antri_struk', $id)
            ->where('id_pelanggan', $user->id_pelanggan)
            ->firstOrFail();

        $file = $request->file('bukti_struk');
        $filename = 'struk_' . $model->id_antri_struk . '_' . time() . '.' . $file->getClientOriginalExtension();
        $file->move(public_path('images/receipts'), $filename);
        $model->update(['bukti_struk' => 'images/receipts/' . $filename]);

        return back()->with('success', 'Bukti struk berhasil diunggah.');
    }

    // User confirms the price sent by admin
    public function confirmPrice(Request $request, $id)
    {
        $user = Auth::user();
        $data = $request->validate([
            'confirm' => 'required|in:confirm,reject',
        ]);

        $model = AntriStruk::where('id_antri_struk', $id)
            ->where('id_pelanggan', $user->id_pelanggan)
            ->firstOrFail();

        $model->status_harga = $data['confirm'] === 'confirm' ? 'confirmed' : 'rejected';
        $model->tanggal_konfirmasi_harga = now();
        $model->save();

        return back()->with('success', 'Status harga diperbarui: ' . $model->status_harga);
    }
}
