<?php

namespace App\Models\Traits\QuizQuestionAnswer;

use App\Models\QuizQuestion;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

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
}
