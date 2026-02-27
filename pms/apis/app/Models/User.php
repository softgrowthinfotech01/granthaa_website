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
    'created_by'
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
        return $this->hasMany(Booking::class, 'user_code', 'user_code');
    }

    public function advisers()
    {
        return $this->hasMany(User::class, 'user_code');
    }
}
