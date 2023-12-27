<?php

namespace App\Models\Traits\Product;

use App\Helpers\GlobalConstants;
use App\Models\Gender;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Fluent;
use Spatie\Image\Exceptions\InvalidManipulation;
use Spatie\Image\Manipulations;
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
        $conversions = ['thumbnail'];

        $data = media()->getUrls($media, $conversions)->merge([
            'media' => $media,
        ]);

        return new Fluent($data);
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
        $this->addMediaCollection('product-images')
            ->singleFile();
    }

    /**
     * @throws InvalidManipulation
     */
    public function registerMediaConversions(Media $media = null): void
    {
        // Thumbnail
        $this->addMediaConversion('thumbnail')
            ->width(GlobalConstants::THUMBNAIL_WIDTH)
            ->height(GlobalConstants::THUMBNAIL_HEIGHT)
            ->nonQueued();
    }
}
