<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateCarRequest extends FormRequest
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
            // Car identification
            'brand' => 'required|string|max:100',
            'model' => 'required|string|max:100',
            'model_year' => 'required|integer|min:1900|max:' . (date('Y') + 1),

            // Vehicle specifications
            'body_style' => 'required|string|max:50|in:SUV,Sedan,Hatchback,Coupe,Convertible,Wagon,Truck,Van,Crossover',
            'type' => 'required|string|max:50',
            'fuel_type' => 'required|string|max:20|in:petrol,diesel,electric,hybrid,lpg,cng',
            'transmission_type' => 'required|string|max:20|in:automatic,manual,cvt,semi-automatic',
            'drive_type' => 'required|string|max:20|in:fwd,rwd,awd,4wd',

            // Physical attributes
            'color' => 'required|string|max:50',

            // Performance & condition
            'mileage' => 'required|integer|min:0|max:9999999',
            'speed' => 'nullable|integer|min:0|max:500',
            'vehicle_status' => 'required|string|max:20|in:new,used,certified_pre_owned',
            'refurbishment_status' => 'nullable|string|max:50',

            // Pricing
            'price' => 'required|numeric|min:0|max:9999999999.99',
            'discount' => 'nullable|numeric|min:0|max:999999.99',
            'monthly_installment' => 'nullable|numeric|min:0|max:99999999.99',

            // Classification
            'category' => 'required|string|max:50',
        ];
    }
}
