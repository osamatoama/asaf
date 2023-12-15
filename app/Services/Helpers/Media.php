<?php

namespace App\Services\Helpers;

use Illuminate\Support\Collection;
use Illuminate\Support\Fluent;
use Illuminate\Support\Str;
use Spatie\MediaLibrary\MediaCollections\Models\Media as BaseMedia;

class Media
{
    public function getUrl(?BaseMedia $media, string $conversion, ?string $placeholder = null): ?string
    {
        if (blank($media)) {
            return null;
        }

        $placeholder = $placeholder ?? $media?->getUrl();

        return $media?->hasGeneratedConversion($conversion) ? $media?->getUrl($conversion) : $placeholder;
    }

    public function getUrls(?BaseMedia $media, ?array $conversions = null, ?string $placeholder = null): Collection
    {
        if (blank($media)) {
            $conversions = $conversions ?? [];
            $originalUrl = null;
        } else {
            $conversions = $conversions ?? $media?->getMediaConversionNames();
            $originalUrl = $media?->getUrl();
        }

        $urls = collect([
            'original' => $originalUrl,
        ]);
        foreach ($conversions as $conversion) {
            $urls->put(Str::replace('-', '_', $conversion), $this->getUrl($media, $conversion, $placeholder));
        }

        return $urls;
    }

    public function generateConversionObject(?BaseMedia $media, string $conversion, string $placeholder): Fluent
    {
        $isGenerated = (bool) $media?->hasGeneratedConversion($conversion);

        return new Fluent([
            'is_generated' => $isGenerated,
            'url'          => $isGenerated ? $media?->getUrl($conversion) : $placeholder,
        ]);
    }

    public function generateObject(?BaseMedia $media, ?array $conversions = null, ?string $placeholder = null): Fluent
    {
        $conversions = $conversions ?? ((array) ($media?->getMediaConversionNames()));
        $originalUrl = $media?->getUrl() ?? $placeholder ?? '';
        $placeholder = $placeholder ?? $originalUrl;

        $conversionsCollection = collect();
        foreach ($conversions as $conversion) {
            $conversionsCollection->put(
                Str::replace('-', '_', $conversion),
                $this->generateConversionObject($media, $conversion, $placeholder),
            );
        }

        return new Fluent([
            'exists'      => filled($media),
            'media'       => $media,
            'original'    => new Fluent([
                'url' => $originalUrl,
            ]),
            'conversions' => new Fluent($conversionsCollection),
            'alt'         => $media?->getCustomProperty('alt'),
        ]);
    }

    public function generateCollection(Collection $mediaCollection, ?array $conversions = null, ?string $placeholder = null): Collection
    {
        $collection = collect();
        $mediaCollection->each(function (BaseMedia $media) use ($collection, $conversions, $placeholder) {
            $collection->push(
                $this->generateObject($media, $conversions, $placeholder),
            );
        });

        return $collection;
    }
}
