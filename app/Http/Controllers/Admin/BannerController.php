<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class BannerController extends Controller
{

    public function index()
    {
        if(request()->expectsJson()) {
            $banners = Banner::all();

            $items = $banners->mapWithKeys(function ($banner) {
                return [
                    $banner->id => [
                        'id' => $banner->id,
                        'title' => $banner->title,
                        'description' => $banner->description,
                        'link' => $banner->link,
                        'image_url' => asset('storage/' . $banner->image),
                        'created_at' => $banner->created_at,
                        'updated_at' => $banner->updated_at,
                    ]
                ];
            });

            return response()->json([
                'status' => true,
                'message' => 'Banners fetched successfully.',
                'data' => [
                    'items' => $items,
                ]
            ]);
        }
        $data = Banner::latest()->paginate(10);
        return view('pages.banners', compact('data'));
    }


    public function store(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'link' => 'nullable|url',
            'image' => 'required|image|max:2048',
        ]);
        if ($validate->fails()) {
            return redirect()->back()->withErrors($validate)->withInput();
        }
        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('banners', 'public');
        }

        Banner::create([
            'title' => $request->input('title'),
            'description' => $request->input('description'),
            'link' => $request->input('link'),
            'image' => $imagePath
        ]);

        return redirect()->route('admin.Banners')->with('success', 'Banner created successfully.');
    }

    public function edit(Request $request, $id)
    {
        $validate = Validator::make($request->all(), [
            'title' => 'sometimes|required|string|max:255',
            'description' => 'nullable|string',
            'link' => 'nullable|url',
            'image' => 'nullable|image|max:2048',
        ]);

        if ($validate->fails()) {
            return redirect()->back()->withErrors($validate)->withInput();
        }

        $banner = Banner::findOrFail($id);
        $data = [
            'title' => $request->input('title'),
            'description' => $request->input('description'),
            'link' => $request->input('link')
        ];

        if ($request->hasFile('image')) {
            if ($banner->image && Storage::disk('public')->exists($banner->image)) {
                Storage::disk('public')->delete($banner->image);
            }

            $data['image'] = $request->file('image')->store('banners', 'public');
        }

        $banner->update($data);

        return redirect()->route('admin.Banners')->with('success', 'Banner updated successfully.');
    }

    public function destroy($id)
    {
        $banner = Banner::findOrFail($id);
        Storage::disk('public')->delete($banner->image);
        $banner->delete();

        return redirect()->route('admin.Banners')->with('success', 'Banner deleted successfully.');
    }


    public function show($id)
    {
        try {
            $banner = Banner::findOrFail($id);
            return response()->json($banner, 200);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json(['error' => 'Banner not found'], 404);
        }
    }

}
