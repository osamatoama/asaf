<?php

namespace App\Models\Traits\ProductCategory;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Trait ProductCategoryRelations
 */
trait ProductCategoryRelations
{
    /**
     * @return BelongsTo
     */
    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class, 'product_id');
    }

    /**
     * @return BelongsTo
     */
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

}
