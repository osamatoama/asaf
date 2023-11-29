<?php

namespace App\Models\Traits\Product;

use App\Models\QuizQuestionAnswer;
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
    public function answers(): BelongsToMany
    {
        return $this->belongsToMany(
            QuizQuestionAnswer::class,
            'quiz_question_answer_products',
            'product_id',
            'quiz_question_answer_id'
        );
    }

    /**
     * @return HasMany
     */
    public function results(): HasMany
    {
        return $this->hasMany(QuizResult::class, 'product_id');
    }
}
