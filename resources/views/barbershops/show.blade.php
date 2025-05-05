@extends('layouts.app')

@section('content')

    {{-- Include the simple dark header partial with scroll-activated blur --}}
    @include('partials.header')

    {{-- Container for the main content area with the doodle background --}}
    {{-- Added relative positioning and overflow-hidden to this container --}}
    {{-- Added pt-24 to give space for the fixed header --}}
    <div class="container mx-auto px-4 py-8 pt-24 relative overflow-hidden">

        {{-- Doodle Background Overlay for the entire content area --}}
        {{-- Added absolute positioning, opacity, size, and repeat --}}
        <div class="absolute inset-0 z-0 opacity-10" style=" {{-- Adjusted opacity slightly if needed, or keep at 10 --}}
            background-image: url('https://img.freepik.com/premium-vector/hairdressing-barbershop-tools-seamless-pattern-beauty-salon_341076-314.jpg?w=900'); {{-- Your doodle image URL --}}
            background-size: 200px auto; {{-- Increased size of the doodle slightly --}}
            background-repeat: repeat; {{-- Ensure repeating --}}
            background-position: center; {{-- Center the repeating pattern --}}
            pointer-events: none; {{-- Allows clicks to pass through the doodle --}}
        "></div>

        {{-- Barbershop Details Content - Main Layout --}}
        <div class="relative z-10 bg-white rounded-lg shadow-md p-6 md:p-8"> {{-- Added bg-white, shadow, padding back to the main content block --}}

            {{-- Back to List Button (Moved to Top) --}}
            <div class="mb-8"> {{-- Added margin bottom --}}
                <a href="{{ route('barbershops.index') }}" class="inline-block bg-gray-300 text-gray-800 px-4 py-2 rounded-lg font-medium hover:bg-gray-400 transition">
                    <i class="fas fa-arrow-left mr-2"></i> Back to List
                </a>
            </div>

            {{-- Main Image / Gallery Section --}}
            <div class="mb-8 rounded-lg overflow-hidden shadow-sm">
                 {{-- Display main logo or a gallery if you have multiple images --}}
                @if($barbershop->logo)
                    <img src="{{ asset('storage/' . $barbershop->logo) }}" alt="{{ $barbershop->name }}" class="w-full h-96 object-cover"> {{-- Increased image height --}}
                @else
                    <div class="w-full h-96 bg-gray-200 flex items-center justify-center text-gray-400 text-6xl">
                        <i class="fas fa-cut"></i>
                    </div>
                @endif
                 {{-- If you have a gallery relationship, loop through and display images here --}}
                 {{-- <div class="grid grid-cols-2 md:grid-cols-3 gap-4 mt-4">
                     @foreach($barbershop->galleryImages as $image)
                         <img src="{{ asset('storage/' . $image->path) }}" alt="{{ $barbershop->name }} Gallery" class="w-full h-32 object-cover rounded-lg">
                     @endforeach
                 </div> --}}
            </div>

            {{-- Barbershop Name and Basic Info --}}
            <div class="mb-8 border-b pb-6 border-gray-200"> {{-- Added bottom border --}}
                <h1 class="text-4xl font-bold text-gray-800 mb-2">{{ $barbershop->name }}</h1>
                <p class="text-gray-600 text-lg flex items-center"><i class="fas fa-map-marker-alt mr-2"></i> {{ $barbershop->city }}, {{ $barbershop->state }}</p>
                 {{-- You could add a short tagline or specialty here if available --}}
                 {{-- <p class="text-gray-700 mt-2">{{ $barbershop->tagline ?? '' }}</p> --}}
            </div>

            {{-- Two-Column Layout for Details --}}
            <div class="flex flex-col md:flex-row gap-8">

                {{-- Left Column: About, Ratings, Map --}}
                <div class="md:w-2/3 flex flex-col gap-8"> {{-- Adjusted column width --}}
                    {{-- About Description Card --}}
                    <div class="bg-gray-50 rounded-lg p-6 shadow-sm"> {{-- Lighter background for this card --}}
                        <h3 class="text-xl font-semibold text-gray-700 mb-2">About {{ $barbershop->name }}</h3>
                        <p class="text-gray-700">{{ $barbershop->description }}</p>
                    </div>

                    {{-- Ratings and Reviews Card (Placeholder) --}}
                    <div class="bg-gray-50 rounded-lg p-6 shadow-sm"> {{-- Lighter background for this card --}}
                        <h3 class="text-xl font-semibold text-gray-700 mb-2">Ratings & Reviews</h3>
                        <p class="text-gray-600">Ratings and reviews section coming soon...</p>
                        {{-- Implement actual ratings/reviews display here --}}
                    </div>

                    {{-- Map Card (Placeholder) --}}
                    <div class="bg-gray-50 rounded-lg p-6 shadow-sm"> {{-- Lighter background for this card --}}
                        <h3 class="text-xl font-semibold text-gray-700 mb-2">Location Map</h3>
                        <div class="bg-gray-200 h-64 rounded-lg flex items-center justify-center text-gray-600">
                            Map Placeholder
                            {{-- Integrate a map (e.g., Google Maps, Leaflet) here --}}
                        </div>
                    </div>
                </div>

                {{-- Right Column: Services, Working Hours, Contact Info, Book Now --}}
                <div class="md:w-1/3 flex flex-col gap-8"> {{-- Adjusted column width --}}
                     {{-- Services Card --}}
                    @if($barbershop->services && is_array($barbershop->services)) {{-- Added check if services is an array --}}
                        <div class="bg-white rounded-lg shadow-md p-6"> {{-- Card styling --}}
                            <h3 class="text-xl font-semibold text-gray-700 mb-2">Services Offered</h3>
                            <div class="flex flex-wrap gap-2">
                                @foreach($barbershop->services as $service)
                                     {{-- Check if $service is an array (object) and access the 'name' property --}}
                                     @if(is_array($service) && isset($service['name']))
                                         {{-- Use {!! !!} to display the service name without htmlspecialchars --}}
                                        <span class="bg-gray-200 text-gray-800 px-3 py-1 rounded-full text-sm">{!! $service['name'] !!}</span>
                                     @else
                                         {{-- Fallback if service is not an array or doesn't have 'name' --}}
                                         <span class="bg-gray-200 text-gray-800 px-3 py-1 rounded-full text-sm">{!! $service !!}</span>
                                     @endif
                                @endforeach
                            </div>
                        </div>
                    @endif

                    {{-- Working Hours Card --}}
                    <div class="bg-white rounded-lg shadow-md p-6"> {{-- Card styling --}}
                        <h3 class="text-xl font-semibold text-gray-700 mb-2">Working Hours</h3>
                        @if($barbershop->working_hours)
                            @foreach($barbershop->working_hours as $day => $hours)
                                <p class="text-gray-600">{{ ucfirst($day) }}: {{ $hours }}</p>
                            @endforeach
                        @else
                            <p class="text-gray-600">Hours not specified.</p>
                        @endif
                    </div>

                    {{-- Contact Information Card --}}
                    <div class="bg-white rounded-lg shadow-md p-6"> {{-- Card styling --}}
                        <h3 class="text-xl font-semibold text-gray-700 mb-2">Contact Information</h3>
                        <p class="text-gray-600 flex items-center mb-1"><i class="fas fa-map-marker-alt mr-2"></i> {{ $barbershop->address }}, {{ $barbershop->city }}, {{ $barbershop->state }} {{ $barbershop->zip_code }}</p>
                        <p class="text-gray-600 flex items-center mb-1"><i class="fas fa-phone mr-2"></i> {{ $barbershop->phone }}</p>
                        <p class="text-gray-600 flex items-center"><i class="fas fa-envelope mr-2"></i> {{ $barbershop->email }}</p>

                        {{-- Social Media and Website --}}
                        <div class="flex items-center space-x-4 mt-4">
                            @if($barbershop->website)
                                <a href="{{ $barbershop->website }}" target="_blank" class="text-gray-600 hover:text-gray-800 transition flex items-center"><i class="fas fa-globe mr-2"></i> Website</a>
                            @endif
                            @if($barbershop->instagram)
                                 {{-- Assuming Instagram handle is stored, construct the URL --}}
                                 <a href="https://www.instagram.com/{{ $barbershop->instagram }}" target="_blank" class="text-gray-600 hover:text-gray-800 transition flex items-center"><i class="fab fa-instagram mr-2"></i> Instagram</a>
                            @endif
                            @if($barbershop->facebook)
                                 {{-- Assuming Facebook handle or page ID is stored, construct the URL --}}
                                 <a href="https://www.facebook.com/{{ $barbershop->facebook }}" target="_blank" class="text-gray-600 hover:text-gray-800 transition flex items-center"><i class="fab fa-facebook-f mr-2"></i> Facebook</a>
                            @endif
                        </div>
                    </div>


                    {{-- Book Now Button --}}
                    {{-- This button will now link to the booking view --}}
                    <div class="mt-auto"> {{-- Use mt-auto to push the button to the bottom of the column --}}
                         <a href="{{ route('bookings.create', $barbershop->id) }}" class="w-full inline-block text-center bg-gray-800 text-white text-xl font-bold py-4 rounded-lg hover:bg-gray-700 transition shadow-md">
                            Book Now
                         </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Removed the booking modal HTML from here --}}

@endsection

{{-- Removed the Alpine.js script for the modal from here --}}
