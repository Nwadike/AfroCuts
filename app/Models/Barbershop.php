<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
// Removed: use App\Models\Service; // No longer needed
use App\Models\Booking; // Import the Booking model
use App\Models\User; // Import the User model

class Barbershop extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'name',
        'description',
        'address',
        'city',
        'state',
        'zip_code',
        'phone',
        'email',
        'website',
        'instagram',
        'facebook',
        'logo',
        'working_hours', // Still needed for display/booking logic
        'rating', // Added rating field
        'google_maps_url', // Added Google Maps URL field
        'gallery', // Added gallery field (JSON)
        'is_approved', // Assuming you have an approval status
        'services', // Added services JSON column
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'working_hours' => 'array', // Assuming working_hours is still a JSON column
        'gallery' => 'array', // Cast the gallery JSON column to an array
        'is_approved' => 'boolean', // Cast approval status to boolean
        'services' => 'array', // Cast the services JSON column to an array
    ];

    /**
     * Get the user that owns the barbershop.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

     /**
      * Get the bookings for the barbershop.
      */
     public function bookings()
     {
         return $this->hasMany(Booking::class);
     }

     // Removed: public function services() { ... } // Relationship is no longer needed

     public function ratings()
    {
    return $this->hasMany(Rating::class);
    }

    public function averageRating()
    {
    return $this->ratings()->avg('rating');
    }

    public function ratingBreakdown()
    {
    return $this->ratings()
        ->selectRaw('rating, COUNT(*) as count')
        ->groupBy('rating')
        ->pluck('count', 'rating')
        ->all();
    }

    public function favoritedBy()
    {
        return $this->belongsToMany(User::class, 'favorites')->withTimestamps();
    }



}
