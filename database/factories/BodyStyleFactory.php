<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class BodyStyleFactory extends Factory
{
    public static $bodyStyles = [
        'Sedan', 'Hatchback', 'SUV', 'Coupe', 'Convertible',
        'Wagon', 'Pickup Truck', 'Van', 'Crossover', 'Minivan'
    ];

    public function definition(): array
    {
        return [
            'name' => $this->faker->randomElement(self::$bodyStyles),
        ];
    }
}
