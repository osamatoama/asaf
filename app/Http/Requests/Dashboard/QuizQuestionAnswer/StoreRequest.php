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
            'product_ids' => ['required', 'array', 'min:1'],
            'product_ids.*' => ['required', 'exists:products,id'],
        ];
    }

    public function attributes()
    {
        return [
            'title' => 'الإجابة',
            'description' => 'وصف الإجابة',
            'product_ids' => 'المنتجات',
        ];
    }

    public function messages()
    {
        return [
            'product_ids.required' => 'اختر منتج واحد على الأقل',
            'product_ids.min' => 'اختر منتج واحد على الأقل',
        ];
    }
}
