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
            'brand_id' => 'nullable|integer|in:brands,id',
            'car_model_id' => 'nullable|integer|in:car_models,id',
            'model_year' => 'nullable|integer|min:1900|max:' . (date('Y') + 1),
            'min_price' => 'nullable|numeric|min:0',
            'max_price' => 'nullable|required_with:min_price|numeric|min:0|gt:min_price',
            'transmission_type_id' => 'nullable|integer|in:transmission_types,id',
            'fuel_economy' => 'nullable|string|max:20',
            'body_style_id' => 'nullable|integer|in:body_styles,id',
            'search' => 'nullable|string|max:255'
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
