<?php

namespace App\Http\Requests\Dashboard\User;

use Illuminate\Database\Query\Builder;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Gate;
use Illuminate\Validation\Rule;

class UpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return Gate::allows(config('models.user.permissions.edit'));
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        $user = $this->route('user');
        return [
            'name'              => 'required|string|max:191',
            'email'             => 'required|string|email|max:191|unique:users,email,' . $user->id,
            'password'          => 'nullable|string|min:8|max:191',
            'role'              => [
                'required',
                'integer',
                Rule::exists('roles', 'id')->where(function (Builder $query) {
                    $query->where('related_user_id', $this->getParentId());
                }),
            ],
            'phone'             => 'nullable|phone',
            'phone_country'     => 'required_with:phone',
            'verification_code' => 'nullable|digits:4',
            'verified'          => 'nullable|boolean',
            'active'            => 'nullable|boolean',
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages(): array
    {
        return [
            'name.required' => __('validation/admin.name_required'),
            'name.string'   => __('validation/admin.name_string'),
            'name.max'      => __('validation/admin.name_max'),

            'email.required' => __('validation/admin.email_required'),
            'email.string'   => __('validation/admin.email_string'),
            'email.email'    => __('validation/admin.email_email'),
            'email.unique'   => __('validation/admin.email_unique'),
            'email.max'      => __('validation/admin.email_max'),

            'password.required' => __('validation/admin.password_required'),
            'password.string'   => __('validation/admin.password_string'),
            'password.min'      => __('validation/admin.password_min_8'),
            'password.max'      => __('validation/admin.password_max_191'),

            'role.required' => __('validation/admin.role_required'),
            'role.integer'  => __('validation/admin.role_integer'),
            'role.exists'   => __('validation/admin.role_exists'),

            'verification_code.digits' => __('validation/admin.verification_code_digits'),
        ];
    }

    /**
     * Get the validated data from the request.
     *
     * @param null $key
     * @param null $default
     * @return array
     */
    public function validated($key = null, $default = null): array
    {
        $data = [
            'parent_id' => $this->getParentId(),
            'phone'     => phone($this->input('phone'), $this->input('phone_country'))->formatE164(),
            'verified'  => $this->boolean('verified'),
            'active'    => $this->boolean('active'),
        ];

        if ($this->filled('password')) {
            $data['password'] = bcrypt($this->get('password'));
        }

        return array_merge(Arr::except(parent::validated(), [
            'password',
            'role',
            'phone',
            'phone_country',
        ]), $data);
    }

    /**
     * Get the role id.
     *
     * @return array
     */
    public function roleId(): array
    {
        return [(int)$this->get('role')];
    }

    /**
     * Get the parent id of the logged-in user.
     *
     * @return int
     */
    private function getParentId(): int
    {
        $user = auth()->user();
        return $user->parent_id ?? $user->id ?? 0;
    }

}
