<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class QuestionResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id'        => $this->resource->id,
            'question'  => $this->resource->title,
            'has_image' => $this->resource->has_image,
            'answers'   => new AnswerCollectionResource($this->resource->answers),
        ];
    }
}
