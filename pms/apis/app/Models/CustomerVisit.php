<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CustomerVisit extends Model
{
    protected $fillable = [
        'name',
        'email',
        'contact_no',
        'aadhaar_number',
        'gender',
        'address',
        'site_location',
        'photo',
        'remark',
        'created_by',
        'released',
        'visited_at'
    ];

     // Relations
    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function location()
    {
        return $this->belongsTo(LocationMaster::class, 'site_location');
    }
}
