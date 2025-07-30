<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Car;

class CarSeeder extends Seeder
{
    public function run(): void
    {
        // Seed related tables first
        $brands = \App\Models\Brand::factory(5)->create();
        $carModels = \App\Models\CarModel::factory(10)->create();
        $bodyStyles = \App\Models\BodyStyle::factory(5)->create();
        $types = \App\Models\Type::factory(5)->create();
        $transmissions = \App\Models\TransmissionType::factory(3)->create();
        $drives = \App\Models\DriveType::factory(3)->create();
        $engines = \App\Models\EngineType::factory(3)->create();
        $trims = \App\Models\Trim::factory(5)->create();
        $statuses = \App\Models\VehicleStatus::factory(3)->create();

        // Now seed cars
        Car::factory(10)->create();
    }
}
