<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\URL;

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
        // Force relative URLs for all redirects in Codespaces/proxied environments
        if (request()->hasHeader('X-Forwarded-Host') || env('APP_ENV') !== 'production') {
            URL::forceScheme('https');
        }
    }
}