<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Trim;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TrimController extends Controller
{
    public function index()
    {
        $data = Trim::latest()->paginate(10);
        return view('pages.Trim', compact('data'));
    }

    public function store(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'name' => 'required|string|max:255'
        ]);

        if ($validate->fails()) {
            return redirect()->back()->withErrors($validate)->withInput();
        }

        Trim::create(['name' => $request->input('name')]);

        return redirect()->route('admin.Trim')->with('success', 'Trim created successfully.');
    }

    public function edit(Request $request, $id)
    {
        $validate = Validator::make($request->all(), [
            'name' => 'required|string|max:255'
        ]);

        if ($validate->fails()) {
            return redirect()->back()->withErrors($validate)->withInput();
        }

        $data = Trim::findOrFail($id);
        $data->update(['name' => $request->input('name')]);

        return redirect()->route('admin.Trim')->with('success', 'Trim updated successfully.');
    }

    public function destroy($id)
    {
        $data = Trim::findOrFail($id);
        $data->delete();

        return redirect()->route('admin.Trim')->with('success', 'Trim deleted successfully.');
    }



    /**
     * Display a listing of the resource.
     */
    public function indexAPI()
    {
        $brands = Trim::all();
        return response()->json($brands, 200);
    }

    /**
     * Display the specified resource.
     */
    public function showAPI(int $id)
    {
        try {
            $brand = Trim::findOrFail($id);
            return response()->json($brand, 200);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json(['error' => 'BodyStyle not found'], 404);
        }
    }
}
