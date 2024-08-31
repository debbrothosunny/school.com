<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\View;
use App\Models\Setting;
use Illuminate\Support\Facades\Cache;



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
    public function boot(): void
    {
        // Cache the settings and share it across all views
        View::composer('*', function ($view) {
            // Cache the settings for 60 minutes
            $settings = Cache::remember('settings', 60, function () {
                return Setting::first();
            });
            
            // Share the settings with all views
            $view->with('setting', $settings);
        });
    
        // Use Bootstrap for pagination
        Paginator::useBootstrap();
    }

}
