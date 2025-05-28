<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FavoriteController extends Controller
{
    public function store($barbershopId)
{
    auth()->user()->favorites()->attach($barbershopId);
    return back();
}

public function destroy($barbershopId)
{
    auth()->user()->favorites()->detach($barbershopId);
    return back();
}

}
