<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class CarModelFactory extends Factory
{
    public static $carModels = [
        'Corolla', 'Civic', 'Mustang', 'Camaro', '3 Series',
        'Accord', 'Elantra', 'Tucson', 'Model 3', 'CX-5',
        'Altima', 'RAV4', 'Explorer', 'X5', 'A4',
        'Cherokee', 'Wrangler', 'Golf', 'Clio', '500'
    ];

    public function definition(): array
    {
        return [
            'name' => $this->faker->randomElement(self::$carModels),
        ];
    }
}
