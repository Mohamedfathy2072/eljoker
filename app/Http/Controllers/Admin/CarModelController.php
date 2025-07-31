<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\CarModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CarModelController extends Controller
{
    public function index()
    {
        $CarModels = CarModel::with('brand')->latest()->paginate(10);
        $brands = Brand::all(); // لعرض الماركات في الفورم

        return view('pages.CarModels', compact('CarModels', 'brands'));
    }

    public function store(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'brand_id' => 'required|exists:brands,id',
        ]);

        if ($validate->fails()) {
            return redirect()->back()->withErrors($validate)->withInput();
        }

        CarModel::create([
            'name' => $request->input('name'),
            'brand_id' => $request->input('brand_id'),
        ]);

        return redirect()->route('admin.CarModels')->with('success', 'Model created successfully.');
    }

    public function edit(Request $request, $id)
    {
        $validate = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'brand_id' => 'required|exists:brands,id',
        ]);

        if ($validate->fails()) {
            return redirect()->back()->withErrors($validate)->withInput();
        }

        $CarModel = CarModel::findOrFail($id);
        $CarModel->update([
            'name' => $request->input('name'),
            'brand_id' => $request->input('brand_id'),
        ]);

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
        $data = CarModel::with('brand')->get();
        return response()->json($data, 200);
    }

    public function showAPI(int $id)
    {
        try {
            $data = CarModel::with('brand')->findOrFail($id);
            return response()->json($data, 200);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json(['error' => 'CarModel not found'], 404);
        }
    }

    public function getModelsBrandAPI(Request $request)
    {
        $request->validate([
            'brand_id' => 'required|integer'
        ]);
        $data = CarModel::where('brand_id', $request->input('brand_id'))->get();
        return response()->json($data, 200);
    }
}
