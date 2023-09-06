<?php

namespace App\Models\Traits\Product;

use Illuminate\Support\Fluent;
use Spatie\Image\Exceptions\InvalidManipulation;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

/**
 * Trait ProductHelpers
 */
trait ProductHelpers
{
    use InteractsWithMedia;

    /**
     * Accessors and Mutators
     */
    public function getImageAttribute(): Fluent
    {
        $media = $this->getFirstMedia('product-images');

        return new Fluent([
            'original'  => $media?->getUrl(),
            'thumbnail' => $media?->getUrl('thumbnail'),
        ]);
    }

    /**
     * Media
     */
    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('product-images');
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
