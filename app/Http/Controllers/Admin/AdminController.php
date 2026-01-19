<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pelanggan;
use App\Models\Montir;
use App\Models\ArtikelLayanan;
use App\Models\AntriStruk;
use App\Models\KalenderLibur;
use App\Models\Galeri;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Carbon;
use App\Http\Controllers\Admin\RatingController;
use App\Models\BioMontir;

class AdminController extends Controller
{
    public function dashboard(Request $request)
    {
        // Get admin dashboard statistics
        $stats = $this->getDashboardStats();

        // Get month and year from request, default to current month
        $month = $request->get("month", now()->month);
        $year = $request->get("year", now()->year);
        $calendarContext = $this->buildCalendarContext($month, $year);

        // Get today's queue for display
        $todayQueue = AntriStruk::with([
            "pelanggan",
            "mobil",
            "details.layanan",
        ])
            ->whereDate("tanggal_pesan", today())
            ->whereNotIn("status", ["cancelled"])
            ->orderBy("tanggal_pesan")
            ->take(5)
            ->get();

        // Get recent customers for table
        $recentCustomers = AntriStruk::with(["pelanggan", "mobil"])
            ->whereNotIn("status", ["cancelled"])
            ->orderByDesc("created_at")
            ->take(10)
            ->get();

        // Get website statistics
        $websiteStats = $this->getWebsiteStats();

        // Get customer ratings for website dashboard
        $ratingController = new RatingController();
        $customerReviews = $ratingController->getPublicReviews(6);

        return view(
            "admin.dashboard-admin",
            compact(
                "stats",
                "calendarContext",
                "todayQueue",
                "recentCustomers",
                "websiteStats",
                "customerReviews",
            ),
        );
    }

    public function calendarData(Request $request)
    {
        try {
            $validated = $request->validate([
                "month" => "nullable|integer|min:1|max:12",
                "year" => "nullable|integer|min:1900|max:2100",
            ]);

            $month = $validated["month"] ?? now()->month;
            $year = $validated["year"] ?? now()->year;

            $calendarContext = $this->buildCalendarContext($month, $year);

            return response()->json($calendarContext);
        } catch (\Exception $e) {
            return response()->json(
                [
                    "error" => "Failed to load calendar data",
                    "message" => $e->getMessage(),
                ],
                500,
            );
        }
    }

    public function galeri()
    {
        $galeris = Galeri::orderByDesc("id_galeri")->paginate(12);
        return view("admin.galeri.index", compact("galeris"));
    }

    public function montir()
    {
        // Get real mechanic data from database
        $mechanics = Montir::orderBy("nama")->get();

        return view("admin.montir.index", compact("mechanics"));
    }

    /**
     * Artikel Layanan index page (list)
     */
    public function artikelIndex()
    {
        $items = ArtikelLayanan::orderByDesc("updated_at")->paginate(10);
        return view("admin.artikel.index", compact("items"));
    }

    public function artikelCreate()
    {
        return view("admin.artikel.create");
    }

    public function artikelEdit($id)
    {
        $item = ArtikelLayanan::findOrFail($id);
        return view("admin.artikel.edit", compact("item"));
    }

    /**
     * Show admin/montir profile page
     */
    public function profile()
    {
        $admin = Auth::guard("montir")->user();
        $montirs = Montir::orderBy("nama")->get();

        return view("admin.profil-admin", compact("admin", "montirs"));
    }

    /**
     * Update current admin/montir profile
     */
    public function updateProfile(Request $request)
    {
        $admin = Auth::guard("montir")->user();

        $validated = $request->validate([
            "nama" => "required|string|max:255",
            "email" =>
                "required|email|unique:montir,email," .
                $admin->id_montir .
                ",id_montir",
            "peran" => "required|in:admin,montir",
            "password" => "nullable|string|min:6",
            "foto" => "nullable|image|max:2048",
        ]);

        // Handle photo upload
        if ($request->hasFile("foto")) {
            $file = $request->file("foto");
            $filename =
                time() .
                "_" .
                preg_replace("/\s+/", "_", $file->getClientOriginalName());
            $destination = public_path("images/montir");
            if (!is_dir($destination)) {
                @mkdir($destination, 0755, true);
            }
            $file->move($destination, $filename);
            $admin->foto = "images/montir/" . $filename;
        }

        $admin->nama = $validated["nama"];
        $admin->email = $validated["email"];
        $admin->peran = $validated["peran"];
        if (!empty($validated["password"])) {
            // Will be hashed automatically by model casts
            $admin->password = $validated["password"];
        }
        $admin->save();

        return back()->with("success", "Profil berhasil diperbarui.");
    }

    /**
     * Create a new montir (from modal on profile page)
     */
    public function storeMontir(Request $request)
    {
        $validated = $request->validate([
            "nama" => "required|string|max:255",
            "email" => "required|email|unique:montir,email",
            "password" => "required|string|min:6",
            "peran" => "required|in:admin,montir",
            "foto" => "nullable|image|max:2048",
        ]);

        $data = [
            "nama" => $validated["nama"],
            "email" => $validated["email"],
            "password" => $validated["password"], // hashed by model casts
            "peran" => $validated["peran"],
            "tgl_dibuat" => now(),
            "aktif" => true,
        ];

        if ($request->hasFile("foto")) {
            $file = $request->file("foto");
            $filename =
                time() .
                "_" .
                preg_replace("/\s+/", "_", $file->getClientOriginalName());
            $destination = public_path("images/montir");
            if (!is_dir($destination)) {
                @mkdir($destination, 0755, true);
            }
            $file->move($destination, $filename);
            $data["foto"] = "images/montir/" . $filename;
        }

        Montir::create($data);

        return back()->with("success", "Montir baru berhasil ditambahkan.");
    }

    private function getDashboardStats()
    {
        $today = today();
        $currentMonth = Carbon::now()->startOfMonth();
        $endMonth = Carbon::now()->endOfMonth();

        // Get completed bookings today with pricing
        $completedToday = AntriStruk::whereDate("tanggal_selesai", $today)
            ->where("status", "selesai")
            ->get();

        // Get completed bookings this month with pricing
        $completedThisMonth = AntriStruk::whereBetween("tanggal_selesai", [
            $currentMonth,
            $endMonth,
        ])
            ->where("status", "selesai")
            ->get();

        // Calculate today's revenue from completed services
        $revenueToday = $completedToday->sum("harga_keseluruhan") ?? 0;

        // Calculate monthly revenue from completed services
        $monthlyRevenue = $completedThisMonth->sum("harga_keseluruhan") ?? 0;

        // Get active bookings (not cancelled or completed)
        $activeBookings = AntriStruk::whereNotIn("status", [
            "cancelled",
            "selesai",
        ])->count();

        // Get pending confirmations
        $pendingQueue = AntriStruk::whereIn("status", [
            "pending",
            "harga_dari_admin",
        ])->count();

        // Get services scheduled for today
        $servicesToday = AntriStruk::whereDate("tanggal_pesan", $today)
            ->whereNotIn("status", ["cancelled"])
            ->count();

        // Get dynamic rating from RatingController
        $ratingController = new RatingController();
        $ratingStats = $ratingController->getStatsForDashboard();
        $averageRating = $ratingStats["average_rating"];

        return [
            "total_customers" => Pelanggan::count(),
            "services_today" => $servicesToday,
            "active_queue" => $activeBookings,
            "average_rating" => $averageRating,
            "total_ratings" => $ratingStats["total_ratings"],
            "completed_today" => $completedToday->count(),
            "revenue_today" => $revenueToday,
            "pending_queue" => $pendingQueue,
            "monthly_revenue" => $monthlyRevenue,
            "completed_this_month" => $completedThisMonth->count(),
        ];
    }

    private function buildCalendarContext($month = null, $year = null): array
    {
        $month = $month ?? now()->month;
        $year = $year ?? now()->year;
        $currentMonth = Carbon::createFromDate(
            $year,
            $month,
            1,
        )->startOfMonth();
        $start = $currentMonth->copy();
        $end = $currentMonth->copy()->endOfMonth();

        $bookings = AntriStruk::with([
            "pelanggan:id_pelanggan,nama",
            "mobil:id_mobil,nama_mobil,plat_nomor",
        ])
            ->whereBetween("tanggal_pesan", [
                $start->copy()->startOfDay(),
                $end->copy()->endOfDay(),
            ])
            ->orderBy("tanggal_pesan")
            ->get();

        $holidays = KalenderLibur::betweenDates($start, $end)
            ->orderBy("tanggal")
            ->get();

        $days = [];

        foreach ($bookings as $booking) {
            $dateKey = optional($booking->tanggal_pesan)?->toDateString();
            if (!$dateKey) {
                continue;
            }

            if (!isset($days[$dateKey])) {
                $days[$dateKey] = [
                    "bookings" => [],
                    "booking_count" => 0,
                    "statuses" => [],
                ];
            }

            $days[$dateKey]["bookings"][] = [
                "id" => $booking->id_antri_struk,
                "nomor_booking" => $booking->nomor_booking,
                "status" => $booking->status,
                "pelanggan" => optional($booking->pelanggan)->nama,
                "mobil" => optional($booking->mobil)->nama_mobil,
                "plat_nomor" => optional($booking->mobil)->plat_nomor,
                "waktu" => optional($booking->tanggal_pesan)?->format("H:i"),
            ];
        }

        foreach ($days as $dateKey => &$info) {
            $info["booking_count"] = count($info["bookings"]);
            $info["statuses"] = collect($info["bookings"])
                ->groupBy("status")
                ->map(function ($group) {
                    return $group->count();
                })
                ->toArray();
        }
        unset($info);

        foreach ($holidays as $holiday) {
            $dateKey = Carbon::parse($holiday->tanggal)->format("Y-m-d");

            if (!isset($days[$dateKey])) {
                $days[$dateKey] = [
                    "bookings" => [],
                    "booking_count" => 0,
                    "statuses" => [],
                ];
            }

            $days[$dateKey]["holiday"] = [
                "title" => $holiday->judul,
                "note" => $holiday->keterangan,
            ];
        }

        ksort($days);

        // Adjust start day of week for Monday-Saturday calendar
        $startDayOfWeek = (int) $currentMonth->copy()->day(1)->dayOfWeekIso;
        // Convert Sunday (7) to Saturday position (6) for our Mon-Sat calendar
        $adjustedStartDay = $startDayOfWeek === 7 ? 6 : $startDayOfWeek - 1;

        return [
            "month_start" => $start,
            "month_name" => $currentMonth
                ->locale("id")
                ->translatedFormat("F Y"),
            "days_in_month" => $currentMonth->daysInMonth,
            "start_day_of_week" => $startDayOfWeek,
            "adjusted_start_day" => $adjustedStartDay,
            "days" => $days,
        ];
    }

    /**
     * Get website statistics for dashboard
     */
    private function getWebsiteStats()
    {
        try {
            // Get article statistics
            $totalArticles = ArtikelLayanan::count();
            $publishedArticles = ArtikelLayanan::when(
                Schema::hasColumn("artikel_layanan", "dipublikasi"),
                fn($q) => $q->where("dipublikasi", true),
            )->count();

            // Get gallery statistics
            $totalGalleryImages = Galeri::count();
            $recentGalleryImages = Galeri::whereDate(
                "created_at",
                ">=",
                now()->subDays(30),
            )->count();

            // Get team statistics
            $totalTeamMembers = BioMontir::count();
            $activeTeamMembers = BioMontir::count(); // Assume all are active for now

            // Get rating statistics
            $ratingController = new RatingController();
            $ratingStats = $ratingController->getStatsForDashboard();

            // Recent articles (last 5)
            $recentArticles = ArtikelLayanan::orderByDesc("updated_at")
                ->limit(5)
                ->get()
                ->map(function ($article) {
                    return [
                        "id" => $article->id,
                        "judul" => $article->judul,
                        "updated_at" => $article->updated_at,
                        "status" => Schema::hasColumn(
                            "artikel_layanan",
                            "dipublikasi",
                        )
                            ? ($article->dipublikasi
                                ? "Published"
                                : "Draft")
                            : "Published",
                    ];
                });

            // Recent gallery images
            $recentGallery = Galeri::orderByDesc("created_at")
                ->limit(8)
                ->get()
                ->map(function ($galeri) {
                    return [
                        "id" => $galeri->id_galeri,
                        "name" => $galeri->nama_foto,
                        "image" => $galeri->foto
                            ? "galeri/" . $galeri->foto
                            : null,
                        "created_at" => $galeri->created_at,
                    ];
                });

            // Team members data
            $teamMembers = BioMontir::orderBy("created_at", "desc")
                ->get()
                ->map(function ($montir) {
                    return [
                        "id" => $montir->id_bio_montir,
                        "name" => $montir->nama,
                        "role" => $montir->peringkat,
                        "image" => $montir->foto
                            ? asset("storage/montir/" . $montir->foto)
                            : null,
                        "email" => $montir->email,
                        "phone" => $montir->nomor_telepon,
                        "aktif" => true, // Assume all are active
                    ];
                });

            return [
                "articles" => [
                    "total" => $totalArticles,
                    "published" => $publishedArticles,
                    "draft" => $totalArticles - $publishedArticles,
                    "recent" => $recentArticles,
                ],
                "gallery" => [
                    "total" => $totalGalleryImages,
                    "recent_count" => $recentGalleryImages,
                    "recent_images" => $recentGallery,
                ],
                "team" => [
                    "total" => $totalTeamMembers,
                    "active" => $activeTeamMembers,
                    "members" => $teamMembers,
                ],
                "ratings" => $ratingStats,
            ];
        } catch (\Exception $e) {
            \Log::error("Website stats error: " . $e->getMessage());

            return [
                "articles" => [
                    "total" => 0,
                    "published" => 0,
                    "draft" => 0,
                    "recent" => collect(),
                ],
                "gallery" => [
                    "total" => 0,
                    "recent_count" => 0,
                    "recent_images" => collect(),
                ],
                "team" => [
                    "total" => 0,
                    "active" => 0,
                    "members" => collect(),
                ],
                "ratings" => [
                    "average_rating" => 0,
                    "total_ratings" => 0,
                ],
            ];
        }
    }

    public function notifications()
    {
        return view('admin.notifications');
    }
}
