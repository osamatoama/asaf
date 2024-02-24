<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class QuizEntryResource extends JsonResource
{
    public static $wrap = 'entry';
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id'         => $this->resource->id,
            'client_id'  => $this->resource->client_id,
            'key'        => $this->resource->key,
            'entry_time' => $this->resource->entry_time,
            'completed'  => $this->resource->completed,
        ];
    }
}
