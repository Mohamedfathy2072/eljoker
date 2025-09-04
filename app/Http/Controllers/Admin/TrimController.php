<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Trim;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Resources\TrimResource;

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
            'name_ar' => 'required|string|max:255',
            'name_en' => 'required|string|max:255'
        ]);

        if ($validate->fails()) {
            return redirect()->back()->withErrors($validate)->withInput();
        }

        Trim::create([
            'name' => [
                'ar' => $request->input('name_ar'),
                'en' => $request->input('name_en')
            ]
        ]);

        return redirect()->route('admin.Trim')->with('success', 'Trim created successfully.');
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

        $data = Trim::findOrFail($id);
        $data->setTranslation('name', 'ar', $request->input('name_ar'));
        $data->setTranslation('name', 'en', $request->input('name_en'));
        $data->save(); 
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
        $brands = TrimResource::collection($brands);
        return response()->json($brands, 200);
    }

    /**
     * Display the specified resource.
     */
    public function showAPI(int $id)
    {
        try {
            $brand = Trim::findOrFail($id);
            $brand = new TrimResource($brand);
            return response()->json($brand, 200);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json(['error' => 'Trim not found'], 404);
        }
    }
}
