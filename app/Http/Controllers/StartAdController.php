<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\StartAd;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class StartAdController extends Controller
{

    public function __construct() {}
    public function index()
    {
        $data = StartAd::latest()->paginate(10);
        return view('pages.StartAd', compact('data'));
    }

    public function store(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'image' => 'required|image|max:2048',
            'description' => 'nullable|string|max:500'
        ]);

        if ($validate->fails()) {
            return redirect()->back()->withErrors($validate)->withInput();
        }

        $path = $request->file('image')->store('start_ads', 'public');
        StartAd::create(['image_path' => $path, 'description' => $request->input('description', '')]);

        return redirect()->route('admin.StartAds')->with('success', 'ad created successfully.');
    }

    public function edit(Request $request, $id)
    {
        $validate = Validator::make($request->all(), [
            'description' => 'nullable|string|max:255'
        ]);

        if ($validate->fails()) {
            return redirect()->back()->withErrors($validate)->withInput();
        }

        $ad = StartAd::findOrFail($id);
        $data = ['description' => $request->input('description')];

        if ($request->hasFile('image')) {
            if ($ad->image_path && Storage::disk('public')->exists($ad->image_path)) {
                Storage::disk('public')->delete($ad->image_path);
            }

            $data['image_path'] = $request->file('image')->store('start_ads', 'public');
        }
        $ad->update($data);

        return redirect()->route('admin.StartAds')->with('success', 'Ad updated successfully.');
    }

    public function destroy($id)
    {
        $data = StartAd::findOrFail($id);
        $data->delete();

        return redirect()->route('admin.StartAds')->with('success', 'Ad deleted successfully.');
    }

    public function show()
    {
        $ad = StartAd::latest()->first();

        if ($ad) {
            $ad->image_url = asset('storage/' . $ad->image_path);
            unset($ad->image_path);
        }

        return response()->json([
            'data' => $ad
        ]);
    }
}
