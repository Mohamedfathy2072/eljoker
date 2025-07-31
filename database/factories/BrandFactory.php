<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Brand>
 */
class BrandFactory extends Factory
{
    public static $brands = [
        'Toyota', 'Honda', 'Ford', 'Chevrolet', 'BMW',
        'Mercedes-Benz', 'Nissan', 'Hyundai', 'Kia', 'Volkswagen',
        'Audi', 'Lexus', 'Mazda', 'Subaru', 'Tesla',
        'Porsche', 'Jeep', 'Renault', 'Peugeot', 'Fiat'
    ];

    public function definition(): array
    {
        return [
            'name' => $this->faker->randomElement(self::$brands),
        ];
    }
}
