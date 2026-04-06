<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\ReferralSetting;
use Illuminate\Http\Request;

class ReferralSettingController extends Controller
{
    public function store(Request $request)
    {
    $request->validate([
    'location_id'    => 'required|exists:location_master,id',
    'target_user_id' => 'nullable|exists:users,id', // can be null for general
    'type'           => 'required|in:amount,percent',
    'value'          => 'required|numeric|min:0'
]);

        $user = auth()->user();

        if (!in_array($user->role, ['leader', 'adviser'])) {
            return response()->json([
                'status' => false,
                'message' => 'Unauthorized'
            ], 403);
        }

$setting = ReferralSetting::updateOrCreate(
    [
        'user_id'        => $user->id,
        'location_id'    => $request->location_id,
        'target_user_id' => $request->target_user_id
    ],
    [
        'type'  => $request->type,
        'value' => $request->value
    ]
);

        return response()->json([
            'status' => true,
            'message' => 'Setting saved',
            'data' => $setting
        ]);
    }

    public function index() {

    $user = auth()->user();

    $query = ReferralSetting::with(['user', 'location', 'referal']);
    
    // Customer → get their assigned settings
    if($user->role === "customer"){
        $query->where('target_user_id', $user->id);
    }

    // Leader / Adviser → their own settings
    if(in_array($user->role, ["leader", "adviser"])){
        $query->where('user_id', $user->id);
    }

    $data = $query->get();

    return response()->json([
        'status' => true,
        'data' => $data
    ]);
}
}