<?php

namespace App\Http\Controllers\Draftech;

use App\Http\Controllers\BaseController;
use App\Models\Car;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Services\CarService;
use App\Http\Resources\CarResource;

class FavouriteController extends BaseController
{
    protected $carService;

    public function __construct(CarService $carService)
    {
        $this->carService = $carService;
    }

    public function toggleFavourite($carId)
    {
        $user = auth('api')->user();
        $car = Car::findOrFail($carId);

        if ($user->favouriteCars()->where('car_id', $carId)->exists()) {
            // لو موجودة شيلها
            $user->favouriteCars()->detach($carId);

            return response()->json(['message' => 'Car removed to favourites']);
        } else {
            // لو مش موجودة ضيفها
            $user->favouriteCars()->attach($carId);

            return response()->json(['message' => 'Car added to favourites']);
        }
    }

    public function myFavourites(Request $request)
    {
        $user = auth('api')->user();
        $size = $request->query('size', 10);
        $favourites = $user->favouriteCars()->paginate($size);
        return $this->successResponse(CarResource::collection($favourites), 'Favourite cars fetched successfully.');
    }


}
