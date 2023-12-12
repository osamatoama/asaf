<?php

namespace App\Http\Requests\Dashboard\Product;

use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Arr;

class UpdateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return Gate::allows(config('models.product.permissions.edit'));
    }

    /**
     * @return array
     */
    public function rules(): array
    {
        return [
            'gender_id'   => 'required|integer|exists:genders,id',
            'name'        => 'required|string|max:191',
            'url'         => 'required|string|active_url|max:191',
            'description' => 'required|string',
            'image_url'   => 'required_unless:image,null|active_url|string|max:191',
            'image'       => 'required_unless:image_url,null|string|max:191',
        ];
    }

    /**
     * @return array
     */
    public function attributes(): array
    {
        return [
            'gender_id' => 'Gender',
        ];
    }

    /**
     * @return array
     */
    public function messages(): array
    {
        return [
            'gender_id.required'        => __('validation/admin.gender_id_required'),
            'gender_id.integer'         => __('validation/admin.gender_id_integer'),
            'gender_id.exists'          => __('validation/admin.gender_id_exists'),

            'name.required'             => __('validation/admin.name_required'),
            'name.string'               => __('validation/admin.name_string'),
            'name.max'                  => __('validation/admin.name_max'),

            'url.required'              => __('validation/admin.product_url_required'),
            'url.string'                => __('validation/admin.product_url_string'),
            'url.active_url'            => __('validation/admin.product_url_active_url'),
            'url.max'                   => __('validation/admin.product_url_max'),

            'description.required'      => __('validation/admin.description_required'),
            'description.string'        => __('validation/admin.description_string'),

            'image_url.required_unless' => __('validation/admin.product_image_url_required_unless'),
            'image_url.string'          => __('validation/admin.product_image_url_string'),
            'image_url.active_url'      => __('validation/admin.product_image_url_active_url'),
            'image_url.max'             => __('validation/admin.product_image_url_max'),

            'image.required_unless'     => __('validation/admin.image_required_unless'),
            'image.string'              => __('validation/admin.image_string'),

        ];
    }

    /**
     * @param null $key
     * @param null $default
     * @return array
     */
    public function validated($key = null, $default = null): array
    {
        return Arr::except(array_merge(parent::validated(), [
            'image_url' => blank($this->input('image')) ? $this->input('image_url') : null
        ]), ['image']);
    }
}
