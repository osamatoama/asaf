<?php

namespace App\Models\Traits\Product;


use App\Models\QuizPoint;
use App\Models\QuizResult;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * Trait ProductRelations
 */
trait ProductRelations
{
    /**
     * @return BelongsToMany
     */
    public function points(): BelongsToMany {
        return $this->belongsToMany(QuizPoint::class, 'quiz_point_products', 'product_id', 'quiz_point_id');
    }

    /**
     * @return HasMany
     */
    public function results(): HasMany
    {
        return $this->hasMany(QuizResult::class, 'product_id');
    }
}
