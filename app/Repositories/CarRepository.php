<?php

namespace App\Repositories;

use App\Http\Resources\CarResource;
use App\Interfaces\CarRepositoryInterface;
use App\Models\Brand;
use App\Models\Car;
use App\Models\CarModel;
use App\Models\Condition;
use App\Models\Flag;
use App\Models\FuelEconomy;
use App\Models\Horsepower;
use App\Models\Size;
use App\Models\VehicleStatus;
use Illuminate\Database\Eloquent\Model;

class CarRepository implements CarRepositoryInterface
{
    // This class will handle database interactions for cars

    public function all()
    {
        $cars = Car::all();
        return CarResource::collection($cars);
    }

    public function paginate(array $requestData, string $sort_direction, string $sort_by, int $page, int $per_page)
    {
        $query = Car::query();

        $search = $requestData['search'] ?? '';
        if (!empty($requestData['search'])) {
            $brand = Brand::where('name', 'like', "%{$search}%")->first();
            $model = CarModel::where('name', 'like', "%{$search}%")->first();
            if (!empty($brand)) {
                $query->where('brand_id', $brand->id);
            }
            if (!empty($model)) {
                $query->where('car_model_id', $model->id);
            }
        }

        if (!empty($requestData['price_range'])) {
            if(!empty($requestData['price_range'][0]))
                $query->where('price', '>=', $requestData['price_range'][0]);
            if(!empty($requestData['price_range'][1]))
                $query->where('price', '<=', $requestData['price_range'][1]);
        }


        if (!empty($requestData['engine_capacity_cc'])) {
            if(!empty($requestData['engine_capacity_cc'][0]))
                $query->where('engine_capacity_cc', '>=', $requestData['engine_capacity_cc'][0]);
            if(!empty($requestData['engine_capacity_cc'][1]))
                $query->where('engine_capacity_cc', '<=', $requestData['engine_capacity_cc'][1]);
        }

        // 🔍 Filter by fuel economy range
        if (!empty($requestData['fuel_economy']['min']) && !empty($requestData['fuel_economy']['max'])) {
            $fuelMin = $requestData['fuel_economy']['min'];
            $fuelMax = $requestData['fuel_economy']['max'];

            // Join with fuel_economies table
            $query->whereHas('fuelEconomy', function ($q) use ($fuelMin, $fuelMax) {
                $q->where('min', '<=', $fuelMin)
                    ->where('max', '>=', $fuelMax);
            });
        }


        if (!empty($requestData['brand_ids'])) {
            $query->whereIn('brand_id', $requestData['brand_ids']);
        }

        if (!empty($requestData['body_style_ids'])) {
            $query->whereIn('body_style_id', $requestData['body_style_ids']);
        }

        if (!empty($requestData['vehicle_status'])) {
            $vehicleId = $this->getVehicleId($requestData['vehicle_status']);
            if ($vehicleId !== null) {
                $query->where('vehicle_status_id', $vehicleId);
            } else {
                throw new \Exception("Vehicle status not found for '{$requestData['vehicle_status']}'");
            }
        }


        foreach (['search', 'price_range', 'engine_capacity_cc', 'fuel_economy', 'brand_ids', 'body_style_ids', 'vehicle_status'] as $key) {
            unset($requestData[$key]);
        }

        foreach ($requestData as $key => $value) {
            $query->where($key, $value);
        }

        $count = (clone $query)->count();

        $cars = $query->orderBy($sort_by, $sort_direction)
                    ->paginate($per_page, ['*'], 'page', $page);

        return ['data' => CarResource::collection($cars), 'count' => $count];
    }

    public function get($carId)
    {
        $car = Car::findOrFail($carId);
        return new CarResource($car);
    }

    public function insert(array $carData)
    {
        // length, width, height => insert in table sizes
        // min max fuel economy => insert in table fuel_economies
        // min max horsepower insert in table horsepower
        $size = (!empty($carData['length']) && !empty($carData['width']) && !empty($carData['height'])) ? Size::create([
            'length' => (int) $carData['length'],
            'width' => (int) $carData['width'],
            'height' => (int) $carData['height'],
        ]) : null;
        $fuel = (!empty($carData['min_fuel_economy']) && !empty($carData['max_fuel_economy'])) ? FuelEconomy::create([
            'min' => (int) $carData['min_fuel_economy'],
            'max' => (int) $carData['max_fuel_economy'],
        ]) : null;
        $horsepower = (!empty($carData['min_horse_power']) && !empty($carData['max_horse_power'])) ? Horsepower::create([
            'min' => (int) $carData['min_horse_power'],
            'max' => (int) $carData['max_horse_power'],
        ]) : null;

        // brand, model, model_year,license_expiry_date
        // body_style, type, transmission_type, drive_type, color,
        // engine_type, engine_capacity_cc, mileage,
        // vehicle_status, refurbishment_status, price, discount, monthly_installment, trim
        // make new car
        $carDetails = [
            'brand_id'              => !empty($carData['brand']) ? (int) $carData['brand'] : null,
            'car_model_id'          => !empty($carData['model']) ? (int) $carData['model'] : null,
            'model_year'            => !empty($carData['model_year']) ? (int) $carData['model_year'] : null,
            'license_expire_date'   => $carData['license_expire_date'] ?? null,
            'body_style_id'         => !empty($carData['body_style']) ? (int) $carData['body_style'] : null,
            'type_id'               => !empty($carData['type']) ? (int) $carData['type'] : null,
            'transmission_type_id'  => !empty($carData['transmission_type']) ? (int) $carData['transmission_type'] : null,
            'drive_type_id'         => !empty($carData['drive_type']) ? (int) $carData['drive_type'] : null,
            'color'                 => $carData['color'] ?? null,
            'engine_type_id'        => !empty($carData['engine_type']) ? (int) $carData['engine_type'] : null,
            'engine_capacity_cc'    => !empty($carData['engine_capacity']) ? (int) $carData['engine_capacity'] : null,
            'mileage'               => !empty($carData['mileage']) ? (int) $carData['mileage'] : null,
            'size_id'               => $size?->id,
            'fuel_economy_id'       => $fuel?->id,
            'horsepower_id'         => $horsepower?->id,
            'vehicle_status_id'     => !empty($carData['vehicle_status']) ? (int) $carData['vehicle_status'] : null,
            'refurbishment_status'  => $carData['refurbishment_status'] ?? 'empty',
            'price'                 => isset($carData['price']) ? (float) $carData['price'] : 0,
            'discount'              => isset($carData['discount']) ? (float) $carData['discount'] : 0,
            'monthly_installment'   => isset($carData['monthly_installment']) ? (float) $carData['monthly_installment'] : null,
            'trim_id'               => !empty($carData['trim']) ? (int) $carData['trim'] : null,
        ];

        $newCar = Car::create($carDetails);

        // make new flags, features, conditions for the car
        foreach ($carData['flags'] as $flag) {
            if(empty($flag) || empty($flag['name'])) continue;
            $path = null;
            if(!empty($flag['image']))
                $path = $flag['image']->store('flags', 'public');
            $newCar->flags()->create([
                'car_id' => $newCar->id,
                'value' => $flag['name'],
                'image' => $path
            ]);
        }

        for ($i=0; $i < count($carData['features']); $i+=3) {
            if(empty($carData['features'][$i]['name'])) continue;
            $feature = [
                'car_id' => $newCar->id,
                'name' => $carData['features'][$i]['name'],
                'label' => $carData['features'][$i + 1]['label'] ?? '',
                'value' => $carData['features'][$i + 2]['value'] ?? '',
            ];
            $newCar->features()->create($feature);
        }

        foreach ($carData['conditions'] as $cond) {
            if(empty($cond) || empty($cond['name'])) continue;
            $path = null;
            if(!empty($cond['image']))
                $path = $cond['image']->store('conditions', 'public');
            $newCar->conditions()->create([
                'car_id' => $newCar->id,
                'name' => $cond['name'],
                'part' => $cond['part'] ?? '',
                'description' => $cond['description'] ?? '',
                'image' => $path
            ]);
        }

        // if has images save images and save its location
        if (!empty($carData['images']) && is_array($carData['images'])) {
            foreach ($carData['images'] as $img) {
            if (!$img) continue;
            // Store image in 'public/cars' directory
            $path = $img->store('cars', 'public');

            // Save image path in images table
            $newCar->images()->create([
                'car_id' => $newCar->id,
                'location' => $path,
            ]);
            }
        }
        return new CarResource($newCar);
    }

    public function update($carId, $carData)
    {
        $car = Car::findOrFail($carId);
        $car->update($carData);
        return new CarResource($car);
    }

    public function delete($carId)
    {
        $car = Car::findOrFail($carId);
        $car->delete();
    }

    public function getCount()
    {
        return Car::count();
    }

    public function getVehicleId(string $name): ?int
    {
        $vehicle = VehicleStatus::where('name', 'like', "%{$name}%")->first();
        return $vehicle?->id;
    }
}
