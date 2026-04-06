<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\CommissionLedger;
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

        if ($auth->role == 'leader') {

            $leaderCommission = UserLocationCommission::where('user_id', $auth->id)
                ->where('location_id', $validated['location_id'])
                ->first();

            // Only validate if leader commission exists
            if (
                $leaderCommission &&
                $leaderCommission->commission_type != $validated['commission_type']
            ) {

                return response()->json([
                    'status' => false,
                    'message' => 'You can only assign ' . $leaderCommission->commission_type . ' commission'
                ], 422);
            }
        }
        
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

        // 🔐 Leader & admin can only see commissions of users created by them
        if ($auth->role === 'leader' || $auth->role === 'admin') {
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
     * Update Commission (Admin Only)
     */
    public function updateCommission(Request $request, $id)
    {
        $auth = auth()->user();

        if (!$auth || !in_array($auth->role, ['admin', 'leader'])) {
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

    /**
     * Delete Commission (Admin Only)
     */
    public function deleteCommission($id)
    {
        $auth = auth()->user();
        // echo $auth->role;die;

        if (!$auth || !in_array($auth->role, ['admin', 'leader'])) {
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

    // LOGGED USER COMMISSION
    public function myCommission()
    {

        $user = auth()->user();

        $totalCommission = CommissionLedger::where('user_id', $user->id)
            ->where('type', 'commission')
            ->sum('amount');

        $totalPaid = CommissionLedger::where('user_id', $user->id)
            ->where('type', 'payment')
            ->sum('amount');

        $balance = $totalCommission + $totalPaid;

        return response()->json([
            'status' => true,
            'data' => [
                'user_id' => $user->id,
                'name' => $user->name,
                'total_commission' => $totalCommission,
                'total_paid' => abs($totalPaid),
                'balance' => $balance
            ]
        ]);
    }


    // LEADER SEE ADVISERS COMMISSION
    public function advisersCommission()
    {

        $leader = auth()->user();

        if ($leader->role != 'leader') {
            return response()->json([
                'status' => false,
                'message' => 'Unauthorized'
            ], 403);
        }

        $advisers = User::where('created_by', $leader->id)
            ->where('role', 'adviser')
            ->get();

        $data = [];

        foreach ($advisers as $adv) {

            $totalCommission = CommissionLedger::where('user_id', $adv->id)
                ->where('type', 'commission')
                ->sum('amount');

            $totalPaid = CommissionLedger::where('user_id', $adv->id)
                ->where('type', 'payment')
                ->sum('amount');

            $balance = $totalCommission + $totalPaid;

            $data[] = [
                'id' => $adv->id,
                'name' => $adv->name,
                'total_commission' => $totalCommission,
                'total_paid' => abs($totalPaid),
                'balance' => $balance
            ];
        }

        return response()->json([
            'status' => true,
            'data' => $data
        ]);
    }


    // LEADER TEAM COMMISSION (LEADER + ADVISERS)
    public function teamCommission()
    {

        $leader = auth()->user();

        $users = User::where('id', $leader->id)
            ->orWhere('created_by', $leader->id)
            ->get();

        $data = [];

        foreach ($users as $user) {

            $totalCommission = CommissionLedger::where('user_id', $user->id)
                ->where('type', 'commission')
                ->sum('amount');

            $totalPaid = CommissionLedger::where('user_id', $user->id)
                ->where('type', 'payment')
                ->sum('amount');

            $balance = $totalCommission + $totalPaid;

            $data[] = [
                'id' => $user->id,
                'name' => $user->name,
                'role' => $user->role,
                'total_commission' => $totalCommission,
                'total_paid' => abs($totalPaid),
                'balance' => $balance
            ];
        }

        return response()->json([
            'status' => true,
            'data' => $data
        ]);
    }

    public function leaderBookings($leaderId)
    {
        $bookings = Booking::where(function ($q) use ($leaderId) {
            $q->where('leader_id', $leaderId)
                ->orWhere(function ($q2) use ($leaderId) {
                    $q2->where('created_by', $leaderId)
                        ->where('created_by_role', 'leader');
                });
        })->get();

        $data = [];

        foreach ($bookings as $b) {

            $totalCommission = $this->calculateBookingCommission($b->id, $leaderId);

            $paid = CommissionLedger::where('user_id', $leaderId)
                ->where('booking_id', $b->id)
                ->sum('amount');

            $paid = abs($paid); // convert negative to positive

            $balance = $totalCommission - $paid;

            $data[] = [
                'booking_id' => $b->id,
                'buyer_name' => $b->buyer_name,
                'plot_number' => $b->plot_number,
                'commission' => $totalCommission,
                'paid' => $paid,
                'balance' => $balance
            ];
        }

        return response()->json([
            'status' => true,
            'data' => $data
        ]);
    }
}
