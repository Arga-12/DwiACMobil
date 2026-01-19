<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Galeri;
use App\Models\BioMontir;
use App\Models\Rating;
use App\Models\Pelanggan;
use App\Models\ArtikelLayanan as Artikel;
use App\Models\AntriStruk;
use App\Models\KalenderLibur;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Carbon;

class LandingController extends Controller
{
    public function index(Request $request)
    {
        // Get articles for services section
        $articles = $this->getArticles();

        // Get gallery images for gallery section
        $galleryImages = $this->getGalleryImages();

        // Get calendar data for booking calendar
        $calendarData = $this->getCalendarData($request);

        // Get testimonial data (static for now, can be made dynamic later)
        $reviews = $this->getReviews();

        // Get team members data (static for now, can be made dynamic later)
        $teamMembers = $this->getTeamMembers();

        // Get hero section data
        $heroData = $this->getHeroData();

        return view(
            "beranda",
            compact(
                "articles",
                "galleryImages",
                "calendarData",
                "reviews",
                "teamMembers",
                "heroData",
            ),
        );
    }

    /**
     * Get articles for services carousel
     */
    private function getArticles()
    {
        try {
            $articles = Artikel::query()
                ->when(
                    Schema::hasColumn("artikel_layanan", "dipublikasi"),
                    fn($q) => $q->where("dipublikasi", true),
                )
                ->orderByDesc("updated_at")
                ->limit(6)
                ->get();

            // Safely handle empty collection
            if ($articles->isEmpty()) {
                return collect();
            }

            return $articles->map(function ($article) {
                if ($article && $article->id) {
                    $sessionKey = "liked_artikel_" . $article->id;
                    $article->liked = session()->has($sessionKey);
                }
                return $article;
            });
        } catch (\Exception $e) {
            \Log::error("Landing page articles error: " . $e->getMessage());
            return collect();
        }
    }

    /**
     * Get gallery images for gallery section
     */
    private function getGalleryImages()
    {
        try {
            $galeris = Galeri::orderByDesc("created_at")->limit(5)->get();

            if ($galeris->isEmpty()) {
                // Return empty state indicator
                return [];
            }

            return $galeris
                ->map(function ($galeri, $index) {
                    // Use storage path for uploaded images
                    $imagePath = $galeri->foto
                        ? "storage/galeri/" . $galeri->foto
                        : "images/galeri/service" . ($index + 1) . ".png";
                    
                    return [
                        "foto" => $imagePath,
                        "nama_foto" => $galeri->nama_foto ?? "Gallery Image",
                        "tanggal" => $galeri->created_at->format("d M Y"),
                    ];
                })
                ->toArray();
        } catch (\Exception $e) {
            \Log::error("Landing page gallery error: " . $e->getMessage());

            // Return empty state indicator on error
            return [];
        }
    }

    /**
     * Get calendar data for booking section
     */
    private function getCalendarData(Request $request)
    {
        try {
            // Get month and year from request, default to current month
            $month = $request->get("month", now()->month);
            $year = $request->get("year", now()->year);

            if (is_string($month) && str_contains($month, "-")) {
                [$year, $month] = explode("-", $month);
            }

            $month = $month ?? now()->month;
            $year = $year ?? now()->year;
            $currentMonth = Carbon::createFromDate(
                $year,
                $month,
                1,
            )->startOfMonth();
            $start = $currentMonth->copy();
            $end = $currentMonth->copy()->endOfMonth();

            // Calculate previous and next month for navigation
            $prev = $currentMonth->copy()->subMonth();
            $next = $currentMonth->copy()->addMonth();

            // Get bookings for this month
            $bookings = AntriStruk::whereBetween("tanggal_pesan", [
                $start->copy()->startOfDay(),
                $end->copy()->endOfDay(),
            ])
                ->orderBy("tanggal_pesan")
                ->get();

            // Get holidays for this month
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
                    "waktu" => optional($booking->tanggal_pesan)?->format(
                        "H:i",
                    ),
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
                // Keep compatibility with beranda template
                "current" => $currentMonth,
                "lastDay" => $end,
                "prev" => $prev,
                "next" => $next,
                "monthLabel" => $currentMonth
                    ->locale("id")
                    ->translatedFormat("F Y"),
                "blankCount" => $adjustedStartDay,
                "bookingsByDate" => $days, // Alias for backward compatibility
                "holidays" => $holidays->keyBy(function ($holiday) {
                    return Carbon::parse($holiday->tanggal)->format("Y-m-d");
                }),
            ];
        } catch (\Exception $e) {
            \Log::error("Landing page calendar error: " . $e->getMessage());

            // Return current month data on error
            $current = now()->startOfMonth();
            return [
                "month_start" => $current,
                "month_name" => $current->locale("id")->translatedFormat("F Y"),
                "days_in_month" => $current->daysInMonth,
                "start_day_of_week" => $current->dayOfWeekIso,
                "adjusted_start_day" => 0,
                "days" => [],
                // Keep compatibility
                "current" => $current,
                "lastDay" => $current->copy()->endOfMonth(),
                "prev" => $current->copy()->subMonth(),
                "next" => $current->copy()->addMonth(),
                "monthLabel" => $current->locale("id")->translatedFormat("F Y"),
                "blankCount" => 0,
                "bookingsByDate" => [],
                "holidays" => collect(),
            ];
        }
    }

    /**
     * Get reviews/testimonials data
     */
    private function getReviews()
    {
        try {
            $ratings = Rating::with("pelanggan")
                ->orderBy("created_at", "desc")
                ->limit(4)
                ->get();

            if ($ratings->isEmpty()) {
                // Return empty array to show empty state
                return [];
            }

            return $ratings
                ->map(function ($rating) {
                    return [
                        "name" => $rating->pelanggan
                            ? $rating->pelanggan->nama
                            : "Pelanggan",
                        "image" =>
                            $rating->pelanggan &&
                            $rating->pelanggan->foto_profil
                                ? asset($rating->pelanggan->foto_profil)
                                : "https://ui-avatars.com/api/?name=" .
                                    urlencode(
                                        $rating->pelanggan
                                            ? $rating->pelanggan->nama
                                            : "User",
                                    ) .
                                    "&background=0F044C&color=fff&size=128&rounded=true",
                        "text" => $rating->ulasan,
                        "rating" => $rating->bintang,
                        "date" => $rating->created_at->format("d M Y"),
                    ];
                })
                ->toArray();
        } catch (\Exception $e) {
            \Log::error("Landing page reviews error: " . $e->getMessage());

            // Return empty array on error to show empty state
            return [];
        }
    }

    /**
     * Store review from user
     */
    public function storeReview(Request $request)
    {
        try {
            $validated = $request->validate([
                "name" => "required|string|max:255",
                "email" => "required|email|max:255",
                "bintang" => "required|numeric|min:1|max:5",
                "ulasan" => "required|string|min:10|max:1000",
                "id_pelanggan" => "required|numeric",
            ]);

            Rating::create([
                "email" => $validated["email"],
                "bintang" => (int) $validated["bintang"],
                "ulasan" => $validated["ulasan"],
                "id_pelanggan" => (int) $validated["id_pelanggan"],
            ]);

            return redirect()
                ->back()
                ->with(
                    "success",
                    "Terima kasih! Review Anda berhasil dikirim.",
                );
        } catch (\Illuminate\Validation\ValidationException $e) {
            return redirect()->back()->withErrors($e)->withInput();
        } catch (\Exception $e) {
            return redirect()
                ->back()
                ->with("error", "Gagal mengirim review. Silakan coba lagi.")
                ->withInput();
        }
    }

    /**
     * Get team members data
     */
    private function getTeamMembers()
    {
        try {
            $bioMontir = BioMontir::orderBy("created_at", "desc")->get();

            if ($bioMontir->isEmpty()) {
                // Return empty array to show empty state
                return [];
            }

            return $bioMontir
                ->map(function ($montir) {
                    return [
                        "name" => $montir->nama,
                        "role" => $montir->peringkat,
                        "image" => $montir->foto
                            ? asset("storage/montir/" . $montir->foto)
                            : asset("images/team/default.jpg"),
                        "desc" => $montir->kutipan,
                        "email" => $montir->email,
                        "phone" => $montir->nomor_telepon,
                    ];
                })
                ->toArray();
        } catch (\Exception $e) {
            \Log::error("Landing page team members error: " . $e->getMessage());

            // Return empty array on error to show empty state
            return [];
        }
    }

    /**
     * Get dynamic data for hero section
     */
    private function getHeroData()
    {
        try {
            // Get total users count from Pelanggan model only
            $totalUsers = Pelanggan::count();

            // Get average rating
            $avgRating = Rating::avg("bintang");
            $avgRating = $avgRating ? round($avgRating, 1) : 0;

            // Get total services done (completed bookings)
            $totalServices = AntriStruk::where("status", "selesai")->count();

            // Get recent user photos for display (all users, with or without photo)
            $recentUsers = Pelanggan::latest()
                ->limit(4)
                ->get(["nama", "foto_profil"]);

            $result = [
                "total_users" => $totalUsers,
                "avg_rating" => $avgRating,
                "total_services" => $totalServices,
                "recent_users" => $recentUsers
                    ->map(function ($user) {
                        return [
                            "name" => $user->nama,
                            "image" => $user->foto_profil
                                ? asset($user->foto_profil)
                                : "https://ui-avatars.com/api/?name=" .
                                    urlencode($user->nama) .
                                    "&background=0F044C&color=fff&size=128&rounded=true",
                        ];
                    })
                    ->toArray(),
                // Dynamic messages based on real data only
                "user_message" =>
                    $totalUsers > 0
                        ? number_format($totalUsers) .
                            "+ Users berpartisipasi dengan kami"
                        : null,
                "rating_message" =>
                    $avgRating > 0
                        ? "Rata rata kepuasan : " . $avgRating . " / 5"
                        : null,
            ];

            return $result;
        } catch (\Exception $e) {
            \Log::error("Hero data error: " . $e->getMessage());

            // Return empty data on error
            return [
                "total_users" => 0,
                "avg_rating" => 0,
                "total_services" => 0,
                "recent_users" => [],
                "user_message" => null,
                "rating_message" => null,
            ];
        }
    }
}
