<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     * 
     * @var list<string>
     */
    protected $fillable = [
    'name',
    'user_code',
    'first_name',
    'last_name',
    'age',
    'gender',
    'profile_image',
    'contact_no',
    'email',
    'aadhaar_number',
    'city',
    'state',
    'address',
    'pin_code',
    'password',
    'role',
    'pancard_number',
    'bank_name',
    'bank_branch',
    'bank_account_no',
    'bank_ifsc_code',
    'created_by',
    'wallet_balance'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }


    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function children()
    {
        return $this->hasMany(User::class, 'created_by');
    }

    public function bookings()
    {
        return $this->hasMany(Booking::class, 'created_by');
    }

    public function advisers()
    {
        return $this->hasMany(User::class, 'user_code');
    }

    public function leader()
    {
        return $this->hasMany(User::class, 'user_code');
    }

    public function locationCommissions()
    {
        return $this->hasMany(UserLocationCommission::class, 'user_id', 'id');
    }

     // Referrals made by this customer
    public function referralsMade()
    {
        return $this->hasMany(Referral::class, 'referrer_id');
    }

    // Referrals assigned to this leader/adviser
    public function referralsAssigned()
    {
        return $this->hasMany(Referral::class, 'assigned_to');
    }

    // Wallet transactions
    public function walletTransactions()
    {
        return $this->hasMany(WalletTransaction::class, 'user_id');
    }

    // commission payments 

    public function commissionPayments()
    {
        return $this->hasMany(CommissionPayment::class);
    }

    public function totalCommission()
    {
        return Booking::where('leader_id', $this->id)
            ->sum('leader_commission_amount');
    }

    public function totalPaid()
    {
        return $this->commissionPayments()->sum('amount');
    }

    public function commissionBalance()
    {
        return $this->totalCommission() - $this->totalPaid();
    }

    public function ledger()
    {
        return $this->hasMany(CommissionLedger::class);
    }

    public function commissionSummary()
{

$totalCommission = $this->ledger()
->where('type','commission')
->sum('amount');

$totalPaid = $this->ledger()
->where('type','payment')
->sum('amount');

$balance = $totalCommission + $totalPaid;

return [
'total_commission'=>$totalCommission,
'total_paid'=>abs($totalPaid),
'balance'=>$balance
];

}

public function getProfileImageUrlAttribute()
{
    if (!$this->profile_image) {
        return null;
    }

    return asset('storage/' . $this->profile_image);
}

}
