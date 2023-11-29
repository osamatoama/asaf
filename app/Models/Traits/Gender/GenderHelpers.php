<?php

namespace App\Models\Traits\Gender;

use App\Models\Gender;
use Illuminate\Database\Eloquent\Builder;

/**
 * Trait GenderHelpers
 */
trait GenderHelpers
{
    public function scopeMale(Builder $query): Builder
    {
        return $query->whereIn('id', [Gender::MALE_ID, Gender::UNISEX_ID]);
    }

    public function scopeFemale(Builder $query): Builder
    {
        return $query->whereIn('id', [Gender::FEMALE_ID, Gender::UNISEX_ID]);
    }

    public function scopeUnisex(Builder $query): Builder
    {
        return $query->where('id', Gender::UNISEX_ID);
    }
}
