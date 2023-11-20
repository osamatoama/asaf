<?php

namespace App\Models\Traits\QuizResultClient;

use App\Models\QuizResult;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Trait QuizResultClientRelations
 */
trait QuizResultClientRelations
{
    /**
     * @return BelongsTo
     */
    public function result(): BelongsTo
    {
        return $this->belongsTo(QuizResult::class, 'quiz_result_id');
    }
}
