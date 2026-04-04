<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ReferralSetting extends Model
{
   protected $fillable = [
    'user_id',         // Leader/Adviser who sets
    'target_user_id',  // Customer/Adviser who gets incentive
    'location_id',
    'type',
    'value'
];

// Relationship to target user
public function targetUser()
{
    return $this->belongsTo(User::class, 'target_user_id');
}

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