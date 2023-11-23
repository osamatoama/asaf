<?php

namespace App\Models\Traits\QuizResult;

use App\Models\Client;
use App\Models\Product;
use App\Models\Quiz;
use App\Models\QuizResultAnswer;
use App\Models\QuizResultClient;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

/**
 * Trait QuizResultRelations
 */
trait QuizResultRelations
{
    /**
     * @return BelongsTo
     */
    public function quiz(): BelongsTo
    {
        return $this->belongsTo(Quiz::class, 'quiz_id');
    }

    /**
     * @return BelongsTo
     */
    public function client(): BelongsTo
    {
        return $this->belongsTo(Client::class, 'client_id');
    }

    /**
     * @return BelongsTo
     */
    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class, 'product_id');
    }

    public function quizResultClient(): HasOne
    {
        return $this->hasOne(QuizResultClient::class, 'quiz_result_id');
    }

    /**
     * @return HasMany
     */
    public function quizResultAnswers(): HasMany
    {
        return $this->hasMany(QuizResultAnswer::class, 'quiz_result_id');
    }
}
