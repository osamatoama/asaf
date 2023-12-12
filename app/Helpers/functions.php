<?php

use App\Services\Helpers\Dashboard;
use App\Services\Helpers\Platform;
use App\Services\Helpers\Website;

if (!function_exists('platform')) {
    function platform(): Platform
    {
        app()->singletonIf(Platform::class);

        return app(Platform::class);
    }
}

if (!function_exists('website')) {
    function website(): Website
    {
        app()->singletonIf(Website::class);

        return app(Website::class);
    }
}

if (!function_exists('dashboard')) {
    function dashboard(): Dashboard
    {
        app()->singletonIf(Dashboard::class);

        return app(Dashboard::class);
    }
}
