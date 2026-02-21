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
    ];

    public function leader()
    {
        return $this->belongsTo(User::class, 'user_code');
    }
}
