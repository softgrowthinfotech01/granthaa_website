<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ReferralSetting extends Model
{
    protected $fillable = [
        'user_id',
        'location_id',
        'type',
        'value'
    ];

    /*
    |--------------------------------------------------------------------------
    | Relationships
    |--------------------------------------------------------------------------
    */

    // Leader / Adviser
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Location (if you have model)
    public function location()
    {
        return $this->belongsTo(LocationMaster::class);
    }
}