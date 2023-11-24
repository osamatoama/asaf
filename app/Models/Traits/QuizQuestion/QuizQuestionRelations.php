<?php

namespace App\Models\Traits\QuizQuestion;

use App\Models\Quiz;
use App\Models\QuizQuestionAnswer;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * Trait QuizQuestionRelations
 */
trait QuizQuestionRelations
{
    /**
     * @return BelongsTo
     */
    public function quiz(): BelongsTo
    {
        return $this->belongsTo(Quiz::class, 'quiz_id');
    }

    /**
     * @return HasMany
     */
    public function answers(): HasMany
    {
        return $this->hasMany(QuizQuestionAnswer::class, 'quiz_question_id');
    }
}
