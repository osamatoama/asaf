<?php

namespace App\Models\Traits\QuizQuestion;

use App\Models\Traits\Activatable;
use Illuminate\Database\Eloquent\Builder;

/**
 * Trait QuizQuestionHelpers
 */
trait QuizQuestionHelpers
{
    use Activatable;

    /**
     * Scopes
     */
    public function scopeHasImage(Builder $query): Builder
    {
        return $query->where('has_image', true);
    }

    public function scopeHasNoImage(Builder $query): Builder
    {
        return $query->where('has_image', false);
    }

    /**
     * Helpers
     */
    public function hasImage(): bool {
        return (bool) $this->has_image;
    }

    public function hasNoImage(): bool {
        return !$this->hasImage();
    }
}
