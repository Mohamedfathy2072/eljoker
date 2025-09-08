<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class BodyStyleFactory extends Factory
{
    public static $bodyStyles = [
        'Sedan', 'SUV', 'Truck', 'Van', 'Coupe', 'Hatchback', 'Convertible', 'Wagon', 'Minivan', 'Pickup'
    ];

    public function definition(): array
    {
        $name = $this->faker->unique()->randomElement(self::$bodyStyles);
        
        return [
            'name' => [
                'ar' => $name . ' (ar)',
                'en' => $name
            ],
            'image' => 'body_style/' . $this->faker->image(storage_path('app/public/body_style'), 400, 300, null, false),
        ];
    }
}
