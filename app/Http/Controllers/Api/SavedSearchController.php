<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\CarResource;
use App\Models\Car;
use App\Models\SavedSearch;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SavedSearchController extends Controller
{

    public function index()
{
    $userId = auth('api')->id();
    $savedSearches = SavedSearch::where('user_id', $userId)->pluck('search_text');

    $query = Car::with([
            'images',
            'brand:id,name',
            'carModel:id,name',
            'bodyStyle:id,name',
            'type:id,name',
            'fuelEconomy:id,min,max',
            'transmissionType:id,name',
            'driveType:id,name',
            'engineType:id,name',
            'size:id,length,width,height',
            'horsepower:id,min,max',
            'vehicleStatus:id,name',
            'trim:id,name'
        ])
        ->when($savedSearches->isNotEmpty(), function ($query) use ($savedSearches) {
            $query->where(function ($query) use ($savedSearches) {
                foreach ($savedSearches as $text) {
                    $query->orWhere(function ($query) use ($text) {
                        $query->where('cars.color', 'LIKE', '%' . $text . '%')
                            ->orWhere('cars.location', 'LIKE', '%' . $text . '%')
                            ->orWhere('cars.model_year', '=', $text)
                            ->orWhereHas('brand', function ($q) use ($text) {
                                $q->where('name', 'LIKE', '%' . $text . '%');
                            })
                            ->orWhereHas('carModel', function ($q) use ($text) {
                                $q->where('name', '=', $text);
                            })
                            ->orWhereHas('bodyStyle', function ($q) use ($text) {
                                $q->where('name', 'LIKE', '%' . $text . '%');
                            })
                            ->orWhereHas('type', function ($q) use ($text) {
                                $q->where('name', 'LIKE', '%' . $text . '%');
                            })
                            ->orWhereHas('fuelEconomy', function ($q) use ($text) {
                                $q->where('min', '=', $text)
                                  ->orWhere('max', '=', $text);
                            })
                            ->orWhereHas('transmissionType', function ($q) use ($text) {
                                $q->where('name', 'LIKE', '%' . $text . '%');
                            })
                            ->orWhereHas('driveType', function ($q) use ($text) {
                                $q->where('name', 'LIKE', '%' . $text . '%');
                            })
                            ->orWhereHas('engineType', function ($q) use ($text) {
                                $q->where('name', 'LIKE', '%' . $text . '%');
                            })
                            ->orWhereHas('size', function ($q) use ($text) {
                                $q->where('length', '=', $text)
                                  ->orWhere('width', '=', $text)
                                  ->orWhere('height', '=', $text);
                            })
                            ->orWhereHas('horsepower', function ($q) use ($text) {
                                $q->where('min', '=', $text)
                                  ->orWhere('max', '=', $text);
                            })
                            ->orWhereHas('vehicleStatus', function ($q) use ($text) {
                                $q->where('name', 'LIKE', '%' . $text . '%');
                            })
                            ->orWhereHas('trim', function ($q) use ($text) {
                                $q->where('name', 'LIKE', '%' . $text . '%');
                            });
                    });
                }
            });
        });

    return CarResource::collection($query->paginate(10));
}

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'search_text' => 'required|string|max:255'
        ]);
        if ($validator->fails()) {
            return response()->json([
                'message' => 'Validation failed',
                'errors' => $validator->errors()
            ], 422);
        }
        $savedSearch = new SavedSearch();
        $savedSearch->user_id = auth('api')->id();
        $savedSearch->search_text = $request->search_text;
        $savedSearch->save();
        return response()->json($savedSearch);
    }

    public function destroy($id)
    {
        $savedSearch = SavedSearch::find($id);
        if (!$savedSearch) {
            return response()->json(['message' => 'Saved search not found'], 404);
        }
        $savedSearch->delete();
        return response()->json(['message' => 'Deleted successfully']);
    }
}
