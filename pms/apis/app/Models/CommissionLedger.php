<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CommissionLedger extends Model
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
