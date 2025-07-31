<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class TypeFactory extends Factory
{
    public static $vehicleTypes = [
        'Sedan',
        'SUV',
        'Truck',
        'Coupe',
        'Convertible',
        'Hatchback',
        'Minivan',
        'Van',
        'Crossover',
        'Wagon',
        'Pickup',
        'Electric',
        'Hybrid'
    ];

    public function definition(): array
    {
        return [
            'name' => $this->faker->randomElement(self::$vehicleTypes),
        ];
    }
}
