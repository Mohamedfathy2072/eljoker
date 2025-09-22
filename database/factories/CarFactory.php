<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class CarFactory extends Factory
{
    public function definition(): array
    {
        return [
            'brand_id' => \App\Models\Brand::inRandomOrder()->first()->id,  // جلب علامة السيارة عشوائيًا من قاعدة البيانات
            'car_model_id' => \App\Models\CarModel::inRandomOrder()->first()->id,  // جلب موديل السيارة عشوائيًا
            'model_year' => $this->faker->year(),
            'license_expire_date' => $this->faker->optional()->date(),
            'body_style_id' => \App\Models\BodyStyle::inRandomOrder()->first()->id,  // جلب نوع الهيكل عشوائيًا
            'type_id' => \App\Models\Type::inRandomOrder()->first()->id,  // جلب نوع السيارة عشوائيًا
            'fuel_economy_id' => \App\Models\FuelEconomy::factory(),
            'transmission_type_id' => \App\Models\TransmissionType::inRandomOrder()->first()->id,  // جلب نوع ناقل الحركة عشوائيًا
            'drive_type_id' => \App\Models\DriveType::inRandomOrder()->first()->id,  // جلب نوع الدفع عشوائيًا
            'engine_type_id' => \App\Models\EngineType::inRandomOrder()->first()->id,  // جلب نوع المحرك عشوائيًا
            'engine_capacity_cc' => $this->faker->numberBetween(1000, 5000),
            'color' => $this->faker->safeColorName(),
            'size_id' => \App\Models\Size::factory(),
            'mileage' => $this->faker->numberBetween(0, 300000),
            'horsepower_id' => \App\Models\Horsepower::factory(),
            'vehicle_status_id' => \App\Models\VehicleStatus::inRandomOrder()->first()->id,  // جلب حالة السيارة عشوائيًا
            'refurbishment_status' => $this->faker->randomElement([
                [
                    'en' => 'empty',
                    'ar' => 'empty'
                ],
                [
                    'en' => 'limited_offer',
                    'ar' => 'limited_offer'
                ],
                [
                    'en' => 'fully_refurbished',
                    'ar' => 'fully_refurbished'
                ],
                [
                    'en' => 'certified_refurbished',
                    'ar' => 'certified_refurbished'
                ],
            ]),

            'trim_id' => \App\Models\Trim::inRandomOrder()->first()->id,  // جلب نوع التريم عشوائيًا
            'owner_id' => \App\Models\User::inRandomOrder()->first()->id,  // جلب مالك السيارة عشوائيًا
        ];
    }

}
