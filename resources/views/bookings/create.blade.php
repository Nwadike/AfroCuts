@extends('layouts.app')

@section('content')

    {{-- Include the simple dark header partial with scroll-activated blur --}}
    @include('partials.header')

    {{-- Container for the main content area with the doodle background --}}
    {{-- Added relative positioning and overflow-hidden to this container --}}
    {{-- Added pt-24 to give space for the fixed header --}}
    <div class="container mx-auto px-4 py-8 pt-24 relative overflow-hidden min-h-screen flex items-start justify-center"> {{-- Added min-h-screen, flex, items-start, justify-center --}}

        {{-- Doodle Background Overlay for the entire content area --}}
        {{-- Added absolute positioning, opacity, size, and repeat --}}
        <div class="absolute inset-0 z-0 opacity-10" style=" {{-- Adjusted opacity slightly if needed, or keep at 10 --}}
            background-image: url('https://img.freepik.com/premium-vector/hairdressing-barbershop-tools-seamless-pattern-beauty-salon_341076-314.jpg?w=900'); {{-- Your doodle image URL --}}
            background-size: 200px auto; {{-- Increased size of the doodle slightly --}}
            background-repeat: repeat; {{-- Ensure repeating --}}
            background-position: center; {{-- Center the repeating pattern --}}
            pointer-events: none; {{-- Allows clicks to pass through the doodle --}}
        "></div>

        {{-- Booking Form Content --}}
        {{-- Removed data-service-prices attribute as JS is now inline --}}
        <div class="w-full max-w-lg relative z-10 bg-white rounded-lg shadow-md p-6 md:p-8"
             x-data="bookingForm" {{-- Reference the Alpine.js data defined in the inline script --}}
        >

            <h2 class="text-2xl font-bold text-gray-800 mb-6">Book Appointment at {{ $barbershop->name }}</h2>

            {{-- Step 1: Select Services --}}
            <div x-show="bookingStep === 1">
                <h3 class="text-xl font-semibold text-gray-700 mb-4">Select Services</h3>
                <div class="space-y-3 mb-6 max-h-60 overflow-y-auto"> {{-- Added max height and overflow for long lists --}}
                    {{-- Check if services JSON is not null and is an array --}}
                    @if (isset($barbershop->services) && is_array($barbershop->services) && count($barbershop->services) > 0)
                        @foreach($barbershop->services as $service)
                            {{-- Display service name, staff, and price --}}
                            <label class="flex items-center justify-between cursor-pointer bg-gray-100 p-3 rounded-lg hover:bg-gray-200 transition">
                                {{-- Use service data from the JSON array --}}
                                <span class="text-gray-700">{{ $service['name'] }} @if(isset($service['staff_name']) && $service['staff_name']) ({{ $service['staff_name'] }}) @endif - ${{ number_format($service['price'], 2) }}</span>
                                <input type="checkbox" class="form-checkbox text-gray-800 rounded"
                                       {{-- Pass service name and price to toggleService --}}
                                       @change="toggleService('{{ $service['name'] }}', {{ $service['price'] }})"
                                       {{-- Check based on service name --}}
                                       :checked="isServiceSelected('{{ $service['name'] }}')"
                                >
                            </label>
                        @endforeach
                    @else
                        <p class="text-gray-600">No services listed for this barbershop.</p>
                    @endif
                </div>

                {{-- Total Amount --}}
                <div class="text-right text-xl font-bold text-gray-800 mb-6">
                    Total: $<span x-text="totalAmount.toFixed(2)">0.00</span>
                </div>

                {{-- Continue Button (Step 1) --}}
                <button @click="if (selectedServices.length > 0) { bookingStep = 2; } else { alert('Please select at least one service.'); }" {{-- Simple alert for now --}}
                        :disabled="selectedServices.length === 0" {{-- Disable if no services selected --}}
                        class="w-full bg-gray-800 text-white text-lg font-bold py-3 rounded-lg hover:bg-gray-700 transition disabled:opacity-50 disabled:cursor-not-allowed">
                    Continue
                </button>
            </div>

            {{-- Step 2: Select Date and Time --}}
            <div x-show="bookingStep === 2">
                <h3 class="text-xl font-semibold text-gray-700 mb-4">Select Date and Time</h3>

                {{-- Date Selection (Placeholder) --}}
                <div class="mb-6">
                    <label for="booking_date" class="block text-gray-700 font-semibold mb-2">Date</label>
                    {{-- You would integrate a date picker library here --}}
                    <input type="date" id="booking_date" x-model="selectedDate"
                           class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-gray-800">
                </div>

                {{-- Time Selection (Placeholder) --}}
                <div class="mb-6">
                    <label for="booking_time" class="block text-gray-700 font-semibold mb-2">Time</label>
                    <select id="booking_time" x-model="selectedTime"
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-gray-800">
                        <option value="">Select a time slot</option>
                        <option value="morning">Morning (e.g., 9:00 AM - 12:00 PM)</option>
                        <option value="afternoon">Afternoon (e.g., 12:00 PM - 4:00 PM)</option>
                        <option value="evening">Evening (e.g., 4:00 PM - 7:00 PM)</option>
                        {{-- You would dynamically generate specific time slots based on barbershop hours and availability --}}
                    </select>
                </div>

                {{-- Option to Select Another Service (Go back to Step 1) --}}
                <div class="mb-6">
                     <button @click="bookingStep = 1" class="text-gray-600 hover:text-gray-800 text-sm">
                         <i class="fas fa-arrow-left mr-1"></i> Select/Modify Services
                     </button>
                </div>

                 {{-- Total Amount (Display again) --}}
                <div class="text-right text-xl font-bold text-gray-800 mb-6">
                    Total: $<span x-text="totalAmount.toFixed(2)">0.00</span>
                </div>

                {{-- Continue Button (Step 2) --}}
                <button @click="if (selectedDate && selectedTime) { bookingStep = 3; } else { alert('Please select a date and time.'); }" {{-- Basic check --}}
                        :disabled="!selectedDate || !selectedTime" {{-- Disable if date or time not selected --}}
                        class="w-full bg-gray-800 text-white text-lg font-bold py-3 rounded-lg hover:bg-gray-700 transition disabled:opacity-50 disabled:cursor-not-allowed">
                    Continue
                </button>
            </div>

            {{-- Step 3: Confirm Booking Details --}}
            <div x-show="bookingStep === 3">
                <h3 class="text-xl font-semibold text-gray-700 mb-4">Confirm Booking Details</h3>

                {{-- Booking Summary --}}
                <div class="mb-6 bg-gray-100 p-4 rounded-lg">
                    <p class="text-gray-700 mb-2"><span class="font-semibold">Barbershop:</span> {{ $barbershop->name }}</p>
                    <p class="text-gray-700 mb-2"><span class="font-semibold">Date:</span> <span x-text="selectedDate"></span></p>
                    <p class="text-gray-700 mb-2"><span class="font-semibold">Time:</span> <span x-text="selectedTime"></span></p>
                    {{-- Display selected service names from the selectedServices array --}}
                    <p class="text-gray-700 mb-2"><span class="font-semibold">Services:</span> <span x-text="selectedServices.map(s => s.name).join(', ')"></span></p>
                    <p class="text-gray-800 text-xl font-bold mt-4">Total: $<span x-text="totalAmount.toFixed(2)">0.00</span></p>
                </div>

                {{-- Leave Note Textbox --}}
                <div class="mb-6 relative">
                    <label for="booking_note" class="block text-gray-700 font-semibold mb-2">Leave a note (optional)</label>
                    <div class="relative">
                        <textarea id="booking_note" x-model="bookingNote" rows="3"
                                  class="w-full px-3 py-2 pl-10 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-gray-800"></textarea>
                        <i class="fas fa-comment-dots absolute left-3 top-3 text-gray-400"></i> {{-- Chat bubble icon --}}
                    </div>
                </div>

                {{-- Privacy Writeup --}}
                <p class="text-gray-600 text-sm mb-6">
                    Your personal data will be processed by the partner with whom you are booking an appointment.
                </p>

                {{-- Confirm & Book Button --}}
                {{-- This button will submit the booking data using AJAX --}}
                <button @click="confirmBooking()"
                         class="w-full bg-gray-800 text-white text-xl font-bold py-3 rounded-lg hover:bg-gray-700 transition shadow-md">
                    Confirm & Book
                </button>
            </div>

            {{-- Booking Success Message --}}
            <div x-show="bookingSuccess">
                <div class="text-center text-green-600 font-semibold text-xl">
                    <i class="fas fa-check-circle mb-3 text-3xl"></i>
                    <p>Booking Confirmed Successfully!</p>
                </div>
            </div>

             {{-- Booking Error Message --}}
            <div x-show="bookingError">
                <div class="text-center text-red-600 font-semibold text-xl">
                    <i class="fas fa-times-circle mb-3 text-3xl"></i>
                    <p x-text="bookingError"></p>
                </div>
            </div>

        </div>
    </div>

@endsection

@push('scripts')
<script>
    document.addEventListener('alpine:init', () => {
        Alpine.data('bookingForm', () => ({
            bookingStep: 1,
            selectedServices: [], // Store selected service objects {name, price}
            servicePrices: {
                {{-- Populate this with actual service prices from the $barbershop->services JSON --}}
                {{-- Added check to ensure services JSON is an array before looping --}}
                @if (isset($barbershop->services) && is_array($barbershop->services) && count($barbershop->services) > 0)
                    @foreach($barbershop->services as $service)
                        '{{ $service['name'] }}': {{ $service['price'] }}, {{-- Use service name as key --}}
                    @endforeach
                @endif
            },
            totalAmount: 0,
            selectedDate: null,
            selectedTime: null,
            bookingNote: '',
            bookingSuccess: false,
            bookingError: null,

            init() {
                 // Calculate initial total if any services are pre-selected (not applicable in this flow, but good practice)
                 this.calculateTotal();
            },

            // Function to calculate total amount
            calculateTotal() {
                this.totalAmount = this.selectedServices.reduce((sum, service) => {
                    // Use the price from the service object stored in selectedServices
                    return sum + (service.price || 0); // Use 0 if price is not found
                }, 0);
            },

            // Function to handle service selection change
            // Now takes service name and price
            toggleService(serviceName, servicePrice) {
                const existingServiceIndex = this.selectedServices.findIndex(service => service.name === serviceName);

                if (existingServiceIndex === -1) {
                    // Service not selected, add it
                    this.selectedServices.push({
                        name: serviceName,
                        price: servicePrice
                    });
                } else {
                    // Service already selected, remove it
                    this.selectedServices.splice(existingServiceIndex, 1);
                }
                this.calculateTotal(); // Recalculate total whenever services change
            },

            // Function to check if a service is selected
            // Now checks based on service name
            isServiceSelected(serviceName) {
                return this.selectedServices.some(service => service.name === serviceName);
            },

            // Function to confirm and book using AJAX
            confirmBooking() {
                this.bookingSuccess = false; // Reset success message
                this.bookingError = null; // Reset error message

                // Basic validation before sending AJAX
                if (!this.selectedDate || !this.selectedTime || this.selectedServices.length === 0) {
                    this.bookingError = 'Please complete all booking selections.';
                    return;
                }


                // Prepare data for AJAX request
                const bookingData = {
                    barbershop_id: {{ $barbershop->id ?? 'null' }}, // Use null if $barbershop is not available (shouldn't happen on this page)
                    // Send selected services data (name and price) to the backend
                    services: this.selectedServices,
                    date: this.selectedDate,
                    time_slot: this.selectedTime, // Use time_slot
                    // Do NOT send total_amount from frontend for security
                    notes: this.bookingNote,
                    _token: '{{ csrf_token() }}' // Include CSRF token for Laravel
                };

                // Send AJAX POST request using jQuery
                $.ajax({
                    url: '{{ route('bookings.store') }}', // Your backend route
                    method: 'POST',
                    data: bookingData,
                    success: (response) => {
                        console.log('Booking successful:', response);
                        this.bookingSuccess = true; // Show success message
                        // Redirect to the dashboard after a short delay
                        setTimeout(() => {
                             window.location.href = '{{ route('dashboard') }}'; // Redirect to the dashboard
                        }, 2000); // Redirect after 2 seconds
                    },
                    error: (xhr, status, error) => {
                        console.error('Booking failed:', error);
                        this.bookingError = 'Booking failed. Please try again.'; // Show generic error message
                        // Parse validation errors from Laravel response
                        if (xhr.responseJSON && xhr.responseJSON.errors) {
                            this.bookingError = 'Validation failed: ' + Object.values(xhr.responseJSON.errors).flat().join(', ');
                        } else if (xhr.responseJSON && xhr.responseJSON.message) {
                             this.bookingError = xhr.responseJSON.message; // Show backend error message
                        }
                    }
                });
            }
        }));
    });
</script>
@endpush
