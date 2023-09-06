<?php

namespace App\Models\Traits\Category;

use App\Models\Product;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * Trait CategoryRelations
 */
trait CategoryRelations
{
    /**
     * @return HasMany
     */
    public function products(): HasMany
    {
        return $this->hasMany(Product::class, 'category_id');
    }


}
