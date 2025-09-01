<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Brand>
 */
class BrandFactory extends Factory
{
    public static array $brands = [
        ['en' => 'Toyota', 'ar' => 'تويوتا'],
        ['en' => 'Honda', 'ar' => 'هوندا'],
        ['en' => 'Ford', 'ar' => 'فورد'],
        ['en' => 'Chevrolet', 'ar' => 'شفروليه'],
        ['en' => 'BMW', 'ar' => 'بي ام دبليو'],
        ['en' => 'Mercedes-Benz', 'ar' => 'مرسيدس بنز'],
        ['en' => 'Nissan', 'ar' => 'نيسان'],
        ['en' => 'Hyundai', 'ar' => 'هيونداي'],
        ['en' => 'Kia', 'ar' => 'كيا'],
        ['en' => 'Volkswagen', 'ar' => 'فولكس فاجن'],
        ['en' => 'Audi', 'ar' => 'أودي'],
        ['en' => 'Lexus', 'ar' => 'لكزس'],
        ['en' => 'Mazda', 'ar' => 'مازدا'],
        ['en' => 'Subaru', 'ar' => 'سوبارو'],
        ['en' => 'Tesla', 'ar' => 'تسلا'],
        ['en' => 'Porsche', 'ar' => 'بورش'],
        ['en' => 'Jeep', 'ar' => 'جيب'],
        ['en' => 'Renault', 'ar' => 'رينو'],
        ['en' => 'Peugeot', 'ar' => 'بيجو'],
        ['en' => 'Fiat', 'ar' => 'فيات']
    ];

    public function definition(): array
    {
        $brand = $this->faker->randomElement(self::$brands);
        
        return [
            'name' => [
                'en' => $brand['en'],
                'ar' => $brand['ar']
            ],
            'image' => 'brands/' . strtolower($brand['en']) . '.png',
        ];
    }
}
