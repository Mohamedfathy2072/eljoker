<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Brand;
use App\Models\CarModel;
use App\Models\BodyStyle;
use App\Models\Type;
use App\Models\TransmissionType;
use App\Models\DriveType;
use App\Models\EngineType;
use App\Models\Trim;
use App\Models\VehicleStatus;

use Database\Factories\BrandFactory;
use Database\Factories\CarModelFactory;
use Database\Factories\BodyStyleFactory;
use Database\Factories\TypeFactory;
use Database\Factories\TransmissionTypeFactory;
use Database\Factories\DriveTypeFactory;
use Database\Factories\EngineTypeFactory;
use Database\Factories\TrimFactory;
use Database\Factories\VehicleStatusFactory;

class LookupSeeder extends Seeder
{
    public function run(): void
    {
        foreach (BrandFactory::$brands as $item) {
            Brand::firstOrCreate(['name' => $item]);
        }

        foreach (CarModelFactory::$carModels as $item) {
            CarModel::firstOrCreate(['name' => $item]);
        }

        foreach (BodyStyleFactory::$bodyStyles as $item) {
            BodyStyle::firstOrCreate(['name' => $item]);
        }

        foreach (TypeFactory::$vehicleTypes as $item) {
            Type::firstOrCreate(['name' => $item]);
        }

        foreach (TransmissionTypeFactory::$transmissionTypes as $item) {
            TransmissionType::firstOrCreate(['name' => $item]);
        }

        foreach (DriveTypeFactory::$models as $item) {
            DriveType::firstOrCreate(['name' => $item]);
        }

        foreach (EngineTypeFactory::$engineTypes as $item) {
            EngineType::firstOrCreate(['name' => $item]);
        }

        foreach (TrimFactory::$trims as $item) {
            Trim::firstOrCreate(['name' => $item]);
        }

        foreach (VehicleStatusFactory::$statuses as $item) {
            VehicleStatus::firstOrCreate(['name' => $item]);
        }
    }
}
