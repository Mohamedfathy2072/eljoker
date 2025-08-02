<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PaginatedCarsRequest extends FormRequest
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
            'brand_id' => 'nullable|integer|exists:brands,id',
            'car_model_id' => 'nullable|integer|exists:car_models,id',
            'model_year' => 'nullable|integer|min:1900|max:' . (date('Y') + 1),

            'price_range' => 'nullable|array|size:2',
            'price_range.0' => 'nullable|numeric',
            'price_range.1' => 'nullable|numeric',

            'fuel_economy' => 'nullable|array',
            'fuel_economy.min' => 'nullable|numeric',
            'fuel_economy.max' => 'nullable|numeric',

            'transmission_type_id' => 'nullable|integer|exists:transmission_types,id',
            'body_style_id' => 'nullable|integer|exists:body_styles,id',
            'search' => 'nullable|string|max:255',

            'brand_ids' => 'nullable|array',
            'brand_ids.*' => 'integer|exists:brands,id',
            'body_style_ids' => 'nullable|array',
            'body_style_ids.*' => 'integer|exists:body_styles,id',
            'vehicle_status' => 'nullable|string',
            'engine_capacity_cc' => 'nullable|array',
            'engine_capacity_cc.0' => 'nullable|numeric',
            'engine_capacity_cc.1' => 'nullable|numeric'
        ];
    }

    public function messages(): array
    {
        return [
            'per_page.max' => 'Maximum 100 items per page allowed.',
            'max_price.gt' => 'Maximum price must be greater than minimum price.',
        ];
    }
}
