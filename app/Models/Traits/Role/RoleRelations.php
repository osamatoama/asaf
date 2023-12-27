<?php

namespace App\Models\Traits\Role;

use App\Models\Permission;
use App\Models\PermissionRole;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * Trait RoleRelations
 */
trait RoleRelations
{
    public function permissions(): BelongsToMany
    {
        return $this->belongsToMany(Permission::class);
    }

    public function permissionRole(): HasMany
    {
        return $this->hasMany(PermissionRole::class);
    }
}
