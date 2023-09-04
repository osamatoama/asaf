<?php

namespace App\Models\Traits\Question;

use App\Models\Answer;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * Trait QuestionRelations
 */
trait QuestionRelations
{

    /**
     * @return HasMany
     */
    public function answers(): HasMany
    {
        return $this->hasMany(Answer::class, 'question_id');
    }
}
