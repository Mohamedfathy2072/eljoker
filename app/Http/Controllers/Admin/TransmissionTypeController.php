<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TransmissionType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Resources\TransmissionTypeResource;

class TransmissionTypeController extends Controller
{
        public function index()
    {
        $data = TransmissionType::latest()->paginate(10);
        return view('pages.TransmissionTypes', compact('data'));
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

        TransmissionType::create([
            'name' => [
                'ar' => $request->input('name_ar'),
                'en' => $request->input('name_en')
            ]
        ]);

        return redirect()->route('admin.TransmissionTypes')->with('success', 'Transmission Type created successfully.');
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

        $data = TransmissionType::findOrFail($id);
        $data->setTranslation('name', 'ar', $request->input('name_ar'));
        $data->setTranslation('name', 'en', $request->input('name_en'));
        $data->save();
        return redirect()->route('admin.TransmissionTypes')->with('success', 'Transmission Type updated successfully.');
    }

    public function destroy($id)
    {
        $data = TransmissionType::findOrFail($id);
        $data->delete();

        return redirect()->route('admin.TransmissionTypes')->with('success', 'Transmission Type deleted successfully.');
    }



    /**
     * Display a listing of the resource.
     */
    public function indexAPI()
    {
        $brands = TransmissionType::all();
        $brands = TransmissionTypeResource::collection($brands);
        return response()->json($brands, 200);
    }

    /**
     * Display the specified resource.
     */
    public function showAPI(int $id)
    {
        try {
            $brand = TransmissionType::findOrFail($id);
            $brand = new TransmissionTypeResource($brand);
            return response()->json($brand, 200);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json(['error' => 'BodyStyle not found'], 404);
        }
    }
}
