<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class CarFactory extends Factory
{
    public function definition(): array
    {
        return [
            'brand_id' => \App\Models\Brand::factory(),
            'car_model_id' => \App\Models\CarModel::factory(),
            'model_year' => $this->faker->year(),
            'license_expire_date' => $this->faker->optional()->date(),
            'body_style_id' => \App\Models\BodyStyle::factory(),
            'type_id' => \App\Models\Type::factory(),
            'fuel_economy_id' => \App\Models\FuelEconomy::factory(),
            'transmission_type_id' => \App\Models\TransmissionType::factory(),
            'drive_type_id' => \App\Models\DriveType::factory(),
            'engine_type_id' => \App\Models\EngineType::factory(),
            'engine_capacity_cc' => $this->faker->numberBetween(1000, 5000),
            'color' => $this->faker->safeColorName(),
            'size_id' => \App\Models\Size::factory(),
            'mileage' => $this->faker->numberBetween(0, 300000),
            'horsepower_id' => \App\Models\Horsepower::factory(),
            'vehicle_status_id' => \App\Models\VehicleStatus::factory(),
            'refurbishment_status' => $this->faker->randomElement([
                'empty',
                'limited_offer',
                'fully_refurbished',
                'certified_refurbished',
            ]),
            'price' => $this->faker->randomFloat(2, 50000, 1000000),
            'discount' => $this->faker->randomFloat(2, 0, 10000),
            'monthly_installment' => $this->faker->optional()->randomFloat(2, 1000, 20000),
            'trim_id' => \App\Models\Trim::factory(),
        ];
    }
}
