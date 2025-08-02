<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BodyStyle;
use Illuminate\Support\Facades\Storage;
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
            'name' => 'required|string|max:255',
            'image' => 'nullable|file|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if ($validate->fails()) {
            return redirect()->back()->withErrors($validate)->withInput();
        }
        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('body_style', 'public');
        }

        BodyStyle::create([
            'name' => $request->input('name'),
            'image' => $imagePath
        ]);

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

        $body = BodyStyle::findOrFail($id);
        $data = ['name' => $request->input('name')];

        if ($request->hasFile('image')) {
            if ($body->image && Storage::disk('public')->exists($body->image)) {
                Storage::disk('public')->delete($body->image);
            }

            $data['image'] = $request->file('image')->store('brands', 'public');
        }

        $body->update($data);

        return redirect()->route('admin.BodyStyles')->with('success', 'Body Style updated successfully.');
    }

    public function destroy($id)
    {
        $brand = BodyStyle::findOrFail($id);
        $brand->delete();

        return redirect()->route('admin.BodyStyles')->with('success', 'Body Style deleted successfully.');
    }

    /**
     * Display a listing of the resource.
     */
    public function indexAPI()
    {
        $brands = BodyStyle::all();
        return response()->json($brands, 200);
    }

    /**
     * Display the specified resource.
     */
    public function showAPI(int $id)
    {
        try {
            $brand = BodyStyle::findOrFail($id);
            return response()->json($brand, 200);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json(['error' => 'BodyStyle not found'], 404);
        }
    }
}
