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

        $payment = CommissionLedger::create([
            'user_id' => $request->user_id,
            'type' => 'payment',
            'amount' => -abs($request->amount),
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
    public function ledger($userId)
    {
        $data = CommissionLedger::where('user_id', $userId)
            ->latest()
            ->paginate(50);

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
    public function advisersCommission()
    {
        $leader = auth()->user();

        if ($leader->role !== 'leader') {
            return response()->json([
                'status' => false,
                'message' => 'Unauthorized'
            ]);
        }

        $advisers = User::where('created_by', $leader->id)
            ->where('role', 'adviser')
            ->get();

        $data = $advisers->map(function ($adv) {

            $summary = $this->calculateSummary($adv->id);

            return [
                'id' => $adv->id,
                'name' => $adv->name,
                'total_commission' => $summary['total_commission'],
                'total_paid' => $summary['total_paid'],
                'balance' => $summary['balance']
            ];
        });

        return response()->json([
            'status' => true,
            'data' => $data
        ]);
    }


    /**
     * Team Commission
     */
    public function teamCommission()
    {
        $leader = auth()->user();

        $users = User::where('id', $leader->id)
            ->orWhere('created_by', $leader->id)
            ->get();

        $data = $users->map(function ($user) {

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

        return response()->json([
            'status' => true,
            'data' => $data
        ]);
    }


    /**
     * Payments created by particular admin/user
     */
    public function paymentsCreatedBy($userId)
    {
        $payments = CommissionLedger::where('created_by', $userId)
            ->where('type', 'payment')
            ->latest()
            ->paginate(50);

        return response()->json([
            'status' => true,
            'data' => $payments
        ]);
    }


    /**
     * All Payments List
     */
    public function payments()
    {
        $payments = CommissionLedger::where('type', 'payment')
            ->latest()
            ->paginate(50);

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