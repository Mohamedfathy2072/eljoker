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
        $this->seedBrandsModels();

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

    public function seedBrandsModels()
    {

        $carModelBrandMap = [
            'Corolla' => 'Toyota',
            'Civic' => 'Honda',
            'Mustang' => 'Ford',
            'Camaro' => 'Chevrolet',
            '3 Series' => 'BMW',
            'Accord' => 'Honda',
            'Elantra' => 'Hyundai',
            'Tucson' => 'Hyundai',
            'Model 3' => 'Tesla',
            'CX-5' => 'Mazda',
            'Altima' => 'Nissan',
            'RAV4' => 'Toyota',
            'Explorer' => 'Ford',
            'X5' => 'BMW',
            'A4' => 'Audi',
            'Cherokee' => 'Jeep',
            'Wrangler' => 'Jeep',
            'Golf' => 'Volkswagen',
            'Clio' => 'Renault',
            '500' => 'Fiat',
        ];

        $brandIds = [];
        foreach (array_unique(array_values($carModelBrandMap)) as $brandName) {
            $brand = Brand::firstOrCreate(['name' => $brandName]);
            $brandIds[$brandName] = $brand->id;
        }

        foreach ($carModelBrandMap as $modelName => $brandName) {
            CarModel::firstOrCreate([
                'name' => $modelName,
                'brand_id' => $brandIds[$brandName],
            ]);
        }
    }
}
