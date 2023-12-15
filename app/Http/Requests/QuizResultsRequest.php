<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

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
            'user_key' => 'required|string|max:255',
            'phone'    => 'nullable|digits:12',
//            'phone'    => 'nullable|numeric',
            'email'    => 'nullable|email|max:255',
//            'email'    => 'nullable|string|max:255',
            'results'  => 'required|array|min:1',
        ];
    }

    public function attributes(): array
    {
        return [
            'user_key' => 'User unique key',
            'phone'    => 'User phone',
            'email'    => 'User email',
            'results'  => 'Quiz answers',
        ];
    }
}
