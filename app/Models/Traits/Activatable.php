<?php

namespace App\Models\Traits;

use Illuminate\Database\Eloquent\Builder;

/**
 * Trait Activatable
 */
trait Activatable
{

    public function scopeActive(Builder $query): Builder
    {
        return $query->where('active', true);
    }

    public function scopeInactive(Builder $query): Builder
    {
        return $query->where('active', false);
    }

    public function isActive(): bool
    {
        return (bool) $this->active;
    }

    public function isInactive(): bool
    {
        return !$this->isActive();
    }

    public function activate(): bool {
        return $this->update([
            'active' => true
        ]);
    }

    public function deactivate(): bool {
        return $this->update([
            'active' => false
        ]);
    }
}
