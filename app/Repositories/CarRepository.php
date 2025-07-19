<?php

namespace App\Repositories;

use App\Http\Resources\CarResource;
use App\Interfaces\CarRepositoryInterface;
use App\Models\Car;

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
            $query->where('body_style', 'like', "%{$search}%")
                ->orWhere('model', 'like',  "%{$search}%")
                ->orWhere('brand', 'like',  "%{$search}%");
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
        $newCar = Car::create($carData);
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
