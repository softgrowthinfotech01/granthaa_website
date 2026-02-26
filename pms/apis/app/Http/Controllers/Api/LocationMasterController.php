<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\LocationMaster;
use Illuminate\Http\Request;

class LocationMasterController extends Controller
{

   public function index(Request $request)
{
    $query = LocationMaster::query();

    // Search filter
    if ($request->search) {
        $query->where('site_location', 'like', '%' . $request->search . '%');
    }

    $query->orderBy('id', 'desc');

    // ✅ If per_page exists → paginate
    if ($request->has('per_page')) {
        $locations = $query->paginate($request->per_page);

        return response()->json([
            'data' => $locations
        ]);
    }

    // ✅ Otherwise return ALL
    $locations = $query->get();

    return response()->json([
        'data' => $locations
    ]);
}
    /**
     * Get single site location (ADMIN only)
     */
    public function show($id)
    {
        $auth = auth()->user();

        if (!$auth || !in_array($auth->role, ['admin', 'leader'])) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        $location = LocationMaster::find($id);

        if (!$location) {
            return response()->json(['message' => 'Location not found'], 404);
        }

        return response()->json([
            'data' => $location
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

    /**
     * Update site location (ADMIN only)
     */
    public function update(Request $request, $id)
    {
        $auth = auth()->user();

        if (!$auth || $auth->role !== 'admin') {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        $location = LocationMaster::find($id);

        if (!$location) {
            return response()->json(['message' => 'Location not found'], 404);
        }

        $request->validate([
            'site_location' => 'required|string|max:255'
        ]);

        $location->update([
            'site_location' => $request->site_location
        ]);

        return response()->json([
            'status' => true,
            'message' => 'Location updated successfully',
            'data' => $location
        ]);
    }

    /**
     * Delete site location (ADMIN only)
     */
    public function destroy($id)
    {
        $auth = auth()->user();

        if (!$auth || $auth->role !== 'admin') {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        $location = LocationMaster::find($id);

        if (!$location) {
            return response()->json(['message' => 'Location not found'], 404);
        }

        $location->delete();

        return response()->json([
            'message' => 'Location deleted successfully'
        ]);
    }
}
