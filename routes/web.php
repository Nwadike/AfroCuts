<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\BarbershopController;
use App\Http\Controllers\BookingController; // Import BookingController
use App\Http\Controllers\Auth\LoginController; // Import LoginController if modifying redirect
use App\Http\Controllers\Auth\RegisterController; // Import RegisterController if modifying redirect
use App\Providers\RouteServiceProvider; // Import RouteServiceProvider
use App\Http\Controllers\UserController; // Assuming you have a UserController for user-specific actions
use App\Http\Controllers\ProfileController; // Assuming you have a ProfileController for profile settings
use App\Http\Controllers\BarbershopFeatureController; // Placeholder controller for new barbershop features
use App\Http\Controllers\RatingController;


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
    Route::resource('barbershops', BarbershopController::class)->except(['index', 'show', 'update']); // Exclude update from resource

    // Explicitly define the update route for barbershops
    Route::put('/barbershops/{barbershop}', [BarbershopController::class, 'update'])->name('barbershops.update');

    // Dashboard route - points to the appropriate controller method based on user type
    // Assuming your DashboardController handles the logic for both user types
    // If using separate controllers, you might need conditional routing or handle it in the controller
    // For now, mapping to BookingController@index as per your original file, but this might need adjustment
    Route::get('/dashboard', [BookingController::class, 'index'])->name('dashboard');

    // Route for initial barbershop creation after business registration
    Route::get('/barbershops/create/initial', [BarbershopController::class, 'createInitial'])->name('barbershops.create.initial');

    // Business Barbershop Settings/Edit Route
    Route::get('/dashboard/barbershop/edit', [BarbershopController::class, 'editBusiness'])->name('barbershops.edit.business');

    // Booking routes
    Route::get('/barbershops/{barbershop}/book', [BookingController::class, 'createBooking'])->name('bookings.create'); // Create a new booking
    Route::post('/bookings', [BookingController::class, 'store'])->name('bookings.store'); // Store a new booking

    // --- Barbershop Specific Routes (for users with isBusiness() == true) ---
    // These routes are referenced in the dashboard layout and need definition
    Route::get('/dashboard/barbershop/bookings/received', [BookingController::class, 'receivedBookings'])->name('barbershop.bookings.received'); // Route for received bookings
    Route::get('/dashboard/barbershop/barbers', [BarbershopController::class, 'indexBarbers'])->name('barbershop.barbers.index'); // Route for managing barbers
    Route::get('/dashboard/barbershop/schedule', [BarbershopController::class, 'indexSchedule'])->name('barbershop.schedule.index'); // Route for managing schedule
    Route::get('/dashboard/barbershop/gallery', [BarbershopController::class, 'indexGallery'])->name('barbershop.gallery.index'); // Route for managing gallery

    // New Barbershop Feature Routes (Placeholder - create controllers/methods for these)
    Route::get('/dashboard/barbershop/payments', [BarbershopFeatureController::class, 'indexPayments'])->name('barbershop.payments.index'); // Payment Options
    Route::get('/dashboard/barbershop/plans', [BarbershopFeatureController::class, 'indexPlans'])->name('barbershop.plans.index'); // Business Plans
    Route::get('/dashboard/barbershop/analytics', [BarbershopFeatureController::class, 'indexAnalytics'])->name('barbershop.analytics.index'); // Analytics & Reports
    Route::get('/dashboard/barbershop/reviews', [BarbershopFeatureController::class, 'indexReviews'])->name('barbershop.reviews.index'); // Customer Reviews

    // --- Regular User Specific Routes (for users with isRegular() == true) ---
    // These routes are referenced in the dashboard layout and need definition (Placeholder)
    Route::get('/dashboard/user/profile', [UserController::class, 'editProfile'])->name('user.profile.edit'); // User Profile
    Route::get('/dashboard/user/bookings', [UserController::class, 'indexBookings'])->name('user.bookings.index'); // User Bookings
    Route::get('/dashboard/user/favorites', [UserController::class, 'indexFavorites'])->name('user.favorites.index'); // User Favorites

    // --- Common Authenticated Routes ---
    // Account Settings (Placeholder - assuming a ProfileController handles this)
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit'); // Account Settings

    //Ratings route
    Route::middleware(['auth'])->post('/barbershop/{id}/rate', [RatingController::class, 'store'])->name('barbershop.rate');

    // Optional: Modify Login/Register redirects to go to dashboard
    // You would typically set the protected $redirectTo property in LoginController and RegisterController
    // to '/dashboard' or route('dashboard'). Example:
    // protected $redirectTo = RouteServiceProvider::HOME; // Change this in LoginController/RegisterController
    // to protected $redirectTo = '/dashboard'; or protected $redirectTo = route('dashboard');

    // If you need custom logic after login/register (e.g., handling booking session data),
    // you might override the authenticated/registered methods in LoginController/RegisterController
    // or use middleware.

});

// ... other routes outside the authenticated group

