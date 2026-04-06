<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Referral extends Model
{
    use HasFactory;

    protected $fillable = [
    'referrer_id',
    'referred_name',
    'referred_contact',
    'referred_email',
    'assigned_to',
    'status',
    'booking_id',
    'incentive_amount',

    // 🔥 NEW
    'incentive_type',
    'incentive_value',
    'location_id'
];

    /*
    |--------------------------------------------------------------------------
    | Relationships
    |--------------------------------------------------------------------------
    */

    // Customer who referred
    public function referrer()
    {
        return $this->belongsTo(User::class, 'referrer_id');
    }

    // Leader/Adviser who handles referral
    public function assignedUser()
    {
        return $this->belongsTo(User::class, 'assigned_to');
    }

    // Converted booking
    public function booking()
    {
        return $this->belongsTo(Booking::class, 'booking_id');
    }
    
    // Converted booking
    public function reflocation()
    {
        return $this->belongsTo(LocationMaster::class, 'booking_id');
    }


}