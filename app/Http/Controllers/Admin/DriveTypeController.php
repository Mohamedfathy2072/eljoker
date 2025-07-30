<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\DriveType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class DriveTypeController extends Controller
{
    public function index()
    {
        $data = DriveType::latest()->paginate(10);
        return view('pages.DriveTypes', compact('data'));
    }

    public function store(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'name' => 'required|string|max:255'
        ]);

        if ($validate->fails()) {
            return redirect()->back()->withErrors($validate)->withInput();
        }

        DriveType::create(['name' => $request->input('name')]);

        return redirect()->route('admin.DriveTypes')->with('success', 'Drive Type created successfully.');
    }

    public function edit(Request $request, $id)
    {
        $validate = Validator::make($request->all(), [
            'name' => 'required|string|max:255'
        ]);

        if ($validate->fails()) {
            return redirect()->back()->withErrors($validate)->withInput();
        }

        $data = DriveType::findOrFail($id);
        $data->update(['name' => $request->input('name')]);

        return redirect()->route('admin.DriveTypes')->with('success', 'Drive Type updated successfully.');
    }

    public function destroy($id)
    {
        $data = DriveType::findOrFail($id);
        $data->delete();

        return redirect()->route('admin.DriveTypes')->with('success', 'Drive Type deleted successfully.');
    }



    /**
     * Display a listing of the resource.
     */
    public function indexAPI()
    {
        $brands = DriveType::all();
        return response()->json($brands, 200);
    }

    /**
     * Display the specified resource.
     */
    public function showAPI(int $id)
    {
        try {
            $brand = DriveType::findOrFail($id);
            return response()->json($brand, 200);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json(['error' => 'BodyStyle not found'], 404);
        }
    }
}
