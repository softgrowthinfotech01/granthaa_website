<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserLocationCommission extends Model
{
   protected $fillable = [
    'user_id',
    'location_id',
    'commission_type',
    'commission_value',
    'created_by'
];

public function user()
{
    return $this->belongsTo(\App\Models\User::class);
}

public function location()
{
    return $this->belongsTo(\App\Models\LocationMaster::class, 'id');
}
}
