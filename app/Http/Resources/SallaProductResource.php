<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SallaProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'name'         => $this->resource['name'] ?? '',
            'url'          => $this->resource['urls']['customer'] ?? '',
            'image'        => $this->resource['main_image'] ?? '',
            'category_url' => $this->resource['category_url'] ?? '',
        ];
    }
}
