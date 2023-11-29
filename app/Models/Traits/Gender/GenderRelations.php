<?php

namespace App\Models\Traits\Gender;

use App\Models\Product;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * Trait GenderRelations
 */
trait GenderRelations
{
    /**
     * @return HasMany
     */
    public function products(): HasMany
    {
        return $this->hasMany(Product::class, 'gender_id');
    }

}
