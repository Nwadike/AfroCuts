<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Barbershop; // Import the Barbershop model
use Illuminate\Support\Str; // Import Str for Str::limit in the view


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // You might want to apply middleware here if needed for the homepage
        // $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        // Fetch a few approved barbershops to display as featured on the homepage
        $featuredBarbershops = Barbershop::where('is_approved', true) // Only show approved barbershops
                                        // Removed: ->with('services') // No longer eager loading relationship
                                        ->latest() // Order by latest
                                        ->take(4) // <--- Changed from 8 to 4
                                        ->get(); // Get the results

        return view('home', compact('featuredBarbershops'));
    }
}
