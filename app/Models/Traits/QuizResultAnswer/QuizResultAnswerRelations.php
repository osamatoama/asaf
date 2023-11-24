<?php

namespace App\Models\Traits\QuizResultAnswer;

use App\Models\QuizQuestion;
use App\Models\QuizQuestionAnswer;
use App\Models\QuizResult;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Trait QuizResultAnswerRelations
 */
trait QuizResultAnswerRelations
{
    /**
     * @return BelongsTo
     */
    public function result(): BelongsTo
    {
        return $this->belongsTo(QuizResult::class, 'quiz_result_id');
    }

    /**
     * @return BelongsTo
     */
    public function question(): BelongsTo
    {
        return $this->belongsTo(QuizQuestion::class, 'question_id');
    }

    /**
     * @return BelongsTo
     */
    public function answer(): BelongsTo
    {
        return $this->belongsTo(QuizQuestionAnswer::class, 'answer_id');
    }
}
