<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\KalenderLibur;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class KalenderLiburController extends Controller
{
    /**
     * Display a listing of holiday dates.
     */
    public function index(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'start_date' => ['nullable', 'date'],
            'end_date' => ['nullable', 'date'],
        ]);

        $query = KalenderLibur::query()->orderBy('tanggal');

        if (!empty($validated['start_date']) || !empty($validated['end_date'])) {
            $start = Carbon::parse($validated['start_date'] ?? 'first day of this month')->startOfDay();
            $end = Carbon::parse($validated['end_date'] ?? 'last day of this month')->endOfDay();

            if ($end->lessThan($start)) {
                [$start, $end] = [$end, $start];
            }

            $query->whereBetween('tanggal', [$start->toDateString(), $end->toDateString()]);
        }

        return response()->json([
            'data' => $query->get(),
        ]);
    }

    /**
     * Store a newly created holiday date.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'tanggal' => ['required', 'date'],
            'judul' => ['required', 'string', 'max:255'],
            'keterangan' => ['nullable', 'string'],
        ]);

        $holiday = KalenderLibur::create($data);

        if ($request->wantsJson()) {
            return response()->json([
                'message' => 'Tanggal libur berhasil dibuat.',
                'data' => $holiday,
            ], 201);
        }

        return redirect()
            ->route('admin.dashboard')
            ->with('success', 'Tanggal libur berhasil dibuat.');
    }

    /**
     * Update the specified holiday.
     */
    public function update(Request $request, KalenderLibur $kalenderLibur)
    {
        $data = $request->validate([
            'tanggal' => ['sometimes', 'date'],
            'judul' => ['sometimes', 'string', 'max:255'],
            'keterangan' => ['nullable', 'string'],
        ]);

        $kalenderLibur->update($data);

        if ($request->wantsJson()) {
            return response()->json([
                'message' => 'Tanggal libur berhasil diperbarui.',
                'data' => $kalenderLibur->fresh(),
            ]);
        }

        return redirect()
            ->route('admin.dashboard')
            ->with('success', 'Tanggal libur berhasil diperbarui.');
    }

    /**
     * Remove the specified holiday.
     */
    public function destroy(Request $request, KalenderLibur $kalenderLibur)
    {
        $kalenderLibur->delete();

        if ($request->wantsJson()) {
            return response()->json([
                'message' => 'Tanggal libur berhasil dihapus.',
            ]);
        }

        return redirect()
            ->route('admin.dashboard')
            ->with('success', 'Tanggal libur berhasil dihapus.');
    }
}
