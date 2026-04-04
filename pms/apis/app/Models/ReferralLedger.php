<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ReferralLedger extends Model
{

    protected $table = 'referral_ledger';
    
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