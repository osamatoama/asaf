<?php

namespace App\Models\Traits\User;

use App\Models\Role;
use App\Models\UserSallaConfiguration;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * Trait UserRelations
 */
trait UserRelations
{

    /**
     * @return HasMany
     */
    public function sallaConfigurations(): HasMany
    {
        return $this->hasMany(UserSallaConfiguration::class, 'user_id');
    }

    /**
     * @return BelongsToMany
     */
    public function roles(): BelongsToMany
    {
        return $this->belongsToMany(Role::class, 'role_user', 'user_id');
    }
}
