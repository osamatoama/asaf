<?php

use App\Services\Helpers\Dashboard;
use App\Services\Helpers\Media;
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

if (!function_exists('media')) {
    function media(): Media
    {
        app()->singletonIf(Media::class);

        return app(Media::class);
    }
}

if (! function_exists('assetCustom')) {
    function assetCustom(string $asset): string
    {
        return asset($asset, true);
        // if (request()->secure()) {
        //     return asset($asset, true);
        // }

        // return asset($asset);
    }
}
