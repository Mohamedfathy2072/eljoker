<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class TransmissionTypeFactory extends Factory
{
    public static $transmissionTypes = [
        'Manual',
        'Automatic',
        'CVT',                     // Continuously Variable Transmission
        'Dual-Clutch',
        'Tiptronic',
        'Semi-Automatic',
        'Direct Shift Gearbox (DSG)',
        'Sequential Manual',
        'Automated Manual'
    ];

    public function definition(): array
    {
        return [
            'name' => $this->faker->randomElement(self::$transmissionTypes),
        ];
    }
}
