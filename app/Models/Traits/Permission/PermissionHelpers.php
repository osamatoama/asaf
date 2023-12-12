<?php

namespace App\Models\Traits\Permission;

use Illuminate\Database\Eloquent\Builder;

/**
 * Trait PermissionHelpers
 */
trait PermissionHelpers
{
    /**
     * Scopes
     */
    public function scopeAllowedPermissions(Builder $query): Builder
    {
        return $query->where([
            ['title', '!=', 'user_management_access'],
            ['title', 'not like', 'role_%'],
            ['title', 'not like', 'permission_%'],
            ['title', 'not like', 'user_%'],
            ['title', 'not like', 'audit_log_%'],
        ]);
    }

    public function scopeWithoutContentPermissions(Builder $query): Builder
    {
        return $query->where([
            ['title', 'not like', 'content_%'],
        ]);
    }
}
