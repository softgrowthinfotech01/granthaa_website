<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Referral;
use App\Models\ReferralLedger;
use App\Models\ReferralSetting;
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
    $request->merge([
        'referred_email' => strtolower($request->referred_email)
    ]);

    $request->validate([
        'referred_name'    => 'required|string',
        'referred_contact' => 'required|string',
        'referred_email'   => 'nullable|email',
        'location_id'      => 'required|exists:location_master,id' // 🔥 NEW
    ]);

    $customer = auth()->user();

    if ($customer->role !== 'customer') {
        return response()->json([
            'status' => false,
            'message' => 'Only customers can submit referrals'
        ], 403);
    }

    // ❌ Prevent duplicate referral
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

    // ❌ Prevent self referral
    if ($request->referred_contact == $customer->contact_no) {
        return response()->json([
            'status' => false,
            'message' => 'You cannot refer yourself'
        ], 400);
    }

    // 🔥 GET LEADER
    $leaderId = $customer->created_by;

    // 🔥 FETCH INCENTIVE SETTING
$setting = ReferralSetting::where('location_id', $request->location_id)
    ->where(function ($q) use ($customer) {
        $q->where('target_user_id', $customer->id)
          ->orWhereNull('target_user_id');
    })
    ->orderByRaw('target_user_id IS NULL')
    ->first();

    // 🔥 CREATE REFERRAL WITH SNAPSHOT
$referral = Referral::create([
    'referrer_id'      => $customer->id,
    'referred_name'    => $request->referred_name,
    'referred_contact' => $request->referred_contact,
    'referred_email'   => $request->referred_email,
    'assigned_to'      => $leaderId,
    'status'           => 'pending',
    'incentive_type'   => $setting->type ?? null,
    'incentive_value'  => $setting->value ?? 0,
    'location_id'  => $request->location_id ?? null
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

        $query = Referral::with(['referrer', 'assignedUser', 'booking', 'reflocation']);

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

    public function payReferral(Request $request)
    {
        $request->validate([
            'user_id' => 'required',
            'amount' => 'required|numeric'
        ]);

        ReferralLedger::create([
            'user_id' => $request->user_id,
            'booking_id' => 0,
            'type' => 'payment',
            'amount' => -$request->amount,
            'payment_mode' => $request->payment_mode,
            'reference_no' => $request->reference_no,
            'created_by' => auth()->id()
        ]);

        return response()->json([
            'message' => 'Referral payment done'
        ]);
    }

public function saveSetting(Request $request)
{
    $request->validate([
        'location_id' => 'required|exists:location_master,id',
        'type'        => 'required|in:fixed,percentage',
        'value'       => 'required|numeric|min:0'
    ]);

    $user = auth()->user();

    // 🔐 Only leader or adviser allowed
    if (!in_array($user->role, ['leader', 'adviser'])) {
        return response()->json([
            'status' => false,
            'message' => 'Unauthorized'
        ], 403);
    }

    // 🔁 Update or Create
    $setting = ReferralSetting::updateOrCreate(
        [
            'user_id'     => $user->id,
            'location_id' => $request->location_id
        ],
        [
            'type'  => $request->type,
            'value' => $request->value
        ]
    );

    return response()->json([
        'status' => true,
        'message' => 'Referral incentive saved successfully',
        'data' => $setting
    ]);
}
public function wallet()
{
    $user = auth()->user();

    $summary = ReferralLedger::getSummary($user->id);

    return response()->json([
        'status' => true,
        'data' => $summary
    ]);
}

public function ledger(Request $request)
{
    $user = auth()->user();

    $perPage = $request->per_page ?? 10;

    $data = ReferralLedger::where('user_id', $user->id)
        ->latest()
        ->paginate($perPage);

    return response()->json([
        'status' => true,
        'data' => $data
    ]);
}
}
