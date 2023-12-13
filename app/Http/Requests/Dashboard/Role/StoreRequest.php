<?php

namespace App\Http\Requests\Dashboard\Role;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Gate;

class StoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return Gate::allows(config('models.role.permissions.create'));
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'title'         => 'required|string|max:191',
            'permissions'   => 'required|array|min:1',
            'permissions.*' => 'required|integer|exists:permissions,id',
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
            'title.required'        => __('validation/admin.title_required'),
            'title.string'          => __('validation/admin.title_string'),
            'title.max'             => __('validation/admin.title_max'),

            'permissions.required'  => __('validation/admin.permissions_required'),
            'permissions.array'     => __('validation/admin.permissions_array'),

            'permissions.*.integer' => __('validation/admin.permissions_integer'),
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
        return array_merge(Arr::only(parent::validated(), ['title']), [
            'related_user_id' => $this->getParentId(),
        ]);
    }

    /**
     * Get Permissions Array
     *
     * @return array
     */
    public function permissions(): array {
        return (array) $this->get('permissions', []);
    }

    /**
     * Get Parent Id
     *
     * @return int|null
     */
    private function getParentId(): ?int
    {
        return authUser()->parent_id ?? authId();
    }
}
