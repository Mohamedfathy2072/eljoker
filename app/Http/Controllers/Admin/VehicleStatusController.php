<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\VehicleStatus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

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
            'name' => 'required|string|max:255'
        ]);

        if ($validate->fails()) {
            return redirect()->back()->withErrors($validate)->withInput();
        }

        VehicleStatus::create(['name' => $request->input('name')]);

        return redirect()->route('admin.VehicleStatuses')->with('success', 'Vehicle Status created successfully.');
    }

    public function edit(Request $request, $id)
    {
        $validate = Validator::make($request->all(), [
            'name' => 'required|string|max:255'
        ]);

        if ($validate->fails()) {
            return redirect()->back()->withErrors($validate)->withInput();
        }

        $data = VehicleStatus::findOrFail($id);
        $data->update(['name' => $request->input('name')]);

        return redirect()->route('admin.VehicleStatuses')->with('success', 'Vehicle Status updated successfully.');
    }

    public function destroy($id)
    {
        $data = VehicleStatus::findOrFail($id);
        $data->delete();

        return redirect()->route('admin.VehicleStatuses')->with('success', 'Vehicle Status deleted successfully.');
    }
}
