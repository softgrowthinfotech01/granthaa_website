<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_code',
        'buyer_name',
        'mobile',
        'dob',
        'email',
        'pan_number',
        'aadhar_number',
        'address',
        'city',
        'state',
        'pincode',
        'advance_amount',
        'site_location',
        'commission_type',
        'commission_value',
        'commission_amount',
        'project_name',
        'plot_number',
        'khasara_number',
        'ph_number',
        'mouza',
        'tahsil',
        'district',
        'square_feet',
        'square_meter',
        'total_booking_amount',
        'payment_mode',
        'remark',
        'created_by',
        'created_by_role',
        'leader_id',
        'adviser_id',
        'leader_commission_type',
        'leader_commission_value',
        'leader_commission_amount',
        'adviser_commission_type',
        'adviser_commission_value',
        'adviser_commission_amount',
    ];

    public function leader()
    {
        return $this->belongsTo(User::class, 'user_code');
    }
    public function adviser()
    {
        return $this->belongsTo(User::class, 'user_code');
    }

    public function booking()
    {
        return $this->belongsTo(User::class, 'user_code', 'email');
    }

    // If booking is from referral
    public function referral()
    {
        return $this->hasOne(Referral::class, 'booking_id');
    }

    public function ledgerEntries()
    {
        return $this->hasMany(CommissionLedger::class);
    }

    public function location()
    {
        return $this->belongsTo(LocationMaster::class, 'site_location');
    }
}
