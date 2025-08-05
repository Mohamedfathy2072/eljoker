<?php

namespace Database\Seeders;

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
use Illuminate\Database\Seeder;
use App\Models\Car;

class CarSeeder extends Seeder
{
    public function run(): void
    {
        $faker = Faker::create();

        // الصور الثابتة
        $imageFiles = collect(range(1, 10))->map(fn($i) => "cars/{$i}.png");

        Car::factory(15)->create()->each(function (Car $car) use ($imageFiles, $faker) {
            // ✅ صور السيارة
            $assignedImages = $imageFiles->random(rand(3, 6));
            foreach ($assignedImages as $imgPath) {
                $car->images()->create([
                    'location' => $imgPath,
                ]);
            }

            // ✅ Flags (1 to 3)
            for ($i = 0; $i < rand(1, 3); $i++) {
                $car->flags()->create([
                    'value' => $faker->words(2, true),
                    'image' => $imageFiles->random(),
                ]);
            }

            // ✅ Features (2 groups × 2-3 items per group)
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

            // ✅ Conditions (1–3 per car)
            $conditionTypes = ['mechanical_condition', 'exterior_condition', 'interior_condition'];
            foreach ($faker->randomElements($conditionTypes, rand(1, 2)) as $condType) {
                $car->conditions()->create([
                    'name' => $condType,
                    'part' => $faker->word,
                    'description' => $faker->optional()->sentence(6),
                    'image' => $imageFiles->random(),
                ]);
            }
        });
    }
}
