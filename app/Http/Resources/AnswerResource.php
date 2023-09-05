<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AnswerResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id'     => $this->resource->id,
            'answer' => $this->resource->title,
            'image'  => $this->resource->image,
        ];
    }

    private function image(): array
    {
        return [
            'image' => $this->resource->image,
        ];
    }
}
