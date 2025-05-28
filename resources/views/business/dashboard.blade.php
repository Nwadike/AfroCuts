@extends('layouts.dashboard') {{-- Extend the main dashboard layout --}}

@section('dashboard_content') {{-- Content goes into the dashboard layout's section --}}

    {{-- Page Title - Reverted to original styling (left-aligned, grey, smaller) --}}
    <h1 class="text-3xl font-bold text-gray-800 mb-6">Dashboard</h1>


        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8"> {{-- Adjusted gap and added bottom margin --}}

            {{-- Total Visitors Block --}}
            {{-- Enhanced styling with darker background on hover, subtle border, and more refined shadow --}}
            <div class="bg-white rounded-lg shadow-xl p-6 text-center transform transition duration-300 hover:scale-105 hover:shadow-2xl"> {{-- Added shadow-xl, transition, hover effects --}}
                <div class="p-4 bg-blue-100 rounded-full inline-block mb-4"> {{-- Circular background for icon --}}
                    <i class="fas fa-eye text-blue-600 text-3xl"></i> {{-- Icon size adjusted slightly --}}
                </div>
                <p class="text-gray-700 text-lg font-semibold">Total Visitors</p>
                {{-- Replace with actual data from your controller --}}
                <p class="text-gray-900 text-3xl font-bold mt-1">1,234</p> {{-- Text size kept for impact --}}
            </div>

            {{-- Total Bookings Block --}}
            {{-- Enhanced styling with darker background on hover, subtle border, and more refined shadow --}}
            <div class="bg-white rounded-lg shadow-xl p-6 text-center transform transition duration-300 hover:scale-105 hover:shadow-2xl"> {{-- Added shadow-xl, transition, hover effects --}}
                 <div class="p-4 bg-green-100 rounded-full inline-block mb-4"> {{-- Circular background for icon --}}
                    <i class="fas fa-calendar-check text-green-600 text-3xl"></i> {{-- Icon size adjusted slightly --}}
                </div>
                <p class="text-gray-700 text-lg font-semibold">Total Bookings</p>
                 {{-- Replace with actual data from your controller --}}
                <p class="text-gray-900 text-3xl font-bold mt-1">567</p> {{-- Text size kept for impact --}}
            </div>

            {{-- Total Revenue Block --}}
            {{-- Enhanced styling with darker background on hover, subtle border, and more refined shadow --}}
            <div class="bg-white rounded-lg shadow-xl p-6 text-center transform transition duration-300 hover:scale-105 hover:shadow-2xl"> {{-- Added shadow-xl, transition, hover effects --}}
                 <div class="p-4 bg-yellow-100 rounded-full inline-block mb-4"> {{-- Circular background for icon --}}
                    <i class="fas fa-dollar-sign text-yellow-600 text-3xl"></i> {{-- Icon size adjusted slightly --}}
                </div>
                <p class="text-gray-700 text-lg font-semibold">Total Revenue</p>
                 {{-- Replace with actual data from your controller --}}
                <p class="text-gray-900 text-3xl font-bold mt-1">$12,345</p> {{-- Text size kept for impact --}}
            </div>
        </div>

        {{-- Link to Detailed Analytics --}}
        <div class="text-center mb-8"> {{-- Adjusted bottom margin --}}
            {{-- Changed text color to gray-800 to match the main title --}}
            <a href="{{ route('barbershop.analytics.index') }}" class="text-gray-800 hover:underline font-semibold text-lg">View Detailed Analytics & Reports <i class="fas fa-arrow-right ml-1 text-sm"></i></a>
        </div>

        {{-- Barbershop User Details Block (kept as is, assuming you styled it in dashboard.blade.php) --}}
        {{-- This block will now appear after the analytics summary --}}
        <div class="bg-white rounded-lg shadow-md p-6 mb-6">
            <h2 class="text-2xl font-semibold text-gray-700 mb-4">Your Barbershop Details</h2>
            @if(Auth::user()->barbershop)
                <p class="text-gray-600 mb-2"><span class="font-semibold">Barbershop Name:</span> {{ Auth::user()->barbershop->name }}</p>
                <p class="text-gray-600 mb-2"><span class="font-semibold">Email:</span> {{ Auth::user()->barbershop->email }}</p>
                <p class="text-gray-600 mb-2"><span class="font-semibold">Phone:</span> {{ Auth::user()->barbershop->phone ?? 'N/A' }}</p>
                <p class="text-gray-600 mb-2"><span class="font-semibold">Address:</span> {{ Auth::user()->barbershop->address }}, {{ Auth::user()->barbershop->city }}, {{ Auth::user()->barbershop->state }} {{ Auth::user()->barbershop->zip_code }}</p>
                 <p class="text-gray-600 mb-2"><span class="font-semibold">Approval Status:</span> <span class="font-bold text-{{ Auth::user()->barbershop->is_approved ? 'green' : 'red' }}-600">{{ Auth::user()->barbershop->is_approved ? 'Approved' : 'Pending Approval' }}</span></p>
                {{-- Add other barbershop details here --}}
            @else
                <div class="bg-yellow-100 border-l-4 border-yellow-500 text-yellow-700 p-4" role="alert">
                    <p class="font-bold">Barbershop Profile Incomplete</p>
                    <p>Please complete your <a href="{{ route('barbershops.create.initial') }}" class="text-blue-600 hover:underline">barbershop profile</a> to start managing your business and receiving bookings.</p>
                </div>
            @endif
        </div>


         {{-- Barbershop User Dashboard Content (Received Bookings Block) --}}
         <div class="bg-white rounded-lg shadow-md p-6">
            <h2 class="text-2xl font-semibold text-gray-700 mb-4">Bookings Received</h2>

            @if (isset($receivedBookings) && $receivedBookings->count())
                <div class="space-y-6">
                    @foreach ($receivedBookings as $booking)
                        {{-- Individual Booking Item (already has some styling, kept it) --}}
                        {{-- These inner blocks use bg-gray-100 to stand out slightly from the main white block --}}
                        <div class="bg-gray-100 rounded-lg p-4 shadow-sm">
                            <h3 class="text-xl font-bold text-gray-800 mb-2">Booking from {{ $booking->user->name }}</h3>
                            <p class="text-gray-700 mb-1"><span class="font-semibold">Date:</span> {{ $booking->date->format('M d, Y') }}</p>
                            <p class="text-gray-700 mb-1"><span class="font-semibold">Time:</span> {{ ucfirst($booking->time_slot) }}</p>
                             <p class="text-gray-700 mb-1"><span class="font-semibold">Services:</span>
                                {{-- Added check to ensure $booking->services is an array before looping --}}
                                @if (is_array($booking->services))
                                    {{-- Loop through the services array stored in the JSON column --}}
                                    @foreach ($booking->services as $service)
                                        {{ $service['name'] }} @if(isset($service['staff_name']) && $service['staff_name']) ({{ $service['staff_name'] }}) @endif @if(!$loop->last), @endif
                                    @endforeach
                                @else
                                    N/A {{-- Display N/A if services is not a valid array --}}
                                @endif
                            </p>
                            <p class="text-gray-700 mb-1"><span class="font-semibold">Total:</span> ${{ number_format($booking->total_amount, 2) }}</p>
                            @if($booking->notes)
                                <p class="text-gray-700 mb-1"><span class="font-semibold">Note:</span> {{ $booking->notes }}</p>
                            @endif
                            <p class="text-gray-700"><span class="font-semibold">Status:</span> <span class="font-bold text-blue-600">{{ ucfirst($booking->status) }}</span></p>

                            {{-- Optional: Add buttons for managing booking status (e.g., Accept, Decline, Complete) --}}
                             {{-- <div class="mt-3">
                                 <button class="bg-green-500 hover:bg-green-600 text-white text-sm px-3 py-1 rounded mr-2">Accept</button>
                                 <button class="bg-red-500 hover:bg-red-600 text-white text-sm px-3 py-1 rounded\">Decline</button>
                             </div> --}}
                        </div>
                    @endforeach
                </div>

                {{-- Pagination for received bookings --}}
                <div class="mt-6">
                    {{ $receivedBookings->links() }}
                </div>
            @else
                <div class="bg-gray-100 rounded-lg p-4 text-center text-gray-600">
                    <p class="text-lg mb-4">You have not received any bookings yet.</p>
                     {{-- Prompt business users to complete their barbershop profile --}}
                    @if (Auth::user()->isBusiness() && !Auth::user()->barbershop)
                        <p>Complete your <a href="{{ route('barbershops.create.initial') }}" class="text-blue-600 hover:underline">barbershop profile</a> to start receiving bookings.</p>
                    @endif
                </div>
            @endif
        </div>

    


@endsection
