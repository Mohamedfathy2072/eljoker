<?php

namespace App\Http\Controllers;

use App\Enums\Condition;
use App\Enums\Feature;
use App\Enums\RefurbishmentStatus;
use App\Http\Requests\CreateCarRequest;
use App\Http\Requests\PaginatedCarsRequest;
use App\Http\Requests\UpdateCarRequest;
use App\Http\Resources\CarResource;
use App\Models\BodyStyle;
use App\Models\Brand;
use App\Models\Car;
use App\Models\CarModel;
use App\Models\DriveType;
use App\Models\EngineType;
use App\Models\TransmissionType;
use App\Models\Trim;
use App\Models\Type;
use App\Models\VehicleStatus;
use App\Services\CarService;
use http\Env\Request;

class CarController extends Controller
{
    public function __construct(private CarService $carService)
    {
        // Middleware or other initializations can be done here
    }

    public function store(CreateCarRequest $request)
    {
        $carData = $request->validated();
        try {
            $newCar = $this->carService->addNewCar($carData);
            return redirect()->route('admin.car.show', $newCar->id);
        } catch (\Exception $e) {
            return redirect()->back()->with(['message' => 'Error creating car', 'error' => $e->getMessage()])->withInput();
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

    public function edit(int $id)
    {
        $car = $this->carService->getCarDetails($id);
        $data = $this->getDropDownData() + ['car' => $this->toRecursiveArray($car)];
        return view('pages.editCar', $data);
    }


    public function update(int $id, \Illuminate\Http\Request $request)
    {
        dd($request->all());
        try {
            $updatedCarData = $request->validated();
            $updatedCar = $this->carService->updateCar($id, $updatedCarData);
            return response()->json(['message' => 'Car updated', 'id' => $id, 'data' => $updatedCar]);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Error creating car', 'error' => $e->getMessage()], 500);
        }
    }

    public function destroy(int $id)
    {
        try {
            $this->carService->deleteCar($id);
            return redirect()->route('admin.cars')->with('success', 'Car deleted successfully');
        } catch (\Exception $e) {
            return redirect()->route('admin.cars')->with('error', $e->getMessage());
        }
    }

    public function add()
    {
        return view('pages.addCar', $this->getDropDownData());
    }

    public function getDropDownData() : array
    {
        return [
            'brands' => Brand::all(),
            'carModels' => CarModel::all(),
            'bodyStyles' => BodyStyle::all(),
            'types' => Type::all(),
            'transmissionTypes' => TransmissionType::all(),
            'driveTypes' => DriveType::all(),
            'engineTypes' => EngineType::all(),
            'vehicleStatuses' => VehicleStatus::all(),
            'refurbishmentStatuses' => RefurbishmentStatus::cases(),
            'trim' => Trim::all(),
            'features' => Feature::cases(),
            'conditions' => Condition::cases()
        ];
    }

    public function show(int $id)
    {
        try {
            $car = $this->carService->getCarDetails($id);
            return view('pages.showCar', ['car' => $this->toRecursiveArray($car)]);
        } catch (\Exception $e) {
            return redirect()->back()->with(['message' => 'Error fetching car', 'error' => $e->getMessage()]);
        }
    }

    public function index()
    {
        $paginatedCars = Car::with([
            'brand', 'carModel', 'engineType', 'vehicleStatus', 'fuelEconomy',
            'horsepower', 'size', 'trim', 'flags', 'features', 'conditions', 'images'
        ])->latest()->paginate(10);

        $carResources = CarResource::collection($paginatedCars);

        $transformedCars = $carResources->getCollection()->map(function ($car) {
            return $this->toRecursiveArray($car);
        });

        $carResources->setCollection($transformedCars);

        return view('pages.cars', ['cars' => $carResources]);
    }

    public function toRecursiveArray(CarResource $car)
    {
        $carArray = $car->toArray(request());
        $carArray['flags'] = $carArray['flags']->toArray(request());
        $carArray['features'] = $carArray['features']->toArray(request());
        $carArray['conditions'] = $carArray['conditions']->toArray(request());
        $carArray['images'] = $carArray['images']->toArray(request());
        return $carArray;
    }
}
