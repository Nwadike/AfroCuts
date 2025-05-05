<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\BarbershopController;
use App\Http\Controllers\BookingController; // Import BookingController
use App\Http\Controllers\Auth\LoginController; // Import LoginController if modifying redirect
use App\Http\Controllers\Auth\RegisterController; // Import RegisterController if modifying redirect
use App\Providers\RouteServiceProvider; // Import RouteServiceProvider

Auth::routes();

// Home page route
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/home', [HomeController::class, 'index'])->name('home');

// Public routes for barbershops index, search, and show
Route::get('/barbershops', [BarbershopController::class, 'index'])->name('barbershops.index');
Route::get('/barbershops/search', [BarbershopController::class, 'search'])->name('barbershops.search');
Route::get('/barbershops/{barbershop}', [BarbershopController::class, 'show'])->name('barbershops.show');

// Authenticated user routes
Route::middleware(['auth'])->group(function () {
    // Barbershop resource routes (excluding index and show)
    // We will handle update logic in the existing update method
    Route::resource('barbershops', BarbershopController::class)->except(['index', 'show', 'update']); // Exclude update from resource

    // Dashboard route - now points to 'users.dashboard' view
    Route::get('/dashboard', [BookingController::class, 'index'])->name('dashboard'); // Dashboard route handled by BookingController@index

    // Route for initial barbershop creation after business registration
    Route::get('/barbershops/create/initial', [BarbershopController::class, 'createInitial'])->name('barbershops.create.initial');

    // Business Barbershop Settings/Edit Route
    Route::get('/dashboard/barbershop/edit', [BarbershopController::class, 'editBusiness'])->name('barbershops.edit.business');
    // Explicitly define the update route
    Route::put('/barbershops/{barbershop}', [BarbershopController::class, 'update'])->name('barbershops.update');

     // This route is protected by 'auth' middleware in the controller's constructor
     Route::get('/barbershops/{barbershop}/book', [BookingController::class, 'createBooking'])->name('bookings.create'); // <-- Added this route

     // Booking store route (handled via AJAX from frontend)
     Route::post('/bookings', [BookingController::class, 'store'])->name('bookings.store'); // Store a new booking

    // Booking store route (handled via AJAX from frontend)
    Route::post('/bookings', [BookingController::class, 'store'])->name('bookings.store'); // Store a new booking

    // Optional: Modify Login/Register redirects to go to dashboard
    // You would typically set the protected $redirectTo property in LoginController and RegisterController
    // to '/dashboard' or route('dashboard'). Example:
    // protected $redirectTo = RouteServiceProvider::HOME; // Change this in LoginController/RegisterController
    // to protected $redirectTo = '/dashboard'; or protected $redirectTo = route('dashboard');

    // If you need custom logic after login/register (e.g., handling booking session data),
    // you might override the authenticated/registered methods in LoginController/RegisterController
    // or use middleware.

});

