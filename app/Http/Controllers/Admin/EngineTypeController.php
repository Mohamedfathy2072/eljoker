<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\EngineType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class EngineTypeController extends Controller
{
    public function index()
    {
        $data = EngineType::latest()->paginate(10);
        return view('pages.EngineTypes', compact('data'));
    }

    public function store(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'name' => 'required|string|max:255'
        ]);

        if ($validate->fails()) {
            return redirect()->back()->withErrors($validate)->withInput();
        }

        EngineType::create(['name' => $request->input('name')]);

        return redirect()->route('admin.EngineTypes')->with('success', 'Engine Type created successfully.');
    }

    public function edit(Request $request, $id)
    {
        $validate = Validator::make($request->all(), [
            'name' => 'required|string|max:255'
        ]);

        if ($validate->fails()) {
            return redirect()->back()->withErrors($validate)->withInput();
        }

        $data = EngineType::findOrFail($id);
        $data->update(['name' => $request->input('name')]);

        return redirect()->route('admin.EngineTypes')->with('success', 'Engine Type updated successfully.');
    }

    public function destroy($id)
    {
        $data = EngineType::findOrFail($id);
        $data->delete();

        return redirect()->route('admin.EngineTypes')->with('success', 'Engine Type deleted successfully.');
    }
}
