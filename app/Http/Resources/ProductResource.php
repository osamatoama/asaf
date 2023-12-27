<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    public static $wrap = 'product';

    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $image = $this->resource->image;

        return [
            'name'         => $this->resource->name ?? '',
            'url'          => $this->resource->url ?? '',
            'image'        => $image->media ? $image->thumbnail : ($this->resource->image_url ?? ''),
            'description'  => $this->resource->description ?? '',
        ];
    }
}
