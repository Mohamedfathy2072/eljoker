<?php

namespace App\Repositories;

use App\Http\Resources\CarResource;
use App\Interfaces\CarRepositoryInterface;
use App\Models\Car;
use App\Models\Flag;
use App\Models\FuelEconomy;
use App\Models\Horsepower;
use App\Models\Size;

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
            // $query->where('body_style_id', 'like', "%{$search}%")
            //     ->orWhere('car_model_id', 'like',  "%{$search}%")
            //     ->orWhere('brand_id', 'like',  "%{$search}%");
            unset($requestData['search']);
        }

        if (isset($requestData['min_price'])) {
            $query->where('price', '>=', $requestData['min_price']);
            unset($requestData['min_price']);
        }
        if (isset($requestData['max_price'])) {
            $query->where('price', '<=', $requestData['max_price']);
            unset($requestData['max_price']);
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
        // dd($carData);
        // length, width, height => insert in table sizes
        // min max fuel economy => insert in table fuel_economies
        // min max horsepower insert in table horsepower
        $size = Size::create([
            'length' => (int) $carData['length'],
            'width' => (int) $carData['width'],
            'height' => (int) $carData['height'],
        ]);
        $fuel = FuelEconomy::create([
            'min' => (int) $carData['min_fuel_economy'],
            'max' => (int) $carData['max_fuel_economy'],
        ]);
        $horsepower = Horsepower::create([
            'min' => (int) $carData['min_horse_power'],
            'max' => (int) $carData['max_horse_power'],
        ]);

        // brand, model, model_year,license_expiry_date
        // body_style, type, transmission_type, drive_type, color,
        // engine_type, engine_capacity_cc, mileage,
        // vehicle_status, refurbishment_status, price, discount, monthly_installment, trim
        // make new car
        $carDetails = [
            'brand_id' => (int) $carData['brand'],
            'car_model_id' => (int) $carData['model'],
            'model_year' => (int) $carData['model_year'],
            'license_expire_date' => $carData['license_expire_date'],
            'body_style_id' => (int) $carData['body_style'],
            'type_id' => (int) $carData['type'],
            'transmission_type_id' => (int) $carData['transmission_type'],
            'drive_type_id' => (int) $carData['drive_type'],
            'color' => $carData['color'],
            'engine_type_id' => (int) $carData['engine_type'],
            'engine_capacity_cc' => (int) $carData['engine_capacity'],
            'mileage' => (int) $carData['mileage'],
            'size_id' => (int) $size['id'],
            'fuel_economy_id' => (int) $fuel['id'],
            'horsepower_id' => (int) $horsepower['id'],
            'vehicle_status_id' => (int) $carData['vehicle_status'],
            'refurbishment_status' => $carData['refurbishment_status'],
            'price' => (float) $carData['price'],
            'discount' => (float) $carData['discount'],
            'monthly_installment' => (float) $carData['monthly_installment'],
            'trim_id' => (int) $carData['trim'],
        ];

        $newCar = Car::create($carDetails);

        // make new flags, features, conditions for the car
        foreach ($carData['flags'] as $flag) {
            if(empty($flag)) continue;
            $newCar->flags()->create([
                'car_id' => $newCar->id,
                'value' => $flag,
            ]);
        }

        for ($i=0; $i < count($carData['features']); $i+=3) {
            if(empty($carData['features'][$i])) continue;
            $feature = [
                'car_id' => $newCar->id,
                'name' => $carData['features'][$i]['name'],
                'label' => $carData['features'][$i + 1]['label'] ?? '',
                'value' => $carData['features'][$i + 2]['value'] ?? '',
            ];
            $newCar->features()->create($feature);
        }

        for ($i=0; $i < count($carData['conditions']); $i+=3) {
            if(empty($carData['name'][$i])) continue;
            $condition = [
                'car_id' => $newCar->id,
                'name' => $carData['name'][$i]['name'],
                'part' => $carData['features'][$i + 1]['part'] ?? '',
                'description' => $carData['features'][$i + 2]['description'] ?? '',
            ];
            $newCar->conditions()->create($condition);
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
                'path' => $path,
            ]);
            }
        }
        dd($newCar);
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
}
