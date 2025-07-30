<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class SizeFactory extends Factory
{
    public function definition(): array
    {
        return [
            'length' => $this->faker->numberBetween(3000, 6000),
            'width' => $this->faker->numberBetween(1500, 2500),
            'height' => $this->faker->numberBetween(1200, 2000),
        ];
    }
}
