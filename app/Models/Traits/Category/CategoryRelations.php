<?php

namespace App\Models\Traits\Category;

use App\Models\Product;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * Trait CategoryRelations
 */
trait CategoryRelations
{
    /**
     * @return BelongsToMany
     */
    public function products(): BelongsToMany
    {
        return $this->belongsToMany(Product::class, 'product_categories', 'category_id', 'product_id');
    }
}
