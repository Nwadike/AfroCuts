<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Barbershop;
use App\Models\Rating;

class RatingController extends Controller
{
    public function store(Request $request, $barbershopId)
    {
        $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'nullable|string|max:1000',
        ]);

        $barbershop = Barbershop::findOrFail($barbershopId);

        // Prevent duplicate rating by same user
        $existing = Rating::where('user_id', Auth::id())
                          ->where('barbershop_id', $barbershopId)
                          ->first();
        if ($existing) {
            return redirect()->back()->with('error', 'You have already rated this barbershop.');
        }

        Rating::create([
            'user_id' => Auth::id(),
            'barbershop_id' => $barbershopId,
            'rating' => $request->rating,
            'comment' => $request->comment,
        ]);

        return redirect()->back()->with('success', 'Rating submitted.');
    }
}
