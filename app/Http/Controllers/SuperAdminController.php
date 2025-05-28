<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Barbershop;
use App\Models\Booking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;


class SuperAdminController extends Controller
{
    public function index() {
        return view('superadmin.dashboard');
    }


   

}
