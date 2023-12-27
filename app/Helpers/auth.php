<?php

use Illuminate\Contracts\Auth\Authenticatable;

if (!function_exists('authCheck')) {
    function authCheck(string $guard = null): bool
    {
        return platform()->authCheck($guard);
    }
}

if (!function_exists('authUser')) {
    function authUser(string $guard = null): ?Authenticatable
    {
        return platform()->authUser($guard);
    }
}

if (!function_exists('authId')) {
    function authId(string $guard = null): ?int
    {
        return platform()->authId($guard);
    }
}
