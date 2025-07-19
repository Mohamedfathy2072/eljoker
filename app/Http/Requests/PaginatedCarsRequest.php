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
            'brand' => 'nullable|string|max:100',
            'model' => 'nullable|string|max:100',
            'model_year' => 'nullable|integer|min:1900|max:' . (date('Y') + 1),
            'min_price' => 'nullable|numeric|min:0',
            'max_price' => 'nullable|required_with:min_price|numeric|min:0|gt:min_price',
            'type' => 'nullable|string|max:50',
            'vehicle_status' => 'nullable|string|max:20|in:new,used,certified_pre_owned',
            'body_style' => 'nullable|string|max:50|in:SUV,Sedan,Hatchback,Coupe,Convertible,Wagon,Truck,Van,Crossover',
            'fuel_type' => 'nullable|string|in:petrol,diesel,electric,hybrid',
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
