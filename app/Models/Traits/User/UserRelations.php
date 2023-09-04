<?php

namespace App\Models\Traits\User;

use App\Models\UserSallaConfiguration;
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
        return $this->hasMany(UserSallaConfiguration::class, "user_id");
    }
}
