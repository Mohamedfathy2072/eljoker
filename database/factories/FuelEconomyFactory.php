<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class FuelEconomyFactory extends Factory
{
    public function definition(): array
    {
        return [
            'min' => $this->faker->randomFloat(2, 5, 20),
            'max' => $this->faker->randomFloat(2, 5, 20)
        ];
    }
}
