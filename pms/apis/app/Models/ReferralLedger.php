<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ReferralLedger extends Model
{
    protected $fillable = [
        'user_id',
        'booking_id',
        'type',
        'amount',
        'payment_mode',
        'reference_no',
        'remark',
        'created_by'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function booking()
    {
        return $this->belongsTo(Booking::class);
    }
}

$setting = ReferralSetting::where('user_id', $leaderId)
    ->where('location_id', $booking->location_id)
    ->first();

if ($setting) {

    ReferralLedger::create([
        'user_id' => $leaderId,
        'booking_id' => $booking->id,
        'type' => 'incentive',
        'amount' => $setting->incentive_amount,
        'created_by' => auth()->id()
    ]);

    ReferralLedger::create([
    'user_id' => $leaderId,
    'booking_id' => 0, // payment entry
    'type' => 'payment',
    'amount' => -$request->amount,
    'payment_mode' => $request->payment_mode,
    'reference_no' => $request->reference_no,
    'created_by' => auth()->id()
]);


public static function getSummary($userId)
{
    return [
        'total_earned' => self::where('user_id', $userId)
            ->where('type', 'incentive')
            ->sum('amount'),

        'total_paid' => abs(self::where('user_id', $userId)
            ->where('type', 'payment')
            ->sum('amount')),

        'balance' => self::where('user_id', $userId)
            ->sum('amount')
    ];
}
}