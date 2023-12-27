<?php

namespace App\Services\Helpers;

use App\Models\User;

class Platform
{
    public function authCheck(?string $guard = null): bool
    {
        return auth($guard)->check();
    }

    public function authId(?string $guard = null): ?int
    {
        return auth($guard)->id();
    }

    public function authUser(?string $guard = null): ?User
    {
        return auth($guard)->user();
    }

    public function getAuthFieldType(?string $value): string
    {
        if (filter_var($value, FILTER_VALIDATE_EMAIL)) {
            return 'email';
        }

        return 'phone';
    }
}
