<?php

namespace App\Http\Requests\Dashboard\Quiz;

use Gate;
use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return Gate::allows(config('models.quiz.permissions.edit'));
    }

    protected function prepareForValidation()
    {
        if ($this->description == "<p><br></p>") {
            $this->merge([
                'description' => null,
            ]);
        }

        $this->merge([
            'active' => filled($this->active),
        ]);
    }

    /**
     * @return array
     */
    public function rules(): array
    {
        return [
            'title' => ['required', 'string', 'max:191'],
            'description' => ['required', 'string'],
            'active' => ['required', 'boolean'],
        ];
    }

    public function attributes()
    {
        return [
            'title' => 'الاسم',
            'description' => 'الوصف',
            'active' => 'التفعيل',
        ];
    }
}
