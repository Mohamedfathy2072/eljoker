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
            'Corolla' => ['Toyota', 'brands/Toyota.png'],
            'Civic' => ['Honda', 'brands/Honda.png'],
            'Mustang' => ['Ford', 'brands/Ford.png'],
            'Camaro' => ['Chevrolet', 'brands/Chevrolet.png'],
            'Tucson' => ['Hyundai', 'brands/Hyundai.png'],
            'Model 3' => ['Tesla', 'brands/Tesla.png'],
            'CX-5' => ['Mazda', 'brands/Mazda.png'],
            'Altima' => ['Nissan', 'brands/Nissan.png'],
            'X5' => ['BMW', 'brands/BMW.png'],
            'A4' => ['Audi', 'brands/Audi.png'],
            'Wrangler' => ['Jeep', 'brands/Jeep.png'],
            'Golf' => ['Volkswagen', 'brands/Volkswagen.png'],
            '500' => ['Fiat', 'brands/Fiat.png'],
            'Clio' => ['Renault', 'brands/Renault.png'],
            'Mitsubishi Outlander' => ['Mitsubishi', 'brands/Mitsubishi.png'],
            'Skoda' => ['Skoda', 'brands/Skoda.png'],
            'Seat' => ['Seat', 'brands/Seat.png'],
            'Peugeot' => ['Peugeot', 'brands/Peugeot.png'],
            'MG' => ['MG', 'brands/MG.png'],
            'Kia' => ['Kia', 'brands/Kia.png'],
            'Citroen' => ['Citroen', 'brands/Citroen.png']
        ];

        $brandIds = [];

        // Create brands if they don't exist, or update image if necessary
        foreach ($carModelBrandMap as $modelName => [$brandName, $brandImage]) {
            $brand = Brand::firstOrCreate(
                ['name' => $brandName],  // Only check for the name
                ['image' => $brandImage] // Create with image if not exists
            );

            // If the brand exists but the image is different, update it
            if ($brand->image !== $brandImage) {
                $brand->update(['image' => $brandImage]);
            }

            // Store brand ID
            $brandIds[$brandName] = $brand->id;
        }

        // Create car models with the corresponding brand_id
        foreach ($carModelBrandMap as $modelName => [$brandName, $brandImage]) {
            CarModel::firstOrCreate([
                'name' => $modelName,
                'brand_id' => $brandIds[$brandName],
            ]);
        }
    }
}
