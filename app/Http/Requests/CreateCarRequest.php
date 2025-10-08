<?php

namespace App\Http\Requests;

use App\Enums\RefurbishmentStatus;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\Rules\Enum;

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
            // ✅ الحقول الإلزامية
            'brand' => 'required',
            'model' => 'required',
            'model_year' => 'required|numeric|min:1900|max:' . (date('Y') + 1),
            'images' => 'required|array|min:1',
            'images.*' => 'image|mimes:jpg,jpeg,png,webp|max:4096',
            'name' => 'nullable|string|max:255', // اسم العربية
            'notes' => 'nullable|string',
            // ❕ باقي الحقول اختيارية (nullable)
            'body_style' => 'nullable',
            'type' => 'nullable',
            'transmission_type' => 'nullable',
            'drive_type' => 'nullable',

            // Physical attributes
            'color_ar' => 'nullable|string|max:50',
            'color_en' => 'nullable|string|max:50',

            // License Expiry Date
            'license_expire_date' => 'nullable|date|after:today',

            // Dimensions
            'length' => 'nullable|numeric|min:0|max:99999',
            'width' => 'nullable|numeric|min:0|max:99999',
            'height' => 'nullable|numeric|min:0|max:99999',

            // Fuel Economy
            'min_fuel_economy' => 'nullable|numeric|min:0|max:999',
            'max_fuel_economy' => 'nullable|numeric|min:0|max:999',

            // Engine
            'engine_type' => 'nullable',
            'engine_capacity' => 'nullable|numeric|min:0|max:99999',

            // Power
            'min_horse_power' => 'nullable|numeric|min:0|max:1000',
            'max_horse_power' => 'nullable|numeric|min:0|max:1000',

            // Condition
            'mileage' => 'nullable|numeric|min:0|max:9999999',
            'vehicle_status' => 'nullable',
            'refurbishment_status' => 'nullable',

            'trim' => 'nullable',
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        if (request()->expectsJson()) {
            // For API requests, return JSON response with validation errors
            throw new HttpResponseException(
                response()->json([
                    'errors' => $validator->errors(),
                    'message' => 'Validation failed'
                ], 422)
            );
        }

        // For web requests, redirect back with validation errors
        throw new HttpResponseException(
            redirect()
                ->back()
                ->withErrors($validator)
                ->withInput()
        );
    }
}
