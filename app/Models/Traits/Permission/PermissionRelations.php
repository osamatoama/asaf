<?php

namespace App\Models\Traits\Permission;

use App\Models\Role;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * Trait PermissionRelations
 */
trait PermissionRelations
{
    public function roles(): BelongsToMany
    {
        return $this->belongsToMany(Role::class);
    }

}
