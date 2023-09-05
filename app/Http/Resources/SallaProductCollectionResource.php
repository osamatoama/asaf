<?php

namespace App\Http\Resources;

use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;
use JsonSerializable;

class SallaProductCollectionResource extends ResourceCollection
{

    public static $wrap = 'products';

    /**
     * Transform the resource into an array.
     *
     * @return array|Arrayable|JsonSerializable
     */
    public function toArray(Request $request): array|Arrayable|JsonSerializable
    {
        return $this->collection->map(function ($product) {
            return new SallaProductResource($product);
        });
    }
}
