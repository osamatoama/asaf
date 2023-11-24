<?php

namespace App\Models\Traits\Client;


use App\Models\QuizResult;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * Trait ClientRelations
 */
trait ClientRelations
{
    /**
     * @return HasMany
     */
    public function results(): HasMany
    {
        return $this->hasMany(QuizResult::class, 'client_id');
    }
}
