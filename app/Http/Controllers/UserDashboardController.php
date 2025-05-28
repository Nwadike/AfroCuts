<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserDashboardController extends Controller
{
    public function index()
{
    $user = auth()->user();

    return view('user.dashboard', [
    'recentBookings' => $user->bookings()->latest()->take(3)->get(),
    'recentRatings' => $user->ratings()->latest()->take(5)->get(),
    'recentFavorites' => $user->favorites()->latest('favorites.created_at')->take(5)->get(),

    'totalBookings' => $user->bookings()->count(),
    'totalRatings' => $user->ratings()->count(),
    'totalFavorites' => $user->favorites()->count(),
]);

}

}
