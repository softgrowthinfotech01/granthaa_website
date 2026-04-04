<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\CommissionLedger;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CommissionPaymentController extends Controller
{

    /**
     * Create Payment Entry
     */
    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'booking_id' => 'required|exists:bookings,id',
            'amount' => 'required|numeric|min:1',
            'payment_mode' => 'nullable|string|max:50',
            'reference_no' => 'nullable|string|max:100',
            'remark' => 'nullable|string|max:255'
        ]);

        $userId = $request->user_id;
        $amount = $request->amount;

        // calculate balance
        $balance = $this->calculateSummary($userId)['balance'];

        if ($balance <= 0) {
            return response()->json([
                'status' => false,
                'message' => 'User has no commission balance'
            ], 400);
        }

        if ($amount > $balance) {
            return response()->json([
                'status' => false,
                'message' => 'Payment exceeds available commission balance',
                'available_balance' => $balance
            ], 400);
        }

        DB::beginTransaction();
        try{

        $payment = CommissionLedger::create([
            'user_id' => $userId,
            'booking_id' => $request->booking_id,
            'type' => 'payment',
            'amount' => -abs($amount),
            'payment_mode' => $request->payment_mode,
            'reference_no' => $request->reference_no,
            'remark' => $request->remark,
            'created_by' => auth()->user()->id
        ]);

        DB::commit();

        return response()->json([
            'status' => true,
            'message' => 'Payment recorded successfully',
            'data' => $payment
        ]);
        } catch (\Exception $e){
            DB::rollBack();

            return response()->json([
                'status' => false,
                'message' => 'Payment failed' 
            ], 500);
        }
    }


    /**
     * User Commission Summary
     */
    public function summary($userId)
    {
        $user = User::find($userId);

        if (!$user) {
            return response()->json([
                'status' => false,
                'message' => 'User not found'
            ], 404);
        }
        $summary = $this->calculateSummary($userId);

        return response()->json([
            'status' => true,
            'data' => $summary
        ]);
    }


    /**
     * Ledger List
     */
    public function ledger($userId, Request $request)
    {

        $user = User::find($userId);

        if (!$user) {
            return response()->json([
                'status' => false,
                'message' => 'User not found'
            ], 404);
        }

        $perPage = min(max((int)$request->get('per_page', 10), 1), 100);

        $query = CommissionLedger::where('user_id', $userId);

        if ($request->type) {
            $query->where('type', $request->type);
        }

        if ($request->search) {
            $query->where('remark', 'like', '%' . $request->search . '%');
        }

        if ($request->from_date) {
            $query->whereDate('created_at', '>=', $request->from_date);
        }

        if ($request->to_date) {
            $query->whereDate('created_at', '<=', $request->to_date);
        }

        $data = $query->with('user')->latest()->paginate($perPage);

        return response()->json([
            'status' => true,
            'data' => $data
        ]);
    }


    /**
     * Logged in user commission
     */
    public function myCommission()
    {
        $userId = auth()->id();

        return response()->json([
            'status' => true,
            'data' => $this->calculateSummary($userId)
        ]);
    }


    /**
     * Advisers Commission
     */
    public function advisersCommission(Request $request)
    {
        $leader = auth()->user();

        if (!in_array($leader->role, ['leader', 'admin'])) {
            return response()->json([
                'status' => false,
                'message' => 'Unauthorized'
            ]);
        }

        $perPage = min(max((int)$request->get('per_page', 10), 1), 100);

        $query = User::where('created_by', $leader->id)
            ->where('role', 'adviser');

        if ($request->search) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        $advisers = $query->paginate($perPage);

        $data = $advisers->getCollection()->map(function ($adv) {

            $summary = $this->calculateSummary($adv->id);

            return [
                'id' => $adv->id,
                'name' => $adv->name,
                'total_commission' => $summary['total_commission'],
                'total_paid' => $summary['total_paid'],
                'balance' => $summary['balance']
            ];
        });

        $advisers->setCollection($data);

        return response()->json([
            'status' => true,
            'data' => $advisers
        ]);
    }


    /**
     * Team Commission
     */
    public function teamCommission(Request $request)
    {
        $leader = auth()->user();

        $perPage = min(max((int)$request->get('per_page', 10), 1), 100);

        $query = User::where('id', $leader->id)
            ->orWhere('created_by', $leader->id);

        if ($request->search) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        $users = $query->paginate($perPage);

        $data = $users->getCollection()->map(function ($user) {

            $summary = $this->calculateSummary($user->id);

            return [
                'id' => $user->id,
                'name' => $user->name,
                'role' => $user->role,
                'total_commission' => $summary['total_commission'],
                'total_paid' => $summary['total_paid'],
                'balance' => $summary['balance']
            ];
        });

        $users->setCollection($data);

        return response()->json([
            'status' => true,
            'data' => $users
        ]);
    }


    /**
     * Payments created by particular admin/user
     */
    public function paymentsCreatedBy($userId, Request $request)
    {
        $perPage = min(max((int)$request->get('per_page', 10), 1), 100);

$query = CommissionLedger::with('booking')->with('users')
    ->where('created_by', $userId)
    ->where('type', 'payment')
    ->whereHas('booking');

        if ($request->search) {
            $query->where('reference_no', 'like', '%' . $request->search . '%');
        }

        $payments = $query->latest()->paginate($perPage);

        return response()->json([
            'status' => true,
            'data' => $payments
        ]);
    }

    /**
     * All Payments List
     */
    public function payments(Request $request)
    {
        $perPage = min(max((int)$request->get('per_page', 10), 1), 100);

        $query = CommissionLedger::where('type', 'payment');

        // search by reference or remark
        if ($request->search) {
            $query->where(function ($q) use ($request) {
                $q->where('reference_no', 'like', '%' . $request->search . '%')
                    ->orWhere('remark', 'like', '%' . $request->search . '%');
            });
        }

        // filter by user
        if ($request->user_id) {
            $query->where('user_id', $request->user_id);
        }

        // filter by payment mode
        if ($request->payment_mode) {
            $query->where('payment_mode', $request->payment_mode);
        }

        // date filters
        if ($request->from_date) {
            $query->whereDate('created_at', '>=', $request->from_date);
        }

        if ($request->to_date) {
            $query->whereDate('created_at', '<=', $request->to_date);
        }

        $payments = $query->with('user')->latest()->paginate($perPage);

        return response()->json([
            'status' => true,
            'data' => $payments
        ]);
    }


    /**
     * Helper function for summary
     */
    private function calculateSummary($userId)
    {
        $totalCommission = CommissionLedger::where('user_id', $userId)
            ->where('type', 'commission')
            ->sum('amount');

        $totalPaid = CommissionLedger::where('user_id', $userId)
            ->where('type', 'payment')
            ->sum('amount');

        return [
            'total_commission' => $totalCommission,
            'total_paid' => abs($totalPaid),
            'balance' => $totalCommission + $totalPaid
        ];
    }

    public function leaderAdviserDetails(Request $request)
{
    $leader = auth()->user();

    if ($leader->role !== 'leader') {
        return response()->json([
            'status' => false,
            'message' => 'Unauthorized'
        ]);
    }

    // 📌 1. Get advisers (for dropdown)
    $advisers = User::where('created_by', $leader->id)
        ->where('role', 'adviser')
        ->select('id', 'name')
        ->get();

    // 📌 2. Selected adviser
    $adviserId = $request->adviser_id ?? $advisers->first()?->id;

    $summary = null;
    $logs = [];

    if ($adviserId) {

        // 📊 Summary
        $totalPlots = Booking::where('adviser_id', $adviserId)->count();

        $totalAmount = Booking::where('adviser_id', $adviserId)
            ->sum('total_booking_amount');

        $totalCommission = Booking::where('adviser_id', $adviserId)
            ->sum('adviser_commission_amount');

        $paidAmount = abs(
        CommissionLedger::where('user_id', $adviserId)
        ->where('type', 'payment')
        ->sum('amount')
        );

        $summary = [
            'total_plots' => $totalPlots,
            'total_booking_amount' => round($totalAmount, 2),
            'total_commission' => round($totalCommission, 2),
            'paid_amount' => round($paidAmount, 2),
            'balance_amount' => round($totalCommission - $paidAmount, 2),
        ];

        // 📄 Logs (booking wise)
        $logs = Booking::where('adviser_id', $adviserId)
    ->select(
        'id as booking_id',
        'buyer_name as customer',
        'plot_number',
        'total_booking_amount as amount',
        'adviser_commission_amount as commission',
        'created_at'
    )
    ->latest()
    ->get()
    ->map(function ($row) use ($adviserId) {

        // ✅ Paid per booking
        $paid = CommissionLedger::where('user_id', $adviserId)
            ->where('booking_id', $row->booking_id)
            ->where('type', 'payment')
            ->sum('amount');

        return [
            'booking_id' => $row->booking_id,
            'customer' => $row->customer,
            'plot_number' => $row->plot_number,
            'amount' => round($row->amount, 2),
            'commission' => round($row->commission, 2),
            'paid' => round(abs($paid), 2),
            'balance' => round($row->commission - abs($paid), 2),
            'date' => date('Y-m-d', strtotime($row->created_at)),
        ];
    });

    }

    return response()->json([
        'status' => true,
        'data' => [
            'advisers' => $advisers,
            'selected_adviser' => $adviserId,
            'summary' => $summary,
            'logs' => $logs
        ]
    ]);
}
}
