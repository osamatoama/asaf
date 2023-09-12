<?php

namespace App\Models\Traits\Gender;


use App\Models\Gender;
use Illuminate\Database\Eloquent\Builder;

/**
 * Trait GenderHelpers
 */
trait GenderHelpers
{
    public function scopeQuizGenders(Builder $query): Builder
    {
        return $query->whereIn('id', [Gender::MALE_ID, Gender::FEMALE_ID]);
    }
}
