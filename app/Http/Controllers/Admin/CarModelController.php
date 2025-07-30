<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CarModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CarModelController extends Controller
{
    public function index()
    {
        $CarModels = CarModel::latest()->paginate(10);
        return view('pages.CarModels', compact('CarModels'));
    }

    public function store(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'name' => 'required|string|max:255'
        ]);

        if ($validate->fails()) {
            return redirect()->back()->withErrors($validate)->withInput();
        }

        CarModel::create(['name' => $request->input('name')]);

        return redirect()->route('admin.CarModels')->with('success', 'Model created successfully.');
    }

    public function edit(Request $request, $id)
    {
        $validate = Validator::make($request->all(), [
            'name' => 'required|string|max:255'
        ]);

        if ($validate->fails()) {
            return redirect()->back()->withErrors($validate)->withInput();
        }

        $CarModel = CarModel::findOrFail($id);
        $CarModel->update(['name' => $request->input('name')]);

        return redirect()->route('admin.CarModels')->with('success', 'Model updated successfully.');
    }

    public function destroy($id)
    {
        $CarModel = CarModel::findOrFail($id);
        $CarModel->delete();

        return redirect()->route('admin.CarModels')->with('success', 'Model deleted successfully.');
    }


    /**
     * Display a listing of the resource.
     */
    public function indexAPI()
    {
        $brands = CarModel::all();
        return response()->json($brands, 200);
    }

    /**
     * Display the specified resource.
     */
    public function showAPI(int $id)
    {
        try {
            $brand = CarModel::findOrFail($id);
            return response()->json($brand, 200);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json(['error' => 'BodyStyle not found'], 404);
        }
    }
}
