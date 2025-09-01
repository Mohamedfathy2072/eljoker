<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Resources\TypeResource;
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
            'name_ar' => 'required|string|max:255',
            'name_en' => 'required|string|max:255'
        ]);

        if ($validate->fails()) {
            return redirect()->back()->withErrors($validate)->withInput();
        }

        Type::create([
            'name' => [
                'ar' => $request->input('name_ar'),
                'en' => $request->input('name_en')
            ]
        ]);

        return redirect()->route('admin.Types')->with('success', 'Type created successfully.');
    }

    public function edit(Request $request, $id)
    {
        $validate = Validator::make($request->all(), [
            'name_ar' => 'required|string|max:255',
            'name_en' => 'required|string|max:255'
        ]);

        if ($validate->fails()) {
            return redirect()->back()->withErrors($validate)->withInput();
        }

        $type = Type::findOrFail($id);
        $type->setTranslation('name', 'ar', $request->input('name_ar'));
        $type->setTranslation('name', 'en', $request->input('name_en'));
        $type->save();

        return redirect()->route('admin.Types')->with('success', 'Type updated successfully.');
    }

    public function destroy($id)
    {
        $data = Type::findOrFail($id);
        $data->delete();

        return redirect()->route('admin.Types')->with('success', 'Type deleted successfully.');
    }

    /**
     * Display a listing of the resource.
     */
    public function indexAPI()
    {
        $types = Type::all();
        return TypeResource::collection($types);
    }

    /**
     * Display the specified resource.
     */
    public function showAPI(int $id)
    {
        try {
            $type = Type::findOrFail($id);
            return new TypeResource($type);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json(['error' => 'Type not found'], 404);
        }
    }
}
