<?php

namespace App\Models\Traits\Product;

use App\Models\Category;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Trait ProductRelations
 */
trait ProductRelations
{
    /**
     * @return BelongsTo
     */
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class, 'category_id');
    }
}
