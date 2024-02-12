<?php

namespace App\Providers;

use App\Models\Permissions;
use App\Observers\PermissionsObserver;
use Illuminate\Support\ServiceProvider;

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
        Permissions::observe(PermissionsObserver::class);
    }
}
