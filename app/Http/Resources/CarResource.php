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
            'brand' => $this->resource->brand,
            'model' => $this->resource->model,
            'model_year' => $this->resource->model_year,
            'full_name' => $this->resource->brand . ' ' . $this->resource->model . ' ' . $this->resource->model_year,

            // Vehicle specifications
            'specifications' => [
                'body_style' => $this->resource->body_style,
                'type' => $this->resource->type,
                'fuel_type' => $this->resource->fuel_type,
                'transmission_type' => $this->resource->transmission_type,
                'drive_type' => $this->resource->drive_type,
            ],

            // Physical attributes
            'appearance' => [
                'color' => $this->resource->color,
            ],

            // Performance & condition
            'condition' => [
                'mileage' => $this->resource->mileage,
                'mileage_formatted' => number_format($this->resource->mileage) . ' km',
                'speed' => $this->resource->speed,
                'vehicle_status' => $this->resource->vehicle_status,
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
            ],

            // Classification
            'category' => $this->resource->category,

            // Timestamps
            'created_at' => $this->resource->created_at?->format('Y-m-d H:i:s'),
            'updated_at' => $this->resource->updated_at?->format('Y-m-d H:i:s'),
            'created_at_human' => $this->resource->created_at?->diffForHumans(),
            'updated_at_human' => $this->resource->updated_at?->diffForHumans(),
        ];
    }
}
