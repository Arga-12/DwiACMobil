<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Rating;
use App\Models\Pelanggan;
use Illuminate\Support\Facades\DB;

class RatingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Rating::with("pelanggan");

        // Search functionality
        if ($request->filled("search")) {
            $search = $request->get("search");
            $query->where(function ($q) use ($search) {
                $q->where("ulasan", "like", "%{$search}%")
                    ->orWhere("email", "like", "%{$search}%")
                    ->orWhereHas("pelanggan", function ($subQ) use ($search) {
                        $subQ->where("nama", "like", "%{$search}%");
                    });
            });
        }

        // Filter by rating
        if ($request->filled("rating")) {
            $query->where("bintang", $request->get("rating"));
        }

        // Filter by date range
        if ($request->filled("date_from")) {
            $query->whereDate("created_at", ">=", $request->get("date_from"));
        }

        if ($request->filled("date_to")) {
            $query->whereDate("created_at", "<=", $request->get("date_to"));
        }

        // Get statistics for dashboard cards
        $stats = $this->getDetailedStats();

        $ratings = $query->orderBy("created_at", "desc")->paginate(15);

        return view("admin.ratings.index", compact("ratings", "stats"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $pelanggan = Pelanggan::orderBy("nama")->get();
        return view("admin.ratings.create", compact("pelanggan"));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            "id_pelanggan" => "required|exists:pelanggan,id_pelanggan",
            "email" => "required|email|max:255",
            "bintang" => "required|integer|min:1|max:5",
            "ulasan" => "required|string|min:10|max:1000",
        ]);

        Rating::create($validated);

        return redirect()
            ->route("admin.ratings.index")
            ->with("success", "Rating berhasil ditambahkan.");
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $rating = Rating::with("pelanggan")->findOrFail($id);
        return view("admin.ratings.show", compact("rating"));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $rating = Rating::findOrFail($id);
        $pelanggan = Pelanggan::orderBy("nama")->get();
        return view("admin.ratings.edit", compact("rating", "pelanggan"));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $rating = Rating::findOrFail($id);

        $validated = $request->validate([
            "id_pelanggan" => "required|exists:pelanggan,id_pelanggan",
            "email" => "required|email|max:255",
            "bintang" => "required|integer|min:1|max:5",
            "ulasan" => "required|string|min:10|max:1000",
        ]);

        $rating->update($validated);

        return redirect()
            ->route("admin.ratings.index")
            ->with("success", "Rating berhasil diperbarui.");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $rating = Rating::findOrFail($id);
            $rating->delete();

            return redirect()
                ->route("admin.ratings.index")
                ->with("success", "Rating berhasil dihapus.");
        } catch (\Exception $e) {
            return redirect()
                ->route("admin.ratings.index")
                ->with("error", "Gagal menghapus rating.");
        }
    }

    /**
     * Get rating statistics for admin dashboard
     * This method is used by AdminController to get rating stats
     */
    public function getStatsForDashboard()
    {
        try {
            // Get average rating (same logic as LandingController)
            $avgRating = Rating::avg("bintang");
            $avgRating = $avgRating ? round($avgRating, 1) : 0;

            // Get total ratings count
            $totalRatings = Rating::count();

            return [
                "average_rating" => $avgRating,
                "total_ratings" => $totalRatings,
            ];
        } catch (\Exception $e) {
            \Log::error("Rating stats error: " . $e->getMessage());

            return [
                "average_rating" => 0,
                "total_ratings" => 0,
            ];
        }
    }

    /**
     * Get detailed rating statistics for admin rating management page
     */
    public function getDetailedStats()
    {
        try {
            // Get average rating
            $avgRating = Rating::avg("bintang");
            $avgRating = $avgRating ? round($avgRating, 1) : 0;

            // Get total ratings count
            $totalRatings = Rating::count();

            // Get rating distribution (count by star rating)
            $ratingDistribution = Rating::select(
                "bintang",
                DB::raw("count(*) as count"),
            )
                ->groupBy("bintang")
                ->pluck("count", "bintang")
                ->toArray();

            // Initialize all ratings (1-5) with 0 if not present
            for ($i = 1; $i <= 5; $i++) {
                if (!isset($ratingDistribution[$i])) {
                    $ratingDistribution[$i] = 0;
                }
            }

            // Get ratings this month
            $ratingsThisMonth = Rating::whereYear("created_at", now()->year)
                ->whereMonth("created_at", now()->month)
                ->count();

            // Get ratings this week
            $ratingsThisWeek = Rating::whereBetween("created_at", [
                now()->startOfWeek(),
                now()->endOfWeek(),
            ])->count();

            // Get recent ratings (last 5)
            $recentRatings = Rating::with("pelanggan")
                ->orderBy("created_at", "desc")
                ->limit(5)
                ->get()
                ->map(function ($rating) {
                    return [
                        "id" => $rating->id_rating,
                        "customer_name" => $rating->pelanggan
                            ? $rating->pelanggan->nama
                            : "Unknown",
                        "rating" => $rating->bintang,
                        "review" => \Str::limit($rating->ulasan, 100),
                        "date" => $rating->created_at->format("d M Y"),
                        "time" => $rating->created_at->format("H:i"),
                    ];
                });

            return [
                "average_rating" => $avgRating,
                "total_ratings" => $totalRatings,
                "rating_distribution" => $ratingDistribution,
                "ratings_this_month" => $ratingsThisMonth,
                "ratings_this_week" => $ratingsThisWeek,
                "recent_ratings" => $recentRatings,
                // Additional stats for dashboard cards
                "excellent_ratings" =>
                    ($ratingDistribution[5] ?? 0) +
                    ($ratingDistribution[4] ?? 0), // 4-5 stars
                "poor_ratings" =>
                    ($ratingDistribution[1] ?? 0) +
                    ($ratingDistribution[2] ?? 0), // 1-2 stars
                "average_ratings" => $ratingDistribution[3] ?? 0, // 3 stars
            ];
        } catch (\Exception $e) {
            \Log::error("Detailed rating stats error: " . $e->getMessage());

            return [
                "average_rating" => 0,
                "total_ratings" => 0,
                "rating_distribution" => [
                    1 => 0,
                    2 => 0,
                    3 => 0,
                    4 => 0,
                    5 => 0,
                ],
                "ratings_this_month" => 0,
                "ratings_this_week" => 0,
                "recent_ratings" => collect(),
                "excellent_ratings" => 0,
                "poor_ratings" => 0,
                "average_ratings" => 0,
            ];
        }
    }

    /**
     * Get reviews for public display (same as LandingController logic)
     * This can be used for API endpoints or other public-facing features
     */
    public function getPublicReviews($limit = 4)
    {
        try {
            $ratings = Rating::with("pelanggan")
                ->orderBy("created_at", "desc")
                ->limit($limit)
                ->get();

            if ($ratings->isEmpty()) {
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
            \Log::error("Public reviews error: " . $e->getMessage());
            return [];
        }
    }

    /**
     * API endpoint to get rating statistics (for AJAX calls)
     */
    public function apiStats()
    {
        $stats = $this->getStatsForDashboard();
        return response()->json($stats);
    }

    /**
     * Delete rating via AJAX for dashboard use
     */
    public function ajaxDestroy($id)
    {
        try {
            $rating = Rating::findOrFail($id);
            $customerName = $rating->pelanggan
                ? $rating->pelanggan->nama
                : "Unknown";
            $rating->delete();

            return response()->json([
                "success" => true,
                "message" => "Rating dari {$customerName} berhasil dihapus.",
            ]);
        } catch (\Exception $e) {
            \Log::error("AJAX Rating delete error: " . $e->getMessage());

            return response()->json(
                [
                    "success" => false,
                    "message" => "Gagal menghapus rating. Silakan coba lagi.",
                ],
                500,
            );
        }
    }
}
