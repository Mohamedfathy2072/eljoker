<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class EngineTypeFactory extends Factory
{
    public static $engineTypes = [
        'Petrol', 'Diesel', 'Electric', 'Hybrid', 'Plug-in Hybrid',
        'Hydrogen Fuel Cell', 'Compressed Natural Gas (CNG)',
        'Liquefied Petroleum Gas (LPG)', 'Flex-Fuel', 'Turbocharged'
    ];

    public function definition(): array
    {
        return [
            'name' => $this->faker->randomElement(self::$engineTypes),
        ];
    }
}
