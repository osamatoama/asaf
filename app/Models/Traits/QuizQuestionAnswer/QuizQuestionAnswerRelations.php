<?php

namespace App\Models\Traits\QuizQuestionAnswer;

use App\Models\Product;
use App\Models\QuizQuestion;
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
}
