<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Auth;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot()
    {
        Blade::componentNamespace('App\\View\\Components', 'app');
        Blade::componentNamespace('App\\View\\Components\\User', 'user');

        // Kalau foldermu ada di resources/views/user/components
        $this->loadViewComponentsAs('user', [
            \App\View\Components\User\DashboardLayout::class,
        ]);

        // Define admin gate untuk montir
        Gate::define('admin', function ($user) {
            // Cek apakah user dari guard montir
            if (Auth::guard('montir')->check()) {
                $montir = Auth::guard('montir')->user();
                return $montir instanceof \App\Models\Montir && $montir->isAdmin();
            }
            return false;
        });
    }
}
