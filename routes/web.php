<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\User\DashboardController;
use App\Http\Controllers\User\ProfileController;
use App\Http\Controllers\User\UserBookingController;
use App\Http\Controllers\User\UserMobilController;
use App\Http\Controllers\User\KalenderBookingController as UserKalenderBookingController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\AdminLayananController;
use App\Http\Controllers\Admin\AntrianController;
use App\Http\Controllers\Admin\KalenderBookingController as AdminKalenderBookingController;
use App\Http\Controllers\Admin\KalenderLiburController;
use App\Http\Controllers\Admin\RatingController;
use App\Http\Controllers\Admin\BioMontirController;
use App\Http\Controllers\Admin\GaleriController;
use App\Http\Controllers\Website\ArtikelLayanan as ArtikelLayananController;

// Public Routes - Accessible by EVERYONE (guest & authenticated)
Route::middleware(["web"])->group(function () {
    Route::get("/", [
        \App\Http\Controllers\LandingController::class,
        "index",
    ])->name("beranda");
    Route::get("/layanan", [ArtikelLayananController::class, "index"])->name(
        "layanan",
    );
    Route::get("/layanan/{slug}", [
        ArtikelLayananController::class,
        "show",
    ])->name("layanan.detail");

    // Likes endpoints - HARUS bisa diakses guest
    Route::get("/layanan/{slug}/likes", [
        ArtikelLayananController::class,
        "likesCount",
    ])->name("layanan.likes");
    Route::post("/layanan/{slug}/like", [
        ArtikelLayananController::class,
        "like",
    ])->name("layanan.like");
    Route::post("/layanan/{slug}/unlike", [
        ArtikelLayananController::class,
        "unlike",
    ])->name("layanan.unlike");

    // Review/Rating endpoints - accessible by authenticated users
    Route::post("/review", [
        \App\Http\Controllers\LandingController::class,
        "storeReview",
    ])
        ->name("review.store")
        ->middleware("auth");
});

// Guest Routes (Only for non-authenticated users)
Route::middleware("auth.middleware:guest,web")->group(function () {
    Route::get("/login", [AuthController::class, "showLogin"])->name("login");
    Route::post("/login", [AuthController::class, "login"])->name("login.post");
    Route::get("/register", [AuthController::class, "showRegister"])->name(
        "register",
    );
    Route::post("/register", [AuthController::class, "register"])->name(
        "register.post",
    );
});

// Logout route - accessible by both guards
Route::post("/logout", [AuthController::class, "logout"])->name("logout");

// Authenticated User Routes
Route::middleware("auth.middleware:auth,web")->group(function () {
    // User Dashboard
    Route::get("/dashboard", [DashboardController::class, "index"])->name(
        "dashboard",
    );
    Route::get("/dashboard/calendar/bookings", [
        UserKalenderBookingController::class,
        "index",
    ])->name("dashboard.calendar.bookings");

    // Booking Pelanggan
    Route::get("/booking", [UserBookingController::class, "index"])->name(
        "booking",
    );
    Route::post("/booking", [UserBookingController::class, "store"])->name(
        "booking.store",
    );
    Route::post("/booking/add-car", [
        UserBookingController::class,
        "addCar",
    ])->name("booking.add-car");

    // Profile
    Route::get("/profile", [ProfileController::class, "index"])->name(
        "profile",
    );
    Route::put("/profile", [ProfileController::class, "update"])->name(
        "profile.update",
    );

    // Cars Management
    Route::resource("mobil", UserMobilController::class, [
        "names" => [
            "create" => "user.mobil.create",
            "store" => "user.mobil.store",
            "edit" => "user.mobil.edit",
            "update" => "user.mobil.update",
            "destroy" => "user.mobil.destroy",
        ],
        "except" => ["index", "show"],
    ]);

    // Manajemen Antrian
    Route::get("/antrian", [UserBookingController::class, "antrian"])->name(
        "antrian",
    );

    // Notifications
    Route::get("/notifications", function () {
        $user = auth()->user();
        if ($user) {
            // Mark all unread as read when visiting the page
            $user->unreadNotifications()->update(["read_at" => now()]);
        }
        return view("user.notifications");
    })->name("notifications");
});

// User Antrian actions (called from booking receipt modal)
Route::middleware("auth.middleware:auth,web")
    ->prefix("user")
    ->group(function () {
        Route::post("/antrian/{id}/confirm-price", [
            UserBookingController::class,
            "confirmPrice",
        ])->name("user.antrian.confirm_price");
        Route::post("/antrian/{id}/cancel", [
            UserBookingController::class,
            "cancel",
        ])->name("user.antrian.cancel");
    });

// Admin Routes - separate middleware group
Route::middleware("auth.middleware:auth,montir")
    ->prefix("admin")
    ->group(function () {
        Route::get("/dashboard", [AdminController::class, "dashboard"])->name(
            "admin.dashboard",
        );
        Route::get("/dashboard/calendar-data", [
            AdminController::class,
            "calendarData",
        ])->name("admin.dashboard.calendar.data");
        Route::get("/notifications", [
            AdminController::class,
            "notifications",
        ])->name("admin.notifications");
        Route::get("/kalender/bookings", [
            AdminKalenderBookingController::class,
            "index",
        ])->name("admin.calendar.bookings");
        Route::get("/kalender/libur", [
            KalenderLiburController::class,
            "index",
        ])->name("admin.calendar.holidays.index");
        Route::post("/kalender/libur", [
            KalenderLiburController::class,
            "store",
        ])->name("admin.calendar.holidays.store");
        Route::put("/kalender/libur/{kalenderLibur}", [
            KalenderLiburController::class,
            "update",
        ])->name("admin.calendar.holidays.update");
        Route::delete("/kalender/libur/{kalenderLibur}", [
            KalenderLiburController::class,
            "destroy",
        ])->name("admin.calendar.holidays.destroy");

        // Admin Antrian management
        Route::get("/antrian", [AntrianController::class, "index"])->name(
            "admin.antrian",
        );
        Route::post("/antrian/{id}/set-price", [
            AntrianController::class,
            "setPrice",
        ])->name("admin.antrian.set_price");
        Route::post("/antrian/{id}/start", [
            AntrianController::class,
            "startService",
        ])->name("admin.antrian.start");
        Route::post("/antrian/{id}/finish", [
            AntrianController::class,
            "finish",
        ])->name("admin.antrian.finish");
        Route::post("/antrian/{id}/cancel", [
            AntrianController::class,
            "cancel",
        ])->name("admin.antrian.cancel");
        Route::delete("/antrian/{id}", [
            AntrianController::class,
            "destroy",
        ])->name("admin.antrian.destroy");
        Route::post("/antrian/{id}/set-estimasi", [
            AntrianController::class,
            "setEstimasi",
        ])->name("admin.antrian.set_estimasi");

        // Layanan Management (CRUD)
        Route::get("/layanan", [AdminLayananController::class, "index"])->name(
            "admin.layanan",
        );
        Route::get("/layanan/create", [
            AdminLayananController::class,
            "create",
        ])->name("admin.layanan.create");
        Route::post("/layanan", [
            AdminLayananController::class,
            "storeLayanan",
        ])->name("admin.layanan.store");
        Route::get("/layanan/{id}/edit", [
            AdminLayananController::class,
            "edit",
        ])->name("admin.layanan.edit");
        Route::put("/layanan/{id}", [
            AdminLayananController::class,
            "updateLayanan",
        ])->name("admin.layanan.update");
        Route::delete("/layanan/{id}", [
            AdminLayananController::class,
            "destroyLayanan",
        ])->name("admin.layanan.destroy");

        // Kategori Management
        Route::post("/kategori", [
            AdminLayananController::class,
            "storeKategori",
        ])->name("admin.kategori.store");
        Route::delete("/kategori/{id}", [
            AdminLayananController::class,
            "destroyKategori",
        ])->name("admin.kategori.destroy");
        // Galeri Management (CRUD)
        Route::get("/galeri", [AdminController::class, "galeri"])->name(
            "admin.galeri.index",
        );
        Route::get("/galeri/create", [GaleriController::class, "create"])->name(
            "admin.galeri.create",
        );
        Route::post("/galeri", [GaleriController::class, "store"])->name(
            "admin.galeri.store",
        );
        Route::get("/galeri/{id}", [GaleriController::class, "show"])->name(
            "admin.galeri.show",
        );
        Route::get("/galeri/{id}/edit", [
            GaleriController::class,
            "edit",
        ])->name("admin.galeri.edit");
        Route::put("/galeri/{id}", [GaleriController::class, "update"])->name(
            "admin.galeri.update",
        );
        Route::delete("/galeri/{id}", [
            GaleriController::class,
            "destroy",
        ])->name("admin.galeri.destroy");
        // Bio Montir Management
        Route::resource("montir", BioMontirController::class, [
            "except" => ["show"],
            "names" => [
                "index" => "admin.montir.index",
                "create" => "admin.montir.create",
                "store" => "admin.montir.store",
                "edit" => "admin.montir.edit",
                "update" => "admin.montir.update",
                "destroy" => "admin.montir.destroy",
            ],
        ]);
        // Artikel Layanan (Admin)
        Route::get("/artikel", [AdminController::class, "artikelIndex"])->name(
            "admin.artikel.index",
        );
        Route::get("/artikel/create", [
            AdminController::class,
            "artikelCreate",
        ])->name("admin.artikel.create");
        Route::get("/artikel/{id}/edit", [
            AdminController::class,
            "artikelEdit",
        ])->name("admin.artikel.edit");
        Route::post("/artikel", [
            ArtikelLayananController::class,
            "store",
        ])->name("admin.artikel.store");
        Route::put("/artikel/{id}", [
            ArtikelLayananController::class,
            "update",
        ])->name("admin.artikel.update");
        Route::delete("/artikel/{id}", [
            ArtikelLayananController::class,
            "destroy",
        ])->name("admin.artikel.destroy");
        // Admin Profile
        Route::get("/profile", [AdminController::class, "profile"])->name(
            "admin.profil-admin",
        );
        Route::put("/profile", [AdminController::class, "updateProfile"])->name(
            "admin.profile.update",
        );

        // Rating Management Routes
        Route::get("/ratings", [RatingController::class, "index"])->name(
            "admin.ratings.index",
        );
        Route::get("/ratings/create", [
            RatingController::class,
            "create",
        ])->name("admin.ratings.create");
        Route::post("/ratings", [RatingController::class, "store"])->name(
            "admin.ratings.store",
        );
        Route::get("/ratings/{id}", [RatingController::class, "show"])->name(
            "admin.ratings.show",
        );
        Route::get("/ratings/{id}/edit", [
            RatingController::class,
            "edit",
        ])->name("admin.ratings.edit");
        Route::put("/ratings/{id}", [RatingController::class, "update"])->name(
            "admin.ratings.update",
        );
        Route::delete("/ratings/{id}", [
            RatingController::class,
            "destroy",
        ])->name("admin.ratings.destroy");
        Route::delete("/ratings/{id}/ajax", [
            RatingController::class,
            "ajaxDestroy",
        ])->name("admin.ratings.ajax-destroy");
        Route::get("/ratings-stats", [
            RatingController::class,
            "getStats",
        ])->name("admin.ratings.stats");
        Route::get("/ratings-chart", [
            RatingController::class,
            "getChartData",
        ])->name("admin.ratings.chart");
    });
