<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Referral;
use Illuminate\Http\Request;

class ReferralController extends Controller
{
    public function myReferrals()
{
    $user = auth()->user();

    $referrals = Referral::where('assigned_to', $user->id)
        ->where('status', 'pending')
        ->get();

    return response()->json([
        'status' => true,
        'data' => $referrals
    ]);
}

    public function store(Request $request)
    {
        // print_r($request->referred_name);exit;
        $request->validate([
            'referred_name'    => 'required|string',
            'referred_contact' => 'required|string',
            'referred_email'   => 'nullable|email'
        ]);


        $customer = auth()->user();

        if ($customer->role !== 'customer') {
            return response()->json([
                'status' => false,
                'message' => 'Only customers can submit referrals'
            ], 403);
        }

        $referral = Referral::create([
            'referrer_id'     => $customer->id,
            'referred_name'   => $request->referred_name,
            'referred_contact'=> $request->referred_contact,
            'referred_email'  => $request->referred_email,
            'assigned_to'     => $customer->created_by,
            'status'          => 'pending'
        ]);

        return response()->json([
            'status' => true,
            'message' => 'Referral submitted successfully',
            'data' => $referral
        ]);
    }

        public function index(Request $request)
    {
        $user = auth()->user();

        $query = Referral::with(['referrer','assignedUser','booking']);

        // 🔐 Admin → See all
        if ($user->role === 'admin') {
            // no filter
        }

        // 🔹 Leader / Adviser → Only assigned referrals
        elseif (in_array($user->role, ['leader','adviser'])) {
            $query->where('assigned_to', $user->id);
        }

        // 🔹 Customer → Only their own referrals
        elseif ($user->role === 'customer') {
            $query->where('referrer_id', $user->id);
        }

        // 🔎 Optional Status Filter
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $referrals = $query->latest()->paginate(10);

        return response()->json([
            'status' => true,
            'data' => $referrals
        ]);
    }

        public function show($id)
    {
        $user = auth()->user();

        $referral = Referral::with(['referrer','assignedUser','booking'])
            ->findOrFail($id);

        // 🔐 Security Check

        if (
            $user->role !== 'admin' &&
            $referral->assigned_to !== $user->id &&
            $referral->referrer_id !== $user->id
        ) {
            return response()->json([
                'status' => false,
                'message' => 'Unauthorized'
            ], 403);
        }

        return response()->json([
            'status' => true,
            'data' => $referral
        ]);
}
    
}
