<?php

namespace App\Http\Controllers;

use App\Enums\Condition;
use App\Enums\Feature;
use App\Enums\RefurbishmentStatus;
use App\Http\Requests\CreateCarRequest;
use App\Http\Requests\PaginatedCarsRequest;
use App\Http\Requests\UpdateCarRequest;
use App\Models\BodyStyle;
use App\Models\Brand;
use App\Models\CarModel;
use App\Models\DriveType;
use App\Models\EngineType;
use App\Models\TransmissionType;
use App\Models\Trim;
use App\Models\Type;
use App\Models\VehicleStatus;
use App\Services\CarService;

class CarController extends Controller
{
    public function __construct(private CarService $carService)
    {
        // Middleware or other initializations can be done here
    }

    public function store(CreateCarRequest $request)
    {
        try {
            $carData = $request->validated();
            $newCar = $this->carService->addNewCar($carData);
            dd($newCar);
            return response()->json(['message' => 'Car created', 'data' => $newCar]);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Error creating car', 'error' => $e->getMessage()], 500);
        }
    }


    public function all()
    {
        try {
            $cars = $this->carService->all();
            $count = $this->carService->getCount();
            return response()->json(['message' => 'All cars fetched successfully', 'data' => $cars, 'count' => $count]);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Error fetching cars', 'error' => $e->getMessage()], 500);
        }
    }

    public function pagination(PaginatedCarsRequest $request, ?string $sort_direction='asc', ?string $sort_by='created_at', ?int $page=1, ?int $per_page=20)
    {
        try {
            $cars = $this->carService->paginateCars($request->validated(), $sort_direction, $sort_by, $page, $per_page);
            return response()->json(['message' => 'Cars fetched successfully', 'data' => $cars['data'], 'count' => $cars['count']]);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Error fetching cars', 'error' => $e->getMessage()], 500);
        }
    }

    public function findById(int $id)
    {
        try {
            $car = $this->carService->getCarDetails($id);
            return response()->json(['message' => 'Car fetched successfully', 'data' => $car]);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Error fetching car', 'error' => $e->getMessage()], 500);
        }
    }

    public function create(CreateCarRequest $request)
    {
        try {
            $carData = $request->validated();
            $newCar = $this->carService->addNewCar($carData);
            return response()->json(['message' => 'Car created', 'data' => $newCar]);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Error creating car', 'error' => $e->getMessage()], 500);
        }
    }

    public function update(int $id, UpdateCarRequest $request)
    {
        try {
            $updatedCarData = $request->validated();
            $updatedCar = $this->carService->updateCar($id, $updatedCarData);
            return response()->json(['message' => 'Car updated', 'id' => $id, 'data' => $updatedCar]);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Error creating car', 'error' => $e->getMessage()], 500);
        }
    }

    public function delete(int $id)
    {
        try {
            $this->carService->deleteCar($id);
            return response()->json(['message' => 'Car deleted successfully', 'id' => $id]);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Error deleting car', 'error' => $e->getMessage()], 500);
        }
    }

    public function add()
    {
        // get brand list for the dropdown
        $brands = Brand::all();
        $carModels = CarModel::all();
        $bodyStyles = BodyStyle::all();
        $types = Type::all();
        $transmissionTypes = TransmissionType::all();
        $driveTypes = DriveType::all();
        $engineTypes = EngineType::all();
        $vehicleStatuses = VehicleStatus::all();
        $refurbishmentStatuses = RefurbishmentStatus::cases();
        $trim = Trim::all();
        $features = Feature::cases();
        $conditions = Condition::cases();
        return view('pages.addCar', [
            'brands' => $brands,
            'carModels' => $carModels,
            'bodyStyles' => $bodyStyles,
            'types' => $types,
            'transmissionTypes' => $transmissionTypes,
            'driveTypes' => $driveTypes,
            'engineTypes' => $engineTypes,
            'vehicleStatuses' => $vehicleStatuses,
            'refurbishmentStatuses' => $refurbishmentStatuses,
            'trim' => $trim,
            'features' => $features,
            'conditions' => $conditions
        ]);
    }
}
