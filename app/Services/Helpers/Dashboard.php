<?php

namespace App\Services\Helpers;

use App\Models\Admin;

class Dashboard
{
    public function authCheck(): bool
    {
        return auth('admin')->check();
    }

    public function authId(): ?int
    {
        return auth('admin')->id();
    }

    public function authUser(): ?Admin
    {
        return auth('admin')->user();
    }

    public function assets(string $path = ''): string
    {
        return assetCustom('assets/dashboard/' . ltrim($path, '/'));
    }

    public function localeFlag(string $locale): string
    {
        return $this->assets('images/flags/' . $locale . '.png');
    }
}
