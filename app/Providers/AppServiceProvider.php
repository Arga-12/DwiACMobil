<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Blade;

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
        \app\view\Components\User\DashboardLayout::class,
    ]);
    }
}
