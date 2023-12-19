<?php

namespace App\Models\Traits\QuizQuestionAnswer;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Fluent;
use Spatie\Image\Exceptions\InvalidManipulation;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

/**
 * Trait QuizQuestionAnswerHelpers
 */
trait QuizQuestionAnswerHelpers
{
    use InteractsWithMedia;

    /**
     * Accessors and Mutators
     */
    public function getImageAttribute(): Fluent
    {
        $media = $this->getFirstMedia('answer-images');

        return new Fluent([
            'original'  => $media?->getUrl(),
            'thumbnail' => $media?->getUrl('thumbnail'),
        ]);
    }

    public function getProductIdsAttribute(): array
    {
        return $this->products->pluck('id')->toArray();
    }

    public function scopeCountable(Builder $query): Builder
    {
        return $query->where('countable', true);
    }

    public function scopeNotCountable(Builder $query): Builder
    {
        return $query->where('countable', false);
    }

    /**
     * Helpers
     */
    public function isCountable(): bool {
        return (bool) $this->countable;
    }

    public function isNotCountable(): bool {
        return !$this->isCountable();
    }

    /**
     * Media
     */
    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('answer-images');
    }

    /**
     * @throws InvalidManipulation
     */
    public function registerMediaConversions(Media $media = null): void
    {
        // Thumbnail
        $this->addMediaConversion('thumbnail')
            ->width(200)
            ->nonQueued();
    }
}
