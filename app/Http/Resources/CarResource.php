<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CarResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->resource->id,

            // Car identification
            'brand' => $this->resource->brand_id ? [
            'id' => $this->resource->brand_id,
            'name' => $this->resource->brand?->name,
            'image' => $this->resource->brand?->image ?? ''
            ] : null,
            'model' => $this->resource->car_model_id ? [
            'id' => $this->resource->car_model_id,
            'name' => $this->resource->carModel?->name,
            ] : null,
            'model_year' => $this->resource->model_year,
            'full_name' => trim(
            ($this->resource->brand?->name ?? '') . ' ' .
            ($this->resource->model?->name ?? '') . ' ' .
            $this->resource->model_year
            ),
            'license_valid_until' => $this->resource->license_expire_date ?? null,

            // Vehicle specifications
            'specifications' => [
            'body_style' => $this->resource->body_style_id ? [
                'id' => $this->resource->body_style_id,
                'name' => $this->resource->bodyStyle?->name,
            ] : null,
            'type' => $this->resource->type_id ? [
                'id' => $this->resource->type_id,
                'name' => $this->resource->type?->name,
            ] : null,
            'transmission_type' => $this->resource->transmission_type_id ? [
                'id' => $this->resource->transmission_type_id,
                'name' => $this->resource->transmissionType?->name,
            ] : null,
            'drive_type' => $this->resource->drive_type_id ? [
                'id' => $this->resource->drive_type_id,
                'name' => $this->resource->driveType?->name,
            ] : null,
            ],

            // Physical attributes
            'appearance' => [
            'color' => $this->resource->color ?? '',
            'size' => $this->resource->size ? [
                'id' => $this->resource->size->id,
                'length' => $this->resource->size->length,
                'width' => $this->resource->size->width,
                'height' => $this->resource->size->height,
                'formate' => $this->resource->size->length . ' x ' .
                    $this->resource->size->width . ' x ' . $this->resource->size->height . ' mm',
            ] : null,
            ],

            // Performance & condition
            'performance' => [
            'fuel_economy' => $this->resource->fuelEconomy ? [
                'id' => $this->resource->fuelEconomy->id,
                'min' => $this->resource->fuelEconomy->min,
                'max' => $this->resource->fuelEconomy->max,
                'formate' => $this->resource->fuelEconomy->min . ' - ' .
                    $this->resource->fuelEconomy->max . ' L/100km',
            ] : null,
            'engine_type' => $this->resource->engineType ? [
                'id' => $this->resource->engineType->id,
                'name' => $this->resource->engineType->name,
            ] : null,
            'engine_capacity_cc' => $this->resource->engine_capacity_cc ?? null,
            'horsepower' => $this->resource->horsepower ? [
                'id' => $this->resource->horsepower->id,
                'min' => $this->resource->horsepower->min,
                'max' => $this->resource->horsepower->max,
                'formate' => $this->resource->horsepower->min . ' - ' .
                    $this->resource->horsepower->max . ' HP',
            ] : null,
            'mileage' => $this->resource->mileage ? [
                'value' => $this->resource->mileage,
                'formate' => number_format($this->resource->mileage) . ' km',
            ] : null,
            'vehicle_status' => $this->resource->vehicle_status_id ? [
                'id' => $this->resource->vehicle_status_id,
                'name' => $this->resource->vehicleStatus?->name,
            ] : null,
            'refurbishment_status' => $this->resource->refurbishment_status,
            ],

            // Pricing information
            'pricing' => [
            'original_price' => $this->resource->price,
            'original_price_formatted' => '$' . number_format($this->resource->price, 2),
            'discount' => $this->resource->discount,
            'discount_formatted' => '$' . number_format($this->resource->discount, 2),
            'final_price' => $this->resource->price - $this->resource->discount,
            'final_price_formatted' => '$' . number_format($this->resource->price - $this->resource->discount, 2),
            'monthly_installment' => $this->resource->monthly_installment,
            'monthly_installment_formatted' => $this->resource->monthly_installment ?
                '$' . number_format($this->resource->monthly_installment, 2) . '/month' : null,
            'has_discount' => $this->resource->discount > 0,
            'down_payment' => $this->resource->down_payment ?? null,
            'down_payment_formatted' => $this->resource->down_payment ?
                '$' . number_format($this->resource->down_payment, 2) : null,
            ],

            // Classification
            'trim' => $this->resource->trim_id ? [
                'id' => $this->resource->trim_id,
                'name' => $this->resource->trim?->name,
            ] : null,

            // flags
            'flags' => $this->resource->flags ?? [],

            // features
            'features' => $this->resource->features
                        ? collect($this->resource->features)
                            ->groupBy('name')
                            ->map(function ($group) {
                                return $group->map(fn ($feature) => [
                                    'id' => $feature->id,
                                    'label' => $feature->label,
                                    'value' => $feature->value,
                                ])->values();
                            })
                        : [],



            // conditions
            'conditions' => $this->resource->conditions ? collect($this->resource->conditions)
                            ->groupBy('name')
                            ->map(function ($group) {
                                return $group->map(fn ($condition) => [
                                    'id' => $condition->id,
                                    'part' => $condition->part,
                                    'description' => $condition->description,
                                    'image' => $condition->image,
                                ])->values();
                            }) : [],

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
