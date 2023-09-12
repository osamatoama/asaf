<?php

namespace App\Http\Requests;

use App\Models\Gender;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class QuizResultsRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'gender_id' => [
                'required',
                Rule::in([Gender::MALE_ID, Gender::FEMALE_ID])
            ],
            'results'   => 'required|array|min:1',
        ];
    }
}
