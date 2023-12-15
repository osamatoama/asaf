<?php

namespace App\Models\Traits\Product;

use App\Models\Gender;
use App\Models\QuizQuestionAnswer;
use App\Models\QuizResult;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

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
