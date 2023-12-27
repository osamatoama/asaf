<?php

namespace App\Models\Traits;

use Illuminate\Database\Eloquent\Builder;

/**
 * Trait Verifiable
 */
trait Verifiable
{

    public function scopeVerified(Builder $query): Builder
    {
        return $query->where('verified', true);
    }

    public function scopeUnverified(Builder $query): Builder
    {
        return $query->where('verified', false);
    }

    public function isVerified(): bool
    {
        return (bool) $this->verified;
    }

    public function isUnverified(): bool
    {
        return !$this->isVerified();
    }

    public function verify(): bool {
        return $this->update([
            'verified' => true
        ]);
    }

    public function unverify(): bool {
        return $this->update([
            'verified' => false
        ]);
    }
}
