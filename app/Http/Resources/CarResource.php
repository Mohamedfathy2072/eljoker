<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CarResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return config('app.app') === 'Eljoker'
            ? $this->getCarKlaksat()
            : $this->getCarDraftech();
    }

    public function getCarDraftech()
    {
        $user = auth('api')->user();
        $conditions = !empty($this->resource->conditions)
            ? $this->resource->conditions->map(fn($condition) => [
                    'id' => (int) $condition->id,
                    'name' => $condition->name,
                    'part_name' => $condition->getTranslation('part','ar'),
                    'note' => $condition->getTranslation('description','ar'),
                    'image_url' => !empty($condition->image) ? Storage::url($condition->image) : null,
                ])->groupBy('name')
            : [];
        return [
                'id' => (int) $this->resource->id,
                "model" => $this->resource->carModel?->name,
                "year" => $this->resource->model_year,
                "color" => $this->resource->color ?? '',
                "transmission" => $this->resource->transmissionType?->name,
                "engine_cc" => $this->resource->engine_capacity_cc ?? null,
                "body_type" => $this->resource->bodyStyle?->name,
                "km_driven" => $this->resource->mileage,
                "price" => $this->resource->price,
                "down_payment" => $this->resource->down_payment ?? null,
                "license_validity" => $this->resource->license_expire_date ?? null,
                "location" => $this->resource->location ?? null,
                "condition" => $this->resource->vehicleStatus?->name,
                "fcm_token" => $this->resource->fcm_token ?? null,
                "vehicle_category" => $this->resource->vehicle_category ?? null,
                "description" => $this->resource->description ?? null,
                "payment_option" => $this->resource->payment_option ?? null,
                "created_at" => $this->resource->created_at?->format('Y-m-d H:i:s'),
                "updated_at" => $this->resource->updated_at?->format('Y-m-d H:i:s'),
                "brand_id" => (int) $this->resource->brand_id,
                "brand" => [
                    "id" => (int) $this->resource->brand_id,
                    "name" => $this->resource->brand?->name,
                    "created_at" => $this->resource->brand?->created_at,
                    "updated_at" => $this->resource->brand?->updated_at,
                    "image_url" => !empty($this->resource->brand?->image)
                        ? Storage::url($this->resource->brand?->image) : ''
                ],
                "is_fav" => $user->favouriteCars()->where('car_id', $this->resource->id)->exists() ? true : false,
                "image_url" => null,
                "images" => !empty($this->resource->images) ? $this->resource->images->map(fn($img)=>[
                    'id' => (int) $img->id,
                    'image_url' => Storage::url($img->location)
                ]) : [],
                "exterior_conditions" => !empty($conditions) ?
                    !empty($conditions['exterior_condition'])
                    ? $conditions['exterior_condition'] : []
                : [],
                "interior_conditions" => !empty($conditions) ?
                    !empty($conditions['interior_condition'])
                    ? $conditions['interior_condition'] : []
                : [],
                "mechanical_conditions" => !empty($conditions) ?
                    !empty($conditions['mechanical_condition'])
                    ? $conditions['mechanical_condition'] : []
                : [],
                "pivot" => [
                    "user_id" => $user->id,
                    "car_id" => (int) $this->resource->id
                ]
        ];
    }

    public function getCarKlaksat()
    {
        $locale = app()->getLocale();
        return [
            'id' => (int) $this->resource->id,
            // Car identification
            'brand' => $this->resource->brand_id ? [
                'id' => (int) $this->resource->brand_id,
                'name' => $this->resource->brand?->name,
                'image' => $this->resource->brand?->image ?? ''
            ] : null,
            'model' => $this->resource->car_model_id ? [
                'id' => (int) $this->resource->car_model_id,
                'name' => $this->resource->carModel?->name,
            ] : null,
            'model_year' => $this->resource->model_year,
            'full_name' => trim(
                ($this->resource->brand?->name ?? '') . ' '
                . ($this->resource->model?->name ?? '') . ' '
                . $this->resource->model_year
            ),
            'license_valid_until' => $this->resource->license_expire_date ?? null,
            // Vehicle specifications
            'specifications' => [
                'body_style' => $this->resource->body_style_id ? [
                    'id' => (int) $this->resource->body_style_id,
                    'name' => $this->resource->bodyStyle?->name,
                ] : null,
                'type' => $this->resource->type_id ? [
                    'id' => (int) $this->resource->type_id,
                    'name' => $this->resource->type?->name,
                ] : null,
                'transmission_type' => $this->resource->transmission_type_id ? [
                    'id' => (int) $this->resource->transmission_type_id,
                    'name' => $this->resource->transmissionType?->name,
                ] : null,
                'drive_type' => $this->resource->drive_type_id ? [
                    'id' => (int) $this->resource->drive_type_id,
                    'name' => $this->resource->driveType?->name,
                ] : null,
            ],
            // Physical attributes
            'appearance' => [
                'color' => $this->resource->color ?? '',
                'color_en' => $this->resource->getTranslation('color', 'en'),
                'color_ar' => $this->resource->getTranslation('color', 'ar'),
                'size' => $this->resource->size ? [
                    'id' => (int) $this->resource->size->id,
                    'length' => $this->resource->size->length,
                    'width' => $this->resource->size->width,
                    'height' => $this->resource->size->height,
                    'formate' => $this->resource->size->length . ' x '
                        . $this->resource->size->width . ' x ' . $this->resource->size->height . ' mm',
                ] : null,
            ],
            // Performance & condition
            'performance' => [
                'fuel_economy' => $this->resource->fuelEconomy ? [
                    'id' => (int) $this->resource->fuelEconomy->id,
                    'min' => $this->resource->fuelEconomy->min,
                    'max' => $this->resource->fuelEconomy->max,
                    'formate' => $this->resource->fuelEconomy->min . ' - '
                        . $this->resource->fuelEconomy->max . ' L/100km',
                ] : null,
                'engine_type' => $this->resource->engineType ? [
                    'id' => (int) $this->resource->engineType->id,
                    'name' => $this->resource->engineType->name,
                ] : null,
                'engine_capacity_cc' => $this->resource->engine_capacity_cc ?? null,
                'horsepower' => $this->resource->horsepower ? [
                    'id' => (int) $this->resource->horsepower->id,
                    'min' => $this->resource->horsepower->min,
                    'max' => $this->resource->horsepower->max,
                    'formate' => $this->resource->horsepower->min . ' - '
                        . $this->resource->horsepower->max . ' HP',
                ] : null,
                'mileage' => $this->resource->mileage ? [
                    'value' => $this->resource->mileage,
                    'formate' => number_format($this->resource->mileage) . ' km',
                ] : null,
                'vehicle_status' => $this->resource->vehicle_status_id ? [
                    'id' => (int) $this->resource->vehicle_status_id,
                    'name' => $this->resource->vehicleStatus?->name,
                ] : null,
                'refurbishment_status' => $this->resource->refurbishment_status,
                'refurbishment_status_en' => $this->resource->getTranslation('refurbishment_status', 'en'),
                'refurbishment_status_ar' => $this->resource->getTranslation('refurbishment_status', 'ar')
            ],

            // Classification
            'trim' => $this->resource->trim_id ? [
                'id' => (int) $this->resource->trim_id,
                'name' => $this->resource->trim?->name,
            ] : null,
            // flags


            // Media
            'images' => $this->resource->images ?? [],
            // Timestamps
            'owner' => $this->resource->owner->name ?? '-',
            'created_at' => $this->resource->created_at?->format('Y-m-d H:i:s'),
            'updated_at' => $this->resource->updated_at?->format('Y-m-d H:i:s'),
            'created_at_human' => $this->resource->created_at?->diffForHumans(),
            'updated_at_human' => $this->resource->updated_at?->diffForHumans(),
        ];
    }
}
