<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class VehicleStatusFactory extends Factory
{
    public static $statuses = [
        'New',
        'Used',
        'Certified Pre-Owned',
        'Salvage',
        'Damaged',
        'For Parts',
        'Rebuilt',
        'Refurbished',
        'Leased',
        'Export Only'
    ];

    public function definition(): array
    {
        return [
            'name' => $this->faker->randomElement(self::$statuses),
        ];
    }
}
