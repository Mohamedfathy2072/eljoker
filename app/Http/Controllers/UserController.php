<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function index()
    {
        $data = User::latest()->paginate(10);
        return view('pages.Users', compact('data'));
    }

    public function store(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'nullable|string|max:15|unique:users,phone'
        ]);

        if ($validate->fails()) {
            return redirect()->back()->withErrors($validate)->withInput();
        }

        User::create(['name' => $request->input('name')
            , 'email' => $request->input('email'),
            'phone' => $request->input('phone') ?? null,
            'is_active' => true]);

        return redirect()->route('admin.Users')->with('success', 'Users created successfully.');
    }

    public function edit(Request $request, $id)
    {
        $validate = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'nullable|string|max:15|unique:users,phone'
        ]);

        if ($validate->fails()) {
            return redirect()->back()->withErrors($validate)->withInput();
        }

        $data = User::findOrFail($id);
        $data->update(['name' => $request->input('name'),
            'email' => $request->input('email'),
            'phone' => $request->input('phone'),
            'is_active' => true]);

        return redirect()->route('admin.Users')->with('success', 'Users updated successfully.');
    }

    public function destroy($id)
    {
        $data = User::findOrFail($id);
        $data->delete();

        return redirect()->route('admin.Users')->with('success', 'User deleted successfully.');
    }
}
