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
        // Now seed cars
        Car::factory(15)->create();
    }
}
