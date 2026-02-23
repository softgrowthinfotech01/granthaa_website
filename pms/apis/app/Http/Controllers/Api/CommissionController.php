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
    public function index()
    {
        $auth = auth()->user();

        if (!$auth || $auth->role !== 'admin') {
            return response()->json([
                'message' => 'Only admin can view commissions'
            ], 403);
        }

        $commissions = UserLocationCommission::with(['user', 'location'])
            ->latest()
            ->paginate(10);

        return response()->json([
            'message' => 'Fetched successfully',
            'current_page' => $commissions->currentPage(),
            'total_pages' => $commissions->lastPage(),
            'total_records' => $commissions->total(),
            'data' => $commissions->items()
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

        $perPage = $request->get('per_page', 10);

        $commissions = UserLocationCommission::with('location')
            ->where('user_id', $userId)
            ->paginate($perPage);

        return response()->json([
            'message' => 'Fetched successfully',
            'current_page' => $commissions->currentPage(),
            'total_pages' => $commissions->lastPage(),
            'total_records' => $commissions->total(),
            'data' => $commissions->items()
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

        $perPage = $request->get('per_page', 10);

        $commissions = UserLocationCommission::with('location')
            ->where('user_id', $auth->id)
            ->paginate($perPage);

        return response()->json([
            'message' => 'Fetched successfully',
            'current_page' => $commissions->currentPage(),
            'total_pages' => $commissions->lastPage(),
            'total_records' => $commissions->total(),
            'data' => $commissions->items()
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
            'message' => 'Only admin can update commission'
        ], 403);
    }

    $commission = UserLocationCommission::find($id);

    if (!$commission) {
        return response()->json([
            'message' => 'Commission not found'
        ], 404);
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
    if ($validated['commission_type'] === 'percent' 
        && $validated['commission_value'] > 100) {
        return response()->json([
            'message' => 'Percentage cannot be more than 100'
        ], 422);
    }

    $commission->update([
        'user_id' => $validated['user_id'],
        'location_id' => $validated['location_id'],
        'commission_type' => $validated['commission_type'],
        'commission_value' => $validated['commission_value'],
        'updated_by' => $auth->id
    ]);

    return response()->json([
        'message' => 'Commission updated successfully',
        'data' => $commission
    ], 200);
}
    /**
     * Delete Commission (Admin Only)
     */
    public function deleteCommission($id)
    {
        $auth = auth()->user();

        if (!$auth || $auth->role !== 'admin') {
            return response()->json([
                'message' => 'Only admin can delete commission'
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

    public function show($id)
{
    $auth = auth()->user();

    if (!$auth || $auth->role !== 'admin') {
        return response()->json([
            'message' => 'Only admin can view commission'
        ], 403);
    }

    $commission = UserLocationCommission::with(['user', 'location'])
        ->find($id);

    if (!$commission) {
        return response()->json([
            'message' => 'Commission not found'
        ], 404);
    }

    return response()->json([
        'message' => 'Commission fetched successfully',
        'data' => $commission
    ], 200);
}
}
