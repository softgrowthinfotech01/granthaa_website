<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\LocationMaster;
use Illuminate\Http\Request;

class LocationMasterController extends Controller
{
     /**
     * Get site location
     */
    public function index()
    {
        return response()->json([
            'data' => LocationMaster::latest()->get()
        ]);
    }

    /**
     * Create or Update site location (ADMIN only)
     */
    public function store(Request $request)
{
    $auth = auth()->user();

    if (!$auth || $auth->role !== 'admin') {
        return response()->json(['message' => 'Unauthorized'], 403);
    }

    $request->validate([
        'site_location' => 'required|string|max:255'
    ]);

    $location = LocationMaster::create([
        'site_location' => $request->site_location
    ]);

    return response()->json([
        'message' => 'Location added successfully',
        'data' => $location
    ], 201);
}

}
