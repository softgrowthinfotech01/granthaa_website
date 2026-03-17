<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
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
    public function summary()
    {
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
    public function ledger($ Request $request)
    {

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
    public function paymentsCreatedBy(Request $request)
    {
        $perPage = min(max((int)$request->get('per_page', 10), 1), 100);

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
}
