<?php

namespace App\Models\Traits\Answer;

use Illuminate\Support\Fluent;
use Spatie\Image\Exceptions\InvalidManipulation;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

/**
 * Trait AnswerHelpers
 */
trait AnswerHelpers
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
            'media'     => $media,
        ]);
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
