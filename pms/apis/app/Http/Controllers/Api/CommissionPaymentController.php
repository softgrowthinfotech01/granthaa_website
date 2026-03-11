<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\CommissionLedger;
use App\Models\User;
use Illuminate\Http\Request;

class CommissionPaymentController extends Controller
{

    /**
     * Create Payment Entry
     */
    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'amount' => 'required|numeric|min:1'
        ]);

        $userId = $request->user_id;
        $amount = $request->amount;

        // calculate balance
        $balance = CommissionLedger::where('user_id', $userId)->sum('amount');

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

        $payment = CommissionLedger::create([
            'user_id' => $userId,
            'type' => 'payment',
            'amount' => -abs($amount),
            'payment_mode' => $request->payment_mode,
            'reference_no' => $request->reference_no,
            'remark' => $request->remark,
            'created_by' => auth()->id()
        ]);

        return response()->json([
            'status' => true,
            'message' => 'Payment recorded successfully',
            'data' => $payment
        ]);
    }


    /**
     * User Commission Summary
     */
    public function summary($userId)
    {
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
        $perPage = min($request->get('per_page', 10), 100);

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

        $data = $query->latest()->paginate($perPage);

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

        if ($leader->role !== 'leader') {
            return response()->json([
                'status' => false,
                'message' => 'Unauthorized'
            ]);
        }

        $perPage = min($request->get('per_page', 10), 100);

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

        $perPage = min($request->get('per_page', 10), 100);

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
        $perPage = min($request->get('per_page', 10), 100);

        $query = CommissionLedger::where('created_by', $userId)
            ->where('type', 'payment');

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
        $perPage = min($request->get('per_page', 10), 100);

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
}
