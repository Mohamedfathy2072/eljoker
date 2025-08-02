<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class BrandController extends Controller
{
    public function showBrands()
    {
        $brands = Brand::latest()->paginate(10);
        return view('pages.brands', compact('brands'));
    }

    public function storeBrand(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        if ($validate->fails()) {
            return redirect()->back()->withErrors($validate)->withInput();
        }

        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('brands', 'public');
        }

        Brand::create([
            'name' => $request->input('name'),
            'image' => $imagePath,
        ]);

        return redirect()->route('admin.brands')->with('success', 'Brand created successfully.');
    }

    public function editBrand(Request $request, $id)
    {
        $validate = Validator::make($request->all(), [
            'name' => 'required|string|max:255'
        ]);

        if ($validate->fails()) {
            return redirect()->back()->withErrors($validate)->withInput();
        }

        $brand = Brand::findOrFail($id);

        $data = [
            'name' => $request->input('name'),
        ];

        if ($request->hasFile('image')) {
            if ($brand->image && Storage::disk('public')->exists($brand->image)) {
                Storage::disk('public')->delete($brand->image);
            }

            $data['image'] = $request->file('image')->store('brands', 'public');
        }

        $brand->update($data);

        return redirect()->route('admin.brands')->with('success', 'Brand updated successfully.');
    }

    public function destroyBrand($id)
    {
        $brand = Brand::findOrFail($id);
        $brand->delete();

        return redirect()->route('admin.brands')->with('success', 'Brand deleted successfully.');
    }



    /**
     * Display a listing of the resource.
     */
    public function indexAPI()
    {
        $brands = Brand::all();
        return response()->json($brands, 200);
    }

    /**
     * Display the specified resource.
     */
    public function showAPI(int $id)
    {
        try {
            $brand = Brand::findOrFail($id);
            return response()->json($brand, 200);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json(['error' => 'BodyStyle not found'], 404);
        }
    }}
