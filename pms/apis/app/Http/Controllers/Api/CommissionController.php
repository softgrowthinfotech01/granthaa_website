<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\UserLocationCommission;
use Illuminate\Http\Request;
use App\Models\User;

class CommissionController extends Controller
{


    public function setCommission(Request $request)
    {
        $auth = auth()->user();
        if (!$auth || !in_array($auth->role, ['admin', 'leader'])) {
            return response()->json([
                'message' => 'Only admin or leader can set commission'
            ], 403);
        }

        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'location_id' => 'required|exists:location_master,id',
            'commission_type' => 'required|in:percent,amount',
            'commission_value' => 'required|numeric|min:0'
        ]);

        // 🔥 Check user role
        $user = User::find($validated['user_id']);

        if (!in_array($user->role, ['leader', 'adviser'])) {
            return response()->json([
                'message' => 'Commission can only be set for Leader or Adviser'
            ], 422);
        }

        // Extra validation for percent
        if ($validated['commission_type'] === 'percent' && $validated['commission_value'] > 100) {
            return response()->json([
                'message' => 'Percentage cannot be more than 100'
            ], 422);
        }

        $commission = UserLocationCommission::updateOrCreate(
            [
                'user_id' => $validated['user_id'],
                'location_id' => $validated['location_id'],
            ],
            [
                'commission_type' => $validated['commission_type'],
                'commission_value' => $validated['commission_value'],
                'created_by' => $auth->id
            ]
        );

        return response()->json([
            'message' => 'Commission saved successfully',
            'data' => $commission
        ], 200);
    }


    /**
     * View all commissions (Admin)
     */
    public function index(Request $request)
    {
        $auth = auth()->user();

        if (!$auth || !in_array($auth->role, ['admin', 'leader'])) {
            return response()->json([
                'message' => 'Only admin or leader can view commissions'
            ], 403);
        }

        $query = UserLocationCommission::with(['user', 'location']);

        // 🔐 Leader can only see commissions of users created by them
        if ($auth->role === 'leader') {
            $userIds = User::where('created_by', $auth->id)->pluck('id');
            $query->whereIn('user_id', $userIds);
        }

        // 🔎 Search (by user name or location name)
        if ($request->filled('search')) {
            $search = $request->search;

            $query->where(function ($q) use ($search) {
                $q->whereHas('user', function ($u) use ($search) {
                    $u->where('name', 'like', "%{$search}%");
                })
                    ->orWhereHas('location', function ($l) use ($search) {
                        $l->where('site_location', 'like', "%{$search}%");
                    });
            });
        }

        // 🎯 Filter by user
        if ($request->filled('user_id')) {
            $query->where('user_id', $request->user_id);
        }

        // 📍 Filter by location
        if ($request->filled('location_id')) {
            $query->where('location_id', $request->location_id);
        }

        // 💰 Filter by commission type
        if ($request->filled('commission_type')) {
            $query->where('commission_type', $request->commission_type);
        }

        // 📅 Date range filter
        if ($request->filled('from_date') && $request->filled('to_date')) {
            $query->whereBetween('created_at', [
                $request->from_date,
                $request->to_date
            ]);
        }

        $perPage = $request->per_page ?? 10;

        $commissions = $query->latest()
            ->paginate($perPage)
            ->withQueryString();

        return response()->json([
            'message' => 'Fetched successfully',
            'data' => $commissions
        ]);
    }

    public function getByUser(Request $request, $userId)
{
    $auth = auth()->user();

    if (!$auth || $auth->role !== 'admin') {
        return response()->json([
            'message' => 'Only admin allowed'
        ], 403);
    }

    $query = UserLocationCommission::with('location')
        ->where('user_id', $userId);

    // Filter by commission type
    if ($request->filled('commission_type')) {
        $query->where('commission_type', $request->commission_type);
    }

    // Date filter
    if ($request->filled('from_date') && $request->filled('to_date')) {
        $query->whereBetween('created_at', [
            $request->from_date,
            $request->to_date
        ]);
    }

    $perPage = $request->per_page ?? 10;

    $commissions = $query->latest()
                         ->paginate($perPage)
                         ->withQueryString();

    return response()->json([
        'message' => 'Fetched successfully',
        'data' => $commissions
    ]);
}

    public function myCommissions()
{
    $user = auth()->user();

    // ✅ Leader → commissions assigned by him
    if ($user->role === 'leader') {

        $commissions = \App\Models\Commission::with('location')
            ->where('created_by', $user->id)
            ->get();
    }

    // ✅ Adviser → commissions assigned TO him
    elseif ($user->role === 'adviser') {

        $commissions = \App\Models\Commission::with('location')
            ->where('user_id', $user->id)
            ->get();
    }

    // ✅ Admin → optional
    else {
        $commissions = \App\Models\Commission::with('location')->get();
    }

    return response()->json([
        'status' => true,
        'data' => $commissions
    ]);
}

    /**
     * Update Commission (Admin Only)
     */
    public function updateCommission(Request $request, $id)
    {
        $auth = auth()->user();

        if (!$auth || $auth->role !== 'admin') {
            return response()->json([
                'message' => 'Only admin allowed'
            ], 403);
        }

        $query = UserLocationCommission::with('location')
            ->where('user_id', $userId);

        // Filter by commission type
        if ($request->filled('commission_type')) {
            $query->where('commission_type', $request->commission_type);
        }

        // Date filter
        if ($request->filled('from_date') && $request->filled('to_date')) {
            $query->whereBetween('created_at', [
                $request->from_date,
                $request->to_date
            ]);
        }

        $perPage = $request->per_page ?? 10;

        $commissions = $query->latest()
            ->paginate($perPage)
            ->withQueryString();

        return response()->json([
            'message' => 'Fetched successfully',
            'data' => $commissions
        ]);
    }

    public function myCommissions(Request $request)
    {
        $auth = auth()->user();

        if (!$auth) {
            return response()->json([
                'message' => 'Unauthenticated'
            ], 401);
        }

        $query = UserLocationCommission::with('location')
            ->where('user_id', $auth->id);

        // Filter by commission type
        if ($request->filled('commission_type')) {
            $query->where('commission_type', $request->commission_type);
        }

        // Date filter
        if ($request->filled('from_date') && $request->filled('to_date')) {
            $query->whereBetween('created_at', [
                $request->from_date,
                $request->to_date
            ]);
        }

        $perPage = $request->per_page ?? 10;

        $commissions = $query->latest()
            ->paginate($perPage)
            ->withQueryString();

        return response()->json([
            'message' => 'Fetched successfully',
            'data' => $commissions
        ]);
    }

    /**
     * Update Commission (Admin and Leader Only)
     */
    public function updateCommission(Request $request, $id)
    {
        $auth = auth()->user();

        if (!$auth || !in_array($auth->role, ['admin', 'leader'])) {
            return response()->json([
                'message' => 'Only admin or leader can update commission'
            ], 403);
        }

        $commission = UserLocationCommission::find($id);

        if (!$commission) {
            return response()->json([
                'message' => 'Commission not found'
            ], 404);
        }

        $validated = $request->validate([
            'commission_type' => 'required|in:percent,amount',
            'commission_value' => 'required|numeric|min:0'
        ]);

        // Extra validation for percent
        if ($validated['commission_type'] === 'percent' && $validated['commission_value'] > 100) {
            return response()->json([
                'message' => 'Percentage cannot be more than 100'
            ], 422);
        }

        $commission->update([
            'commission_type' => $validated['commission_type'],
            'commission_value' => $validated['commission_value'],
            'updated_by' => $auth->id ?? null
        ]);

        return response()->json([
            'message' => 'Commission updated successfully',
            'data' => $commission
        ], 200);
    }


    public function show($id)
    {
        $auth = auth()->user();

        if (!$auth || !in_array($auth->role, ['admin', 'leader'])) {
            return response()->json([
                'message' => 'Only admin and leader can view the commission of all users'
            ], 403);
        }

        $commission = UserLocationCommission::find($id);

        if (!$commission) {
            return response()->json([
                'message' => 'Commission not found'
            ], 404);
        }

        return response()->json([
            'message' => 'Fetched successfully',
            'data' => $commission
        ]);
    }

    /**
     * Delete Commission (Admin Only)
     */
    public function deleteCommission($id)
    {
        $auth = auth()->user();

        if (!$auth || !in_array($auth->role, ['admin', 'leader'])) {
            return response()->json([
                'message' => 'Only admin and leader can delete commission'
            ], 403);
        }

        $commission = UserLocationCommission::find($id);

        if (!$commission) {
            return response()->json([
                'message' => 'Commission not found'
            ], 404);
        }

        $commission->delete();

        return response()->json([
            'message' => 'Commission deleted successfully'
        ], 200);
    }
}
