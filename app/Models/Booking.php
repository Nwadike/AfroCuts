<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'barbershop_id',
        'date',
        'time_slot',
        'services', // Stored as JSON array of objects {id, name, price, staff_name} - will now come from Barbershop's JSON
        'total_amount',
        'notes',
        'status',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'date' => 'date',
        'services' => 'array', // Cast the services array of objects to JSON
    ];

    /**
     * Get the user that owns the booking.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the barbershop that the booking is for.
     */
    public function barbershop()
    {
        return $this->belongsTo(Barbershop::class);
    }
    
}
