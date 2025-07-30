<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Type;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TypeController extends Controller
{
    public function index()
    {
        $data = Type::latest()->paginate(10);
        return view('pages.Types', compact('data'));
    }

    public function store(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'name' => 'required|string|max:255'
        ]);

        if ($validate->fails()) {
            return redirect()->back()->withErrors($validate)->withInput();
        }

        Type::create(['name' => $request->input('name')]);

        return redirect()->route('admin.Types')->with('success', 'Types created successfully.');
    }

    public function edit(Request $request, $id)
    {
        $validate = Validator::make($request->all(), [
            'name' => 'required|string|max:255'
        ]);

        if ($validate->fails()) {
            return redirect()->back()->withErrors($validate)->withInput();
        }

        $data = Type::findOrFail($id);
        $data->update(['name' => $request->input('name')]);

        return redirect()->route('admin.Types')->with('success', 'Types updated successfully.');
    }

    public function destroy($id)
    {
        $data = Type::findOrFail($id);
        $data->delete();

        return redirect()->route('admin.Types')->with('success', 'Types deleted successfully.');
    }


    /**
     * Display a listing of the resource.
     */
    public function indexAPI()
    {
        $brands = Type::all();
        return response()->json($brands, 200);
    }

    /**
     * Display the specified resource.
     */
    public function showAPI(int $id)
    {
        try {
            $brand = Type::findOrFail($id);
            return response()->json($brand, 200);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json(['error' => 'BodyStyle not found'], 404);
        }
    }
}
