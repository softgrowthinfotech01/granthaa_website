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
            'location_id' => 'required|exists:locations,id',
            'type'        => 'required|in:fixed,percentage',
            'value'       => 'required|numeric|min:0'
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
            'message' => 'Setting saved',
            'data' => $setting
        ]);
    }
}