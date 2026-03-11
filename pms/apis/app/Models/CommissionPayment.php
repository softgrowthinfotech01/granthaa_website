<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CommissionPayment extends Model
{
    protected $fillable = [
        'user_id',
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
}
