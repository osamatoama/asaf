<?php

namespace App\Http\Requests\Dashboard\Profile;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;

class UpdateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return Gate::allows('profile_password_edit');
    }

    public function rules(): array
    {
        return [
            'name'  => ['required', 'string'],
            'email' => ['required', 'email', 'unique:users,email,' . authId()],
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => __('validation/admin.name_required'),
            'name.string'   => __('validation/admin.name_string'),

            'email.required' => __('validation/admin.email_required'),
            'email.email'    => __('validation/admin.email_email'),
            'email.unique'   => __('validation/admin.email_unique'),
        ];
    }
}
