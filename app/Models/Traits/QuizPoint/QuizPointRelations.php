<?php

namespace App\Models\Traits\QuizPoint;

use App\Models\Product;
use App\Models\Quiz;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * Trait QuizPointRelations
 */
trait QuizPointRelations
{
    /**
     * @return BelongsTo
     */
    public function quiz(): BelongsTo
    {
        return $this->belongsTo(Quiz::class, 'quiz_id');
    }

    /**
     * @return BelongsToMany
     */
    public function products(): BelongsToMany
    {
        return $this->belongsToMany(Product::class, 'quiz_point_products', 'quiz_point_id', 'product_id');
    }
}
