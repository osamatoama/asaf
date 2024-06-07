<?php

namespace App\Models\Traits\Quiz;

use App\Models\QuizEntry;
use App\Models\QuizResult;
use App\Models\QuizQuestion;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * Trait QuizRelations
 */
trait QuizRelations
{
    /**
     * @return HasMany
     */
    public function questions(): HasMany
    {
        return $this->hasMany(QuizQuestion::class, 'quiz_id');
    }

    /**
     * @return HasMany
     */
    public function results(): HasMany
    {
        return $this->hasMany(QuizResult::class, 'quiz_id');
    }

    /**
     * @return HasMany
     */
    public function entries()
    {
        return $this->hasMany(QuizEntry::class, 'quiz_id');
    }
}
