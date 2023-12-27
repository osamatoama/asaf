<?php

namespace App\Models\Traits\Role;

/**
 * Trait RoleHelpers
 */
trait RoleHelpers
{
    public static function isMainRole(self $role): bool
    {
        return $role->slug === 'admin';
    }
}
