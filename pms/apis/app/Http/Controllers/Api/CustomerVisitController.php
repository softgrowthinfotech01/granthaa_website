<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCustomerVisitRequest;
use App\Models\CustomerVisit;
use App\Models\User;
use Illuminate\Http\Request;

class CustomerVisitController extends Controller
{
    // Store a new customer visit
public function store(Request $request)
{
    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email',
        'contact_no' => 'required|string|max:20',
        'aadhaar_number' => 'required|string|max:20',
        'gender' => 'required|in:male,female,other',
        'address' => 'required|string',
        'site_location' => 'required|exists:location_master,id',
        'remark' => 'nullable|string|max:1000',
    ]);

    $existingUser = User::where('email', $request->email)
    ->orWhere('contact_no', $request->contact_no)
    ->orWhere('aadhaar_number', $request->aadhaar_number)
    ->first();

if ($existingUser) {
    $conflictField = '';

    if ($existingUser->email == $request->email) {
        $conflictField = 'email';
    } elseif ($existingUser->contact_no == $request->contact_no) {
        $conflictField = 'contact number';
    } elseif ($existingUser->aadhaar_number == $request->aadhaar_number) {
        $conflictField = 'Aadhaar number';
    }

    return response()->json([
        'status' => false,
        'message' => "This user is already registered with this organisation. The $conflictField is already in use. Please use another $conflictField."
    ], 422);
}

    $creator = auth()->user();

    // Check if another user has already registered this customer
   $existing = CustomerVisit::where(function ($query) use ($request) {
    $query->where('email', $request->email)
          ->orWhere('contact_no', $request->contact_no)
          ->orWhere('aadhaar_number', $request->aadhaar_number);
})->where('released', 0)->first();  // Only consider locked entries

if ($existing) {
    return response()->json([
        'status' => false,
        'message' => 'This customer is already registered by another user. Please check the details or wait until it is released.'
    ], 409);
}

// Check if user already has a referral/visit for the same site location
$existingVisit = CustomerVisit::where(function($query) use ($request) {
    $query->where('email', $request->email)
          ->orWhere('contact_no', $request->contact_no)
          ->orWhere('aadhaar_number', $request->aadhaar_number);
})
->where('site_location', $request->site_location) // only same site
->whereNull('released_at') // only active visits
->first();

if ($existingVisit) {
    return response()->json([
        'status' => false,
        'error' => 'This user already has a visit registered for this site location. Please use another email, contact, or Aadhaar.'
    ], 422);
}

    $visit = CustomerVisit::create([
        'name' => $request->name,
        'email' => $request->email,
        'contact_no' => $request->contact_no,
        'aadhaar_number' => $request->aadhaar_number,
        'gender' => $request->gender,
        'address' => $request->address,
        'site_location' => $request->site_location,
        'remark' => $request->remark,
        'created_by' => $creator->id,
        'visited_at' => now()
    ]);

    return response()->json([
        'status' => true,
        'message' => 'Customer visit registered successfully',
        'data' => $visit
    ]);
}

    // List all customer visits (optional filtering)
    public function index(Request $request)
    {
        $query = CustomerVisit::with(['creator', 'location']);

        // Optional filters
        if ($request->site_location) {
            $query->where('site_location', $request->site_location);
        }

        if ($request->created_by) {
            $query->where('created_by', $request->created_by);
        }

        $visits = $query->orderBy('visited_at', 'desc')->get();

        return response()->json([
            'status' => true,
            'data' => $visits
        ]);
    }

    // Optional: show single visit
    public function show($id)
    {
        $visit = CustomerVisit::with(['creator', 'location'])->find($id);

        if (!$visit) {
            return response()->json([
                'status' => false,
                'error' => 'Customer visit not found.'
            ], 404);
        }

        return response()->json([
            'status' => true,
            'data' => $visit
        ]);
    }

    public function release($id)
{
    $creator = auth()->user();
    $visit = CustomerVisit::findOrFail($id);

    if ($visit->created_by != $creator->id) {
        return response()->json([
            'status' => false,
            'message' => 'You are not authorized to release this customer visit.'
        ], 403);
    }

    $visit->released = 1;
    $visit->save();

    return response()->json([
        'status' => true,
        'message' => 'Customer visit released successfully.'
    ]);
}
}
