<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class QuizInfoResource extends JsonResource
{
    public static $wrap = 'quiz';
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id'          => $this->resource->id,
            'title'       => $this->resource->title,
            'description' => filled($this->resource->description) ? $this->resource->description : '',
            'active'      => $this->resource->active,
        ];
    }
}
