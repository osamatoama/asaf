<?php

namespace App\Http\Requests\Dashboard\QuizQuestionAnswer;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    protected function prepareForValidation()
    {
        $this->merge([
            'product_ids' => filled($this->product_ids) ? explode(',', $this->product_ids) : [],
        ]);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'quiz_question_id' => ['required', 'exists:quiz_questions,id'],
            'title' => ['required', 'string'],
            'description' => ['nullable', 'string'],
            'product_ids' => ['array'],
            'product_ids.*' => ['required', 'exists:products,id'],
        ];
    }
}
