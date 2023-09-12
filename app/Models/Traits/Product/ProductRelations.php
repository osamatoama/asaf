<?php

namespace App\Models\Traits\Product;

use App\Models\Category;
use App\Models\Gender;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * Trait ProductRelations
 */
trait ProductRelations
{
    /**
     * @return BelongsTo
     */
    public function gender(): BelongsTo
    {
        return $this->belongsTo(Gender::class, 'gender_id');
    }

    /**
     * @return BelongsToMany
     */
    public function categories(): BelongsToMany
    {
        return $this->belongsToMany(Category::class, 'product_categories', 'product_id', 'category_id');
    }
}
