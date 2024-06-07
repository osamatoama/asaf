<?php

use App\Services\Helpers\Media;
use App\Services\Helpers\Website;
use App\Services\Helpers\Platform;
use Illuminate\Support\Facades\DB;
use App\Services\Helpers\Dashboard;
use Illuminate\Support\Facades\Log;

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
        if (app()->environment('production')) {
            return asset($asset, true);
        }

        return asset($asset);
    }
}

if (! function_exists('logError')) {
    function logError(mixed $error): void
    {
        Log::error($error);
    }
}

if (! function_exists('getDbTables')) {
    function getDbTables($dbName = null) : array
    {
        $column_name = "Tables_in_" . ($dbName ?? env('DB_DATABASE'));

        return array_map(fn($table) => $table->$column_name, DB::select('SHOW TABLES'));
    }
}
