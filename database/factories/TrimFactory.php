<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class TrimFactory extends Factory
{
    public static $trims = [
        'Base', 'LE', 'SE', 'XLE', 'XSE',
        'Sport', 'Limited', 'Touring', 'EX', 'LX',
        'Premium', 'Platinum', 'SL', 'SR', 'Titanium',
        'Lariat', 'Z71', 'Denali', 'TRD Off-Road', 'Black Edition'
    ];

    public function definition(): array
    {
        return [
            'name' => $this->faker->randomElement(self::$trims),
        ];
    }
}
