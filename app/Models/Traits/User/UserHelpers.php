<?php

namespace App\Models\Traits\User;

/**
 * Trait UserHelpers
 */
trait UserHelpers
{

    /**
     * @return mixed
     */
    public function getSallaAccessToken(): mixed
    {
        return optional($this->sallaConfigurations()
            ->where('key', 'access_token')
            ->first())->value;
    }

    public function hasRole(string $role): bool
    {
        if ($this->relationLoaded('roles')) {
            return $this->roles->contains('slug', $role);
        }

        return $this->roles()->where('slug', $role)->exists();
    }

    public function hasAnyRole(array $roles): bool
    {
        if ($this->relationLoaded('roles')) {
            return $this->roles->whereIn('slug', $roles)->isNotEmpty();
        }

        return $this->roles()->whereIn('slug', $roles)->exists();
    }
}
