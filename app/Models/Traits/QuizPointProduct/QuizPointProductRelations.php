<?php

namespace App\Models\Traits\QuizPointProduct;

use App\Models\Product;
use App\Models\QuizPoint;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Trait QuizPointProductRelations
 */
trait QuizPointProductRelations
{
    /**
     * @return BelongsTo
     */
    public function point(): BelongsTo
    {
        return $this->belongsTo(QuizPoint::class, 'quiz_point_id');
    }

    /**
     * @return BelongsTo
     */
    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class, 'product_id');
    }
}
