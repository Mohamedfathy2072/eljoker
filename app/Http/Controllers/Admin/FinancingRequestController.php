<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\FinancingRequest;
use Illuminate\Http\Request;

class FinancingRequestController extends Controller
{
    public function index(Request $request)
    {
        $query = FinancingRequest::with(['user', 'governorate', 'area', 'brand']);

        if ($request->has('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('first_name', 'like', "%$search%")
                  ->orWhere('second_name', 'like', "%$search%")
                  ->orWhere('email', 'like', "%$search%")
                  ->orWhere('status', 'like', "%$search%")
                  ->orWhere('car_model', 'like', "%$search%")
                  ->orWhere('manufacture_year', 'like', "%$search%")
                  ->orWhere('car_type', 'like', "%$search%")
                  ->orWhere('applicant_type', 'like', "%$search%")
                  ->orWhereHas('user', function($q) use ($search) {
                      $q->where('name', 'like', "%$search%");
                  })
                  ->orWhereHas('governorate', function($q) use ($search) {
                      $q->where('name', 'like', "%$search%");
                  })
                  ->orWhereHas('area', function($q) use ($search) {
                      $q->where('name', 'like', "%$search%");
                  })
                  ->orWhereHas('brand', function($q) use ($search) {
                      $q->where('name', 'like', "%$search%");
                  });
            });
        }

        if ($request->has('status') && $request->status !== 'all') {
            $query->where('status', $request->status);
        }

        $requests = $query->latest()->paginate(10)->withQueryString();
        
        return view('admin.requests.index', compact('requests'));
    }

    public function show($id)
    {
        $financingRequest = FinancingRequest::with(['user', 'governorate', 'area', 'brand'])->findOrFail($id);
        return view('admin.requests.show', compact('financingRequest'));
    }

    public function updateStatus(Request $request, FinancingRequest $financingRequest)
    {

        $validated = $request->validate([
            'status' => 'required|in:Cancelled,Rejected,Accepted,In process'
        ]);

        $financingRequest->update(['status' => $validated['status']]);
        
        return back()->with('success', 'Request status updated successfully');
    }

    public function destroy(FinancingRequest $financingRequest)
    {
        $financingRequest->delete();
        return redirect()->route('admin.financing-requests.index')
            ->with('success', 'Request deleted successfully');
    }
}
