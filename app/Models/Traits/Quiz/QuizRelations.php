<?php

namespace App\Models\Traits\Quiz;

use App\Models\QuizPoint;
use App\Models\QuizQuestion;
use App\Models\QuizResult;
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
    public function points(): HasMany
    {
        return $this->hasMany(QuizPoint::class, 'quiz_id');
    }

    /**
     * @return HasMany
     */
    public function results(): HasMany
    {
        return $this->hasMany(QuizResult::class, 'quiz_id');
    }
}
