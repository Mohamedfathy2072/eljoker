<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\BaseController;
use App\Http\Resources\BrandResource;
use App\Models\Brand;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class BrandController extends BaseController
{
    public function showBrands()
    {
        $brands = Brand::latest()->paginate(10);
        return view('pages.brands', compact('brands'));
    }

    public function storeBrand(Request $request)
    {
        $validated = $request->validate([
            'name_en' => 'required|string|max:255',
            'name_ar' => 'required|string|max:255',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $brand = new Brand();
        $brand->setTranslations('name', [
            'en' => $validated['name_en'],
            'ar' => $validated['name_ar']
        ]);

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('brands', 'public');
            $brand->image = $imagePath;
        }

        $brand->save();

        return redirect()->route('admin.brands')
            ->with('success', 'Brand created successfully.');
    }

    public function editBrand(Request $request, $id)
    {
        $brand = Brand::findOrFail($id);

        $validated = $request->validate([
            'name_en' => 'required|string|max:255',
            'name_ar' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $brand->setTranslations('name', [
            'en' => $validated['name_en'],
            'ar' => $validated['name_ar']
        ]);

        if ($request->hasFile('image')) {
            // Delete old image if exists
            if ($brand->image) {
                Storage::disk('public')->delete($brand->image);
            }
            $imagePath = $request->file('image')->store('brands', 'public');
            $brand->image = $imagePath;
        }

        $brand->save();

        return redirect()->route('admin.brands')
            ->with('success', 'Brand updated successfully.');
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
    public function indexAPI(Request $request)
    {
        if(config('app.app') === 'kalksat') {
            $brands = BrandResource::collection(Brand::all());
            return response()->json($brands, 200);
        } else {
            $size = $request->input('size', 10);
            $brands = Brand::paginate($size);
            return $this->successResponse(BrandResource::collection($brands), "Brands fetched successfully.");
        }
    }

    /**
     * Display the specified resource.
     */
    public function showAPI(int $id)
    {
        try {
            $brand = new BrandResource(Brand::findOrFail($id));
            return config('app.app') === 'kalksat'
                ? response()->json($brand, 200)
                : $this->singleItemResponse($brand, "Brand fetched successfully.");
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json(['error' => 'BodyStyle not found'], 404);
        }
    }
}
