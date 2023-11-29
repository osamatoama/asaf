<?php

namespace App\Models\Traits\Product;

use App\Models\Gender;
use Illuminate\Database\Eloquent\Builder;
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

    public function scopeWantedGenders(Builder $query, int $genderId): Builder {
        if ($genderId === Gender::MALE_ID) {
            return $query->whereIn('gender_id', [Gender::MALE_ID, Gender::UNISEX_ID]);
        }

        if ($genderId === Gender::FEMALE_ID) {
            return $query->whereIn('gender_id', [Gender::FEMALE_ID, Gender::UNISEX_ID]);
        }

        return $query->where('gender_id',Gender::UNISEX_ID);
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
