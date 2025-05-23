<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Barbershop; // Import Barbershop model
use App\Models\User; // Import User model
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session; // Import Session facade
use Illuminate\Support\Facades\Validator; // Import Validator facade
use App\Providers\RouteServiceProvider; // Import RouteServiceProvider

class BookingController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth')->except('handlePostLoginBooking'); // Ensure only authenticated users can access most routes
        // The 'createBooking' route is protected by this middleware implicitly
    }

    /**
     * Display a listing of bookings based on user type (Dashboard).
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $user = Auth::user();

        if ($user->isRegular()) {
            // Fetch bookings made BY the regular user
            $bookings = $user->bookings()->with('barbershop')->latest()->paginate(10);
            $receivedBookings = null; // Regular users don't receive bookings

        } elseif ($user->isBusiness()) {
            // Fetch the barbershop owned by the business user
            $barbershop = $user->barbershop;

            if ($barbershop) {
                // Fetch bookings made FOR this barbershop
                $receivedBookings = $barbershop->bookings()->with('user')->latest()->paginate(10); // Eager load the user who made the booking
                $bookings = null; // Business users don't have 'made' bookings in this context
            } else {
                // Business user doesn't have a barbershop yet
                $receivedBookings = null;
                $bookings = null;
            }
        } else {
            // Handle other account types or a default case
            $bookings = null;
            $receivedBookings = null;
        }


        // Return the dashboard view, passing the appropriate data
        return view('users.dashboard', compact('bookings', 'receivedBookings')); // Pass both variables
    }

    /**
     * Show the form for creating a new booking.
     *
     * @param  \App\Models\Barbershop  $barbershop
     * @return \Illuminate\View\View|\Illuminate\Http\RedirectResponse
     */
    public function createBooking(Barbershop $barbershop)
    {
        // The 'auth' middleware in the constructor handles the redirect if not logged in.
        // If the user is logged in, simply return the booking creation view.
        return view('bookings.create', compact('barbershop'));
    }


    /**
     * Store a newly created booking in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        // Use Validator for AJAX response friendly validation
        $validator = Validator::make($request->all(), [
            'barbershop_id' => 'required|exists:barbershops,id', // Ensure barbershop exists
            'services' => 'required|array', // Expecting an array of selected service objects {name, price}
            'services.*.name' => 'required|string|max:255', // Validate each service object's name
            'services.*.price' => 'required|numeric|min:0', // Validate each service object's price
            'date' => 'required|date|after_or_equal:today', // Date is required, valid, and not in the past
            'time_slot' => 'required|string|in:morning,afternoon,evening', // Time slot is required
            'notes' => 'nullable|string|max:500', // Notes are optional with a max length
        ]);

        // Check if validation fails
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422); // Return validation errors with 422 status
        }

        // Get validated data
        $validated = $validator->validated();

        // Get the authenticated user's ID
        $validated['user_id'] = Auth::id();

        try {
            // Calculate the total amount securely on the backend based on the prices sent
            // Note: For critical applications, you might want to re-verify these prices
            // against the barbershop's stored services data to prevent manipulation.
            $totalAmount = collect($validated['services'])->sum('price');
            $validated['total_amount'] = $totalAmount;

            // Services data is already in the correct format from the frontend
            // $validated['services'] = $validated['services']; // This line is redundant

            $validated['status'] = 'pending'; // Set default status


            // Create the booking
            $booking = Booking::create($validated);

            // Clear any booking data stored in the session after login redirect (if applicable)
            // Session::forget(['booking_services', 'booking_barbershop', 'booking_date', 'booking_time_slot', 'booking_total_amount', 'booking_note']);

            // Return a success JSON response
            return response()->json(['message' => 'Booking created successfully!', 'booking' => $booking], 201);

        } catch (\Exception $e) {
            // Log the error
            \Log::error('Error creating booking: ' . $e->getMessage());
            // Return an error JSON response
            return response()->json(['message' => 'Failed to create booking. Please try again.'], 500);
        }
    }

    /**
     * Handle the redirect after login if booking data is in the session.
     * This method is now less critical as the frontend handles resuming the modal.
     * However, we can still use it to clear session data after it's been read by the frontend.
     * You would typically set the redirect path in your LoginController to point here.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function handlePostLoginBooking(Request $request)
    {
         // The frontend Alpine.js now checks for 'post_login_booking_data' flash session.
         // We can just clear the original session data here if needed, or rely on the frontend
         // to handle the state after reading the flash data.
         // For a simple redirect after login, the default Laravel redirect is usually sufficient
         // if the frontend is capable of reading the flash session on the target page.

         // If you modified LoginController to redirect here, ensure you still redirect
         // to the intended page or the dashboard.
         // Example:
         // if (Session::has('booking_services')) {
         //     // Data was likely handled by frontend init script
         //     Session::forget(['booking_services', 'booking_barbershop', 'booking_date', 'booking_time_slot', 'booking_total_amount', 'booking_note']);
         // }

         // Redirect to the intended page or the dashboard
         return redirect()->intended(route('dashboard')); // Redirect to the new dashboard
    }

    /**
     * Display received bookings for a business user.
     *
     * @return \Illuminate\View\View|\Illuminate\Http\RedirectResponse
     */
    public function receivedBookings()
    {
        $user = Auth::user();

        // Ensure the user is a business user
        if (!$user->isBusiness()) {
            return redirect()->route('home')->with('error', 'Access denied.');
        }

        // Fetch the barbershop owned by the business user
        $barbershop = $user->barbershop;

        if (!$barbershop) {
            // If the business user doesn't have a barbershop, redirect them to create one
            return redirect()->route('barbershops.create.initial')->with('info', 'Please create your barbershop profile first.');
        }

        // Fetch bookings made FOR this barbershop
        $receivedBookings = $barbershop->bookings()->with('user')->latest()->paginate(10); // Eager load the user who made the booking

        // Return the view for received bookings
        return view('barbershop.bookings.received', compact('receivedBookings')); // Assuming a view at resources/views/barbershop/bookings/received.blade.php
    }
}
