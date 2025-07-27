<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TransmissionType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

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
            'name' => 'required|string|max:255'
        ]);

        if ($validate->fails()) {
            return redirect()->back()->withErrors($validate)->withInput();
        }

        TransmissionType::create(['name' => $request->input('name')]);

        return redirect()->route('admin.TransmissionTypes')->with('success', 'Transmission Type created successfully.');
    }

    public function edit(Request $request, $id)
    {
        $validate = Validator::make($request->all(), [
            'name' => 'required|string|max:255'
        ]);

        if ($validate->fails()) {
            return redirect()->back()->withErrors($validate)->withInput();
        }

        $data = TransmissionType::findOrFail($id);
        $data->update(['name' => $request->input('name')]);

        return redirect()->route('admin.TransmissionTypes')->with('success', 'Transmission Type updated successfully.');
    }

    public function destroy($id)
    {
        $data = TransmissionType::findOrFail($id);
        $data->delete();

        return redirect()->route('admin.TransmissionTypes')->with('success', 'Transmission Type deleted successfully.');
    }
}
