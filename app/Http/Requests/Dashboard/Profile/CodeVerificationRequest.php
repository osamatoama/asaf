<?php

namespace App\Http\Requests\Dashboard\Profile;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;

class CodeVerificationRequest extends FormRequest
{
    public function authorize(): bool
    {
        return Gate::allows('profile_password_edit');
    }

    public function rules(): array
    {
        return [
            'code' => 'required|digits:4',
        ];
    }

    public function messages(): array
    {
        return [
            'code.required' => __('validation/admin.verification_code_required'),
            'code.digits'   => __('validation/admin.verification_code_digits'),
        ];
    }
}
