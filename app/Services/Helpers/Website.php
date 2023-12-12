<?php

namespace App\Services\Helpers;

use App\Models\User;

class Website
{
    public function authCheck(): bool
    {
        return auth('web')->check();
    }

    public function authId(): ?int
    {
        return auth('web')->id();
    }

    public function authUser(): ?User
    {
        return auth('web')->user();
    }

    public function assets(string $path = ''): string
    {
        $path = 'assets/website/' . ltrim($path, '/');
        if (!app()->isLocal()) {
            $path .= config('version.assets');
        }

        return asset($path);
    }

    public function localeFlag(string $locale): string
    {
        return $this->assets('_flags/' . $locale . '.png');
    }

}
