<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\VehicleStatus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Resources\VehicleStatusResource;

class VehicleStatusController extends Controller
{
    public function index()
    {
        $data = VehicleStatus::latest()->paginate(10);
        return view('pages.VehicleStatuses', compact('data'));
    }

    public function store(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'name_ar' => 'required|string|max:255',
            'name_en' => 'required|string|max:255'
        ]);

        if ($validate->fails()) {
            return redirect()->back()->withErrors($validate)->withInput();
        }

        VehicleStatus::create(['name' => 
            [
                'en' => $request->input('name_en'),
                'ar'=>$request->input('name_ar')
            ]
        ]);

        return redirect()->route('admin.VehicleStatuses')->with('success', 'Vehicle Status created successfully.');
    }

    public function edit(Request $request, $id)
    {
        $validate = Validator::make($request->all(), [
            'name_ar' => 'required|string|max:255',
            'name_en' => 'required|string|max:255'

        ]);

        if ($validate->fails()) {
            return redirect()->back()->withErrors($validate)->withInput();
        }

        $data = VehicleStatus::findOrFail($id);
        $data->setTranslation('name','ar',$request->input('name_ar'));
        $data->setTranslation('name','en',$request->input('name_en'));
        $data->save();

        return redirect()->route('admin.VehicleStatuses')->with('success', 'Vehicle Status updated successfully.');
    }

    public function destroy($id)
    {
        $data = VehicleStatus::findOrFail($id);
        $data->delete();

        return redirect()->route('admin.VehicleStatuses')->with('success', 'Vehicle Status deleted successfully.');
    }


    /**
     * Display a listing of the resource.
     */
    public function indexAPI()
    {
        $brands = VehicleStatus::all();
        $brands = VehicleStatusResource::collection($brands);
        return response()->json($brands, 200);
    }

    /**
     * Display the specified resource.
     */
    public function showAPI(int $id)
    {
        try {
            $brand = VehicleStatus::findOrFail($id);
            return response()->json(new VehicleStatusResource($brand), 200);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json(['error' => 'VehicleStatus not found'], 404);
        }
    }
}
