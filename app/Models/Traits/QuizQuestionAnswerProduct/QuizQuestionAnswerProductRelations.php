<?php

namespace App\Models\Traits\QuizQuestionAnswerProduct;

use App\Models\Product;
use App\Models\QuizQuestionAnswer;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Trait QuizQuestionAnswerProductRelations
 */
trait QuizQuestionAnswerProductRelations
{
    /**
     * @return BelongsTo
     */
    public function answer(): BelongsTo
    {
        return $this->belongsTo(QuizQuestionAnswer::class, 'quiz_question_answer_id');
    }

    /**
     * @return BelongsTo
     */
    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class, 'product_id');
    }
}
