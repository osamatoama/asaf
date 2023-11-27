<?php

namespace App\Http\Resources;

use App\Models\Gender;
use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;
use JsonSerializable;

class QuestionCollectionResource extends ResourceCollection
{
    public static $wrap = 'questions';

    /**
     * Transform the resource into an array.
     *
     * @return array|Arrayable|JsonSerializable
     */
    public function toArray(Request $request): array|Arrayable|JsonSerializable
    {
        return $this->collection->map(function ($question) {
            return new QuestionResource($question);
        })->prepend([
            'id'        => 0,
            'question'  => 'اختر التصنيف المناسب لك في العطور',
            'has_image' => false,
            'answers'   => new GenderCollectionResource(Gender::all()),
        ]);
    }
}
