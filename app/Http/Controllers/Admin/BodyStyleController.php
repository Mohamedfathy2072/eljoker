<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BodyStyle;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class BodyStyleController extends Controller
{
    public function index()
    {
        $data = BodyStyle::latest()->paginate(10);
        return view('pages.BodyStyles', compact('data'));
    }

    public function store(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'name' => 'required|string|max:255'
        ]);

        if ($validate->fails()) {
            return redirect()->back()->withErrors($validate)->withInput();
        }

        BodyStyle::create(['name' => $request->input('name')]);

        return redirect()->route('admin.BodyStyles')->with('success', 'Body Style created successfully.');
    }

    public function edit(Request $request, $id)
    {
        $validate = Validator::make($request->all(), [
            'name' => 'required|string|max:255'
        ]);

        if ($validate->fails()) {
            return redirect()->back()->withErrors($validate)->withInput();
        }

        $brand = BodyStyle::findOrFail($id);
        $brand->update(['name' => $request->input('name')]);

        return redirect()->route('admin.BodyStyles')->with('success', 'Body Style updated successfully.');
    }

    public function destroy($id)
    {
        $brand = BodyStyle::findOrFail($id);
        $brand->delete();

        return redirect()->route('admin.BodyStyles')->with('success', 'Body Style deleted successfully.');
    }
}
