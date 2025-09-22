<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\CarService;
use Illuminate\Support\Facades\Storage;

class CarController extends BaseController
{
    protected $carService;

    public function __construct(CarService $carService)
    {
        $this->carService = $carService;
    }

    public function index(Request $request)
    {
        $size = $request->input('size', 10);

        if ($request->hasAny(['brand', 'model', 'color', 'year', 'price_from', 'price_to', 'location', 'sort_by', 'sort_order','condition' , 'search'])) {
            $query = $this->carService->search($request);
        } else {
            $query = $this->carService->getAllCars();
        }

        $cars = $query->paginate($size);

        $this->carService->formatCars($cars);

        return $this->successResponse($cars, "Cars fetched successfully.");
    }





    public function store(Request $request)
    {
        $validated = $request->validate([
            'brand_id' => 'required',
            'model' => 'required|string',
            'condition' => 'required|in:new,used',

            'year' => 'required|digits:4|integer',
            'color' => 'required|string',
            'transmission' => 'required|string',
            'engine_cc' => 'required|integer',
            'body_type' => 'required|string',
            'km_driven' => 'required|integer',
            'down_payment' => 'required|numeric',
            'license_validity' => 'required|string',
            'location' => 'required|string',
            'images.*' => 'image|mimes:jpeg,png,jpg|max:2048',


            'exterior_conditions' => 'array',
            'exterior_conditions.*.part_name' => 'required|string',
            'exterior_conditions.*.note' => 'nullable|string',
            'exterior_conditions.*.image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',

            'interior_conditions' => 'array',
            'interior_conditions.*.part_name' => 'required|string',
            'interior_conditions.*.note' => 'nullable|string',
            'interior_conditions.*.image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',

            'mechanical_conditions' => 'array',
            'mechanical_conditions.*.part_name' => 'required|string',
            'mechanical_conditions.*.note' => 'nullable|string',
            'mechanical_conditions.*.image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'vehicle_category' => 'nullable|string',
            'description' => 'nullable|string',
            'payment_option' => 'nullable|in:cash,installment',


        ]);

        return response()->json($this->carService->createCar($request), 201);
    }

    public function show($id)
    {
        $car = $this->carService->getCarById($id);
        return $this->singleItemResponse($car, "Car fetched successfully.");
    }


    public function update(Request $request, $id)
    {
        return response()->json($this->carService->updateCar($id, $request));
    }

    public function destroy($id)
    {
        $this->carService->deleteCar($id);
        return response()->json(['message' => 'Deleted']);
    }
}
