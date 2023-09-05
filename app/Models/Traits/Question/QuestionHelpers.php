<?php

namespace App\Models\Traits\Question;

use Illuminate\Database\Eloquent\Builder;

/**
 * Trait QuestionHelpers
 */
trait QuestionHelpers
{

    /**
     * Scopes
     */
    public function scopeActive(Builder $query): Builder
    {
        return $query->where('active', true);
    }

    public function scopeInactive(Builder $query): Builder
    {
        return $query->where('active', false);
    }

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
    public function isActive(): bool {
        return (bool) $this->active;
    }

    public function isInactive(): bool {
        return !$this->isActive();
    }

    public function hasImage(): bool {
        return (bool) $this->has_image;
    }

    public function hasNoImage(): bool {
        return !$this->hasImage();
    }
}
