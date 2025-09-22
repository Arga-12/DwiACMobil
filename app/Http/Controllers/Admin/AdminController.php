<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pelanggan;
use App\Models\Montir;
use App\Models\ArtikelLayanan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class AdminController extends Controller
{
    public function dashboard()
    {
        // Get admin dashboard statistics
        $stats = $this->getDashboardStats();
        
        return view('admin.dashboard-admin', compact('stats'));
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
}
