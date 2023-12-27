<?php

namespace App\Http\Requests\Dashboard\Profile;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;
use Illuminate\Validation\Rules\Password;

class ChangePasswordRequest extends FormRequest
{
    public function authorize(): bool
    {
        return Gate::allows('profile_password_edit');
    }

    public function rules(): array
    {
        return [
            'password' => ['required', 'confirmed', Password::min(8)->mixedCase()->letters()->numbers()->symbols()],
        ];
    }

    public function messages(): array
    {
        return [
            'password.required'  => __('global.Password is required'),
            'password.confirmed' => __('global.Password must match password confirmation'),
            'password.min'       => __('global.Password minimum 8 characters'),
        ];
    }
}
