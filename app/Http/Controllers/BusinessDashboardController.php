<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BusinessDashboardController extends Controller
{
    public function index()
    {
        return view('business.dashboard');
    }
}
