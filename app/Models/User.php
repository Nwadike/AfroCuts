<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use App\Models\Barbershop; // Import Barbershop model
use App\Models\Booking; // Import Booking model


class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'account_type', // Added account_type
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    /**
     * Get the barbershop associated with the user (if they are a business user).
     */
    public function barbershop()
    {
        return $this->hasOne(Barbershop::class);
    }

     /**
      * Get the bookings made by the user (if they are a regular user).
      */
     public function bookings()
     {
         return $this->hasMany(Booking::class);
     }

    /**
     * Check if the user is a business account.
     *
     * @return bool
     */
    public function isBusiness()
    {
        return $this->account_type === 'business';
    }

     /**
      * Check if the user is a regular account.
      *
      * @return bool
      */
     public function isRegular()
     {
         return $this->account_type === 'regular';
     }
}
