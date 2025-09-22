<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\AntriStruk;
use App\Models\DetailStruk;

class AdminReceiptController extends Controller
{
    public function index()
    {
        $items = AntriStruk::with(['pelanggan','montir'])
            ->latest('created_at')
            ->paginate(15);
        return view('admin.receipts.index', compact('items'));
    }

    public function show($id)
    {
        $item = AntriStruk::with(['pelanggan','montir','details'])->findOrFail($id);
        return view('admin.receipts.show', compact('item'));
    }

    // Admin updates pricing summary and details (bulk)
    public function updatePricing(Request $request, $id)
    {
        $data = $request->validate([
            'admin_harga_total' => 'required|integer|min:0',
            'admin_harga_rincian' => 'nullable|array',
            'details' => 'nullable|array',
            'details.*.id_detail_struk' => 'nullable|integer|exists:detail_struk,id_detail_struk',
            'details.*.tipe' => 'required|string|in:layanan,sparepart,delivery,lainnya',
            'details.*.deskripsi' => 'required|string|max:255',
            'details.*.qty' => 'required|integer|min:1',
            'details.*.harga_satuan' => 'required|integer|min:0',
        ]);

        $model = AntriStruk::findOrFail($id);

        DB::transaction(function () use ($model, $data) {
            // Upsert details
            if (!empty($data['details'])) {
                $idsToKeep = [];
                foreach ($data['details'] as $d) {
                    $subtotal = $d['qty'] * $d['harga_satuan'];
                    if (!empty($d['id_detail_struk'])) {
                        $detail = DetailStruk::where('id_detail_struk', $d['id_detail_struk'])
                            ->where('id_antri_struk', $model->id_antri_struk)
                            ->firstOrFail();
                        $detail->update([
                            'tipe' => $d['tipe'],
                            'deskripsi' => $d['deskripsi'],
                            'qty' => $d['qty'],
                            'harga_satuan' => $d['harga_satuan'],
                            'subtotal' => $subtotal,
                        ]);
                        $idsToKeep[] = $detail->id_detail_struk;
                    } else {
                        $detail = DetailStruk::create([
                            'id_antri_struk' => $model->id_antri_struk,
                            'tipe' => $d['tipe'],
                            'deskripsi' => $d['deskripsi'],
                            'qty' => $d['qty'],
                            'harga_satuan' => $d['harga_satuan'],
                            'subtotal' => $subtotal,
                        ]);
                        $idsToKeep[] = $detail->id_detail_struk;
                    }
                }
                // Optionally delete missing ones (uncomment if desired)
                // DetailStruk::where('id_antri_struk', $model->id_antri_struk)
                //     ->whereNotIn('id_detail_struk', $idsToKeep)
                //     ->delete();
            }

            $model->admin_harga_total = $data['admin_harga_total'];
            $model->admin_harga_rincian = $data['admin_harga_rincian'] ?? null;
            $model->status = 'waiting_confirm';
            $model->save();
        });

        return back()->with('success', 'Harga dan rincian berhasil diperbarui, menunggu konfirmasi pelanggan.');
    }

    public function assignMontir(Request $request, $id)
    {
        $data = $request->validate([
            'id_montir' => 'nullable|integer|exists:montir,id_montir',
            'status' => 'nullable|string|in:pending,waiting_confirm,confirmed,in_progress,completed,canceled',
        ]);

        $model = AntriStruk::findOrFail($id);
        $model->id_montir = $data['id_montir'] ?? null;
        if (!empty($data['status'])) {
            $model->status = $data['status'];
        }
        $model->save();

        return back()->with('success', 'Montir/Status berhasil diperbarui.');
    }
}
