@extends('layouts.dashboard') {{-- Extend the new dashboard layout --}}

@section('dashboard_content') {{-- Content goes into the dashboard layout's section --}}

    <h1 class="text-3xl font-bold text-gray-800 mb-6">Dashboard</h1>

    {{-- User Details (Placeholder) --}}
    <div class="mb-8 border-b pb-6 border-gray-200">
        <h2 class="text-2xl font-semibold text-gray-700 mb-4">Your Details</h2>
        <p class="text-gray-600 mb-2"><span class="font-semibold">Name:</span> {{ Auth::user()->name }}</p>
        <p class="text-gray-600 mb-2"><span class="font-semibold">Email:</span> {{ Auth::user()->email }}</p>
         <p class="text-gray-600 mb-2"><span class="font-semibold">Account Type:</span> {{ ucfirst(Auth::user()->account_type) }}</p>
        {{-- Add other user details here if available (e.g., phone, address) --}}
    </div>

    {{-- Regular User Dashboard Content (Your Bookings) --}}
    @if (Auth::user()->isRegular())
        <div>
            <h2 class="text-2xl font-semibold text-gray-700 mb-4">Your Bookings</h2>

            @if (isset($bookings) && $bookings->count())
                <div class="space-y-6">
                    @foreach ($bookings as $booking)
                        <div class="bg-gray-100 rounded-lg p-4 shadow-sm">
                            <h3 class="text-xl font-bold text-gray-800 mb-2">{{ $booking->barbershop->name }}</h3>
                            <p class="text-gray-700 mb-1"><span class="font-semibold">Date:</span> {{ $booking->date->format('M d, Y') }}</p> {{-- Format the date --}}
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
                            <p class="text-gray-700 mb-1"><span class="font-semibold">Total:</span> ${{ number_format($booking->total_amount, 2) }}</p> {{-- Format amount --}}
                            @if($booking->notes)
                                <p class="text-gray-700 mb-1"><span class="font-semibold">Note:</span> {{ $booking->notes }}</p>
                            @endif
                            <p class="text-gray-700"><span class="font-semibold">Status:</span> <span class="font-bold text-blue-600">{{ ucfirst($booking->status) }}</span></p> {{-- Display status --}}

                            {{-- Optional: Add buttons for cancelling/editing booking --}}
                            {{-- <div class="mt-3">
                                <button class="text-red-600 hover:text-red-800 text-sm mr-2">Cancel</button>
                                <button class="text-blue-600 hover:text-blue-800 text-sm">Edit</button>
                            </div> --}}
                        </div>
                    @endforeach
                </div>

                {{-- Pagination for bookings --}}
                <div class="mt-6">
                    {{ $bookings->links() }}
                </div>
            @else
                <div class="bg-gray-100 rounded-lg p-4 text-center text-gray-600">
                    <p>You have no bookings yet.</p>
                </div>
            @endif
        </div>

    {{-- Business User Dashboard Content (Bookings Received) --}}
    @elseif (Auth::user()->isBusiness())
         <div>
            <h2 class="text-2xl font-semibold text-gray-700 mb-4">Bookings Received</h2>

            @if (isset($receivedBookings) && $receivedBookings->count())
                <div class="space-y-6">
                    @foreach ($receivedBookings as $booking)
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
                                 <button class="bg-red-500 hover:bg-red-600 text-white text-sm px-3 py-1 rounded">Decline</button>
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
                    <p>You have not received any bookings yet.</p>
                     {{-- Prompt business users to complete their barbershop profile --}}
                    @if (!Auth::user()->barbershop)
                        <p class="mt-4">Complete your <a href="{{ route('barbershops.create.initial') }}" class="text-blue-600 hover:underline">barbershop profile</a> to start receiving bookings.</p>
                    @endif
                </div>
            @endif
        </div>
    @endif

@endsection
