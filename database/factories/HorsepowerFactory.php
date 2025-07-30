<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class HorsepowerFactory extends Factory
{
    public function definition(): array
    {
        return [
            'min' => $this->faker->numberBetween(50, 800),
            'max' => $this->faker->numberBetween(50, 800),
        ];
    }
}
