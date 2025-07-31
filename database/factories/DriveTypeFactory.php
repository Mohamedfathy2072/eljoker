<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class DriveTypeFactory extends Factory
{
    public static $models = [
        'Corolla', 'Civic', 'Accord', 'Camry', 'Mustang',
        'Model S', 'Model 3', 'CX-5', 'RAV4', 'Altima',
        'Elantra', 'Tucson', 'Sentra', 'X5', 'Q5',
        'A4', 'Golf', 'Wrangler', 'Cherokee', '500'
    ];

    public function definition(): array
    {
        return [
            'name' => $this->faker->randomElement(self::$models),
        ];
    }
}
