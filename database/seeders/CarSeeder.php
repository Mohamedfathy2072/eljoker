<?php

namespace Database\Seeders;

use App\Models\Car;
use Database\Factories\BodyStyleFactory;
use Database\Factories\BrandFactory;
use Database\Factories\CarModelFactory;
use Database\Factories\DriveTypeFactory;
use Database\Factories\EngineTypeFactory;
use Database\Factories\TransmissionTypeFactory;
use Database\Factories\TrimFactory;
use Database\Factories\TypeFactory;
use Database\Factories\VehicleStatusFactory;
use Faker\Factory;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;

class CarSeeder extends Seeder
{
    public function run(): void
    {
        $faker = Faker::create();

        $imageFiles = collect(range(1, 10))->map(fn($i) => "cars/{$i}.png");

        Car::factory(15)->create()->each(function (Car $car) use ($imageFiles, $faker) {
            $assignedImages = $imageFiles->random(rand(3, 6));
            foreach ($assignedImages as $imgPath) {
                $car->images()->create([
                    'location' => $imgPath,
                ]);
            }

            for ($i = 0; $i < rand(1, 3); $i++) {
                $car->flags()->create([
                    'value' => $faker->words(2, true),
                    'image' => $imageFiles->random(),
                ]);
            }

            $featureGroups = ['safety', 'performance', 'dimensions_capacity', 'comfort_convenience', 'entertainment_communication', 'interiors', 'exteriors'];
            foreach ($faker->randomElements($featureGroups, rand(1, 2)) as $group) {
                for ($i = 0; $i < rand(2, 3); $i++) {
                    $car->features()->create([
                        'name' => $group,
                        'label' => ucfirst($faker->word),
                        'value' => $faker->sentence(2),
                    ]);
                }
            }

            $conditionTypes = [
                [
                    'en' => 'mechanical_condition',
                    'ar' => 'حالة الميكانيكية'
                ],
                [
                    'en' => 'exterior_condition',
                    'ar' => 'حالة الهيكل الخارجي'
                ],
                [
                    'en' => 'interior_condition',
                    'ar' => 'حالة التجهيزات الداخلية'
                ]
            ];

            $conditionParts = [
                'engine' => 'المحرك',
                'transmission' => 'ناقل الحركة',
                'brakes' => 'المكابح',
                'suspension' => 'التعليق',
                'electrical' => 'نظام الكهرباء'
            ];

            $conditionDescriptions = [
                'en' => [
                    'Minor wear and tear, functions normally',
                    'Good condition with regular maintenance',
                    'Some signs of use but in working order',
                    'Recently serviced, excellent condition',
                    'Requires attention soon'
                ],
                'ar' => [
                    'بسيط البلى والتلف، يعمل بشكل طبيعي',
                    'حالة جيدة مع صيانة دورية',
                    'بعض علامات الاستخدام ولكن في حالة عمل جيدة',
                    'تم صيانته مؤخراً، بحالة ممتازة',
                    'يتطلب الاهتمام قريباً'
                ]
            ];

            foreach ($faker->randomElements($conditionTypes, rand(1, 2)) as $condType) {
                $part = $faker->randomElement(array_keys($conditionParts));
                $car->conditions()->create([
                    'name' => [
                        'en' => $condType['en'],
                        'ar' => $condType['ar']
                    ],
                    'part' => [
                        'en' => $part,
                        'ar' => $conditionParts[$part]
                    ],
                    'description' => [
                        'en' => $faker->optional(0.8)->randomElement($conditionDescriptions['en']),
                        'ar' => $faker->optional(0.8)->randomElement($conditionDescriptions['ar'])
                    ],
                    'image' => $imageFiles->random(),
                ]);
            }
        });
    }
}
