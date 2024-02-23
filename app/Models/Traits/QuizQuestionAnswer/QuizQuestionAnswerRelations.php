<?php

namespace App\Models\Traits\QuizQuestionAnswer;

use App\Models\Product;
use App\Models\QuizQuestion;
use App\Models\QuizResultAnswer;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * Trait QuizQuestionAnswerRelations
 */
trait QuizQuestionAnswerRelations
{
    /**
     * @return BelongsTo
     */
    public function question(): BelongsTo
    {
        return $this->belongsTo(QuizQuestion::class, 'quiz_question_id');
    }

    /**
     * @return BelongsToMany
     */
    public function products(): BelongsToMany
    {
        return $this->belongsToMany(
            Product::class,
            'quiz_question_answer_products',
            'quiz_question_answer_id',
            'product_id'
        );
    }

    /**
     * @return HasMany
     */
    public function resultAnswers(): HasMany
    {
        return $this->hasMany(QuizResultAnswer::class, 'answer_id');
    }
}
