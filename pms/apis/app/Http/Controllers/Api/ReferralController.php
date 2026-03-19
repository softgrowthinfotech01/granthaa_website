<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Referral;
use App\Models\User;
use Illuminate\Http\Request;

class ReferralController extends Controller
{
    public function myReferrals(Request $request)
{
    $user = auth()->user();

    $query = Referral::query();

    // 🔐 ROLE BASED FILTER
    if ($user->role === 'adviser') {
        $query->where('assigned_to', $user->id);
    } elseif ($user->role === 'leader') {

        // leader sees team referrals
        $teamIds = User::where('created_by', $user->id)
            ->pluck('id')
            ->push($user->id);

        $query->whereIn('assigned_to', $teamIds);
    } elseif ($user->role === 'customer') {
        $query->where('referrer_id', $user->id);
    }

    // 🔎 STATUS FILTER (optional)
    if ($request->filled('status')) {
        $query->where('status', $request->status);
    }

    // 🔎 SEARCH
    if ($request->filled('search')) {
        $search = $request->search;

        $query->where(function ($q) use ($search) {
            $q->where('referred_name', 'like', "%$search%")
              ->orWhere('referred_contact', 'like', "%$search%")
              ->orWhere('referred_email', 'like', "%$search%");
        });
    }

    // 📄 PAGINATION
    $perPage = $request->per_page ?? 10;

    $referrals = $query->latest()->paginate($perPage);

    return response()->json([
        'status' => true,
        'data' => $referrals
    ]);
}

    public function store(Request $request)
    {
        // print_r($request->referred_name);exit;
        $request->merge([
            'referred_email' => strtolower($request->referred_email)
        ]);
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

        $existingReferral = Referral::where(function ($query) use ($request) {
            $query->where('referred_contact', $request->referred_contact)
                ->orWhere('referred_email', $request->referred_email);
        })
            ->where('status', 'pending')
            ->exists();

        if ($existingReferral) {
            return response()->json([
                'status' => false,
                'message' => 'This lead is already referred'
            ], 422);
        }

        if ($request->referred_contact == $customer->contact_no) {
            return response()->json([
                'status' => false,
                'message' => 'You cannot refer yourself'
            ], 400);
        }

        $referral = Referral::create([
            'referrer_id'     => $customer->id,
            'referred_name'   => $request->referred_name,
            'referred_contact' => $request->referred_contact,
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

        $query = Referral::with(['referrer', 'assignedUser', 'booking']);

        // 🔐 Admin → See all
        if ($user->role === 'admin') {
            // no filter
        }

        // 🔹 Leader / Adviser → Only assigned referrals
        elseif (in_array($user->role, ['leader', 'adviser'])) {
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

        $referral = Referral::with(['referrer', 'assignedUser', 'booking'])
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
