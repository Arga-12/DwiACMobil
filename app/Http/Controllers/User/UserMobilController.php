<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Mobil;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Illuminate\Database\QueryException;

class UserMobilController extends Controller
{
    /**
     * Display a listing of the user's mobil.
     */
    public function index()
    {
        // We no longer use a separate index page for mobil.
        // Redirect users to the dashboard where cars are listed.
        return redirect()->route('dashboard');
    }

    /**
     * Show the form for creating a new car.
     */
    public function create()
    {
        return view('user.mobil.form');
    }

    /**
     * Store a newly created car in storage.
     */
    public function store(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'nama_mobil' => 'required|string|max:255',
            'jenis_mobil' => 'required|string|max:255',
            'plat_nomor' => [
                'required',
                'string',
                'max:20',
                Rule::unique('mobil', 'plat_nomor')
            ]
        ], [
            'nama_mobil.required' => 'Nama mobil harus diisi.',
            'jenis_mobil.required' => 'Jenis mobil harus diisi.',
            'plat_nomor.required' => 'Plat nomor harus diisi.',
            'plat_nomor.unique' => 'Anda sudah memiliki mobil dengan plat nomor ini.'
        ]);

        try {
            Mobil::create([
                'nama_mobil' => $request->nama_mobil,
                'jenis_mobil' => $request->jenis_mobil,
                'plat_nomor' => strtoupper($request->plat_nomor),
                'id_pelanggan' => $user->id_pelanggan
            ]);
        } catch (QueryException $e) {
            if ((string)$e->getCode() === '23000') {
                return back()->withErrors(['plat_nomor' => 'Plat nomor sudah terdaftar.'])->withInput();
            }
            throw $e;
        }

        return redirect()->route('dashboard')
                        ->with('success', 'Mobil berhasil ditambahkan!');
    }

    /**
     * Show the form for editing the specified car.
     */
    public function edit(Mobil $mobil)
    {
        $user = Auth::user();
        
        // Ensure user can only edit their own mobil
        if ($mobil->id_pelanggan !== $user->id_pelanggan) {
            abort(403, 'Unauthorized action.');
        }

        // Keep using $car variable in the view for compatibility
        $car = $mobil;
        return view('user.mobil.form', compact('car'));
    }

    /**
     * Update the specified car in storage.
     */
    public function update(Request $request, Mobil $mobil)
    {
        $user = Auth::user();
        
        // Ensure user can only update their own mobil
        if ($mobil->id_pelanggan !== $user->id_pelanggan) {
            abort(403, 'Unauthorized action.');
        }

        $request->validate([
            'nama_mobil' => 'required|string|max:255',
            'jenis_mobil' => 'required|string|max:255',
            'plat_nomor' => [
                'required',
                'string',
                'max:20',
                Rule::unique('mobil', 'plat_nomor')
                    ->ignore($mobil->id_mobil, 'id_mobil')
            ]
        ], [
            'nama_mobil.required' => 'Nama mobil harus diisi.',
            'jenis_mobil.required' => 'Jenis mobil harus diisi.',
            'plat_nomor.required' => 'Plat nomor harus diisi.',
            'plat_nomor.unique' => 'Anda sudah memiliki mobil dengan plat nomor ini.'
        ]);

        try {
            $mobil->update([
                'nama_mobil' => $request->nama_mobil,
                'jenis_mobil' => $request->jenis_mobil,
                'plat_nomor' => strtoupper($request->plat_nomor)
            ]);
        } catch (QueryException $e) {
            if ((string)$e->getCode() === '23000') {
                return back()->withErrors(['plat_nomor' => 'Plat nomor sudah terdaftar.'])->withInput();
            }
            throw $e;
        }

        return redirect()->route('dashboard')
                        ->with('success', 'Mobil berhasil diperbarui!');
    }

    /**
     * Remove the specified car from storage.
     */
    public function destroy(Mobil $mobil)
    {
        $user = Auth::user();
        
        // Ensure user can only delete their own mobil
        if ($mobil->id_pelanggan !== $user->id_pelanggan) {
            abort(403, 'Unauthorized action.');
        }

        // Check if car is being used in any active bookings
        $activeBookings = $mobil->antriStruk()->whereIn('status', ['pending', 'confirmed', 'in_progress'])->count();
        
        if ($activeBookings > 0) {
            return redirect()->route('dashboard')
                            ->with('error', 'Mobil tidak dapat dihapus karena masih ada booking aktif.');
        }

        $mobil->delete();

        return redirect()->route('dashboard')
                        ->with('success', 'Mobil berhasil dihapus!');
    }
}
