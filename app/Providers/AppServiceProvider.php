<?php

namespace App\Providers;

use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Schema;
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
        ini_set('memory_limit', -1);
        set_time_limit(-1);
        Schema::defaultStringLength(191);

        if($this->app->environment('production')) {
            URL::forceScheme('https');
        }
    }
}
