<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'barbershop_id',
        'name',
        'price',
        'staff_name', // Store staff name directly for simplicity initially
    ];

    /**
     * Get the barbershop that the service belongs to.
     */
    public function barbershop()
    {
        return $this->belongsTo(Barbershop::class);
    }

    // You might add a relationship to a Staff model later if you create one
    // public function staff()
    // {
    //     return $this->belongsTo(Staff::class);
    // }
}
