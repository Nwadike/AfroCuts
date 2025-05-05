@extends('layouts.app')

@section('content')

    {{-- Include the simple dark header partial with scroll-activated blur --}}
    @include('partials.header')

    {{-- Container for the main content area with the doodle background --}}
    {{-- Added relative positioning and overflow-hidden to this container --}}
    <div class="container mx-auto px-4 py-8 pt-24 relative overflow-hidden"> {{-- Added relative, overflow-hidden, and pt-24 --}}

        {{-- Doodle Background Overlay for the entire content area --}}
        {{-- Added absolute positioning, opacity, size, and repeat --}}
        <div class="absolute inset-0 z-0 opacity-10" style=" {{-- Adjusted opacity slightly if needed, or keep at 10 --}}
            background-image: url('https://img.freepik.com/premium-vector/hairdressing-barbershop-tools-seamless-pattern-beauty-salon_341076-314.jpg?w=900'); {{-- Your doodle image URL --}}
            background-size: 200px auto; {{-- Increased size of the doodle slightly --}}
            background-repeat: repeat; {{-- Ensure repeating --}}
            background-position: center; {{-- Center the repeating pattern --}}
            pointer-events: none; {{-- Allows clicks to pass through the doodle --}}
        "></div>

        {{-- Search Form - Styled to match screenshot --}}
        {{-- The layout in the screenshot shows the search bar directly below the header area --}}
        {{-- Removed relative positioning and overflow-hidden from this div --}}
        <div class="mb-8"> {{-- Removed relative and overflow-hidden --}}
            {{-- Added text-gray-800 for the heading as seen in the screenshot --}}
            <h2 class="text-xl font-semibold text-gray-800 mb-4 relative z-10">Find a Barbershop</h2> {{-- Added relative z-10 --}}
            {{-- Adjusted form layout and input styling --}}
            <form action="{{ route('barbershops.search') }}" method="GET" class="flex flex-col md:flex-row gap-4 bg-white p-6 rounded-lg shadow-md relative z-10"> {{-- Added bg, padding, shadow here, and relative z-10 --}}
                <input type="text" name="query" placeholder="Search by name or description..."
                       class="flex-grow px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-gray-800"
                       value="{{ request('query') }}">
                <input type="text" name="location" placeholder="City, State, or Zip Code..."
                       class="flex-grow px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-gray-800"
                       value="{{ request('location') }}">
                <button type="submit" class="bg-gray-800 text-white px-6 py-2 rounded-lg font-medium hover:bg-gray-700 transition">Search</button>
            </form>
        </div>


        {{-- Barbershops List --}}
        @if (isset($barbershops) && is_object($barbershops) && method_exists($barbershops, 'count') && $barbershops->count())
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 relative z-10"> {{-- Added relative z-10 --}}
            @foreach ($barbershops as $barbershop)
            <div class="bg-white rounded-lg shadow-md overflow-hidden">
                @if($barbershop->logo)
                <img src="{{ asset('storage/' . $barbershop->logo) }}" alt="{{ $barbershop->name }}" class="w-full h-48 object-cover">
                @else
                <div class="w-full h-48 bg-gray-200 flex items-center justify-center">
                    <i class="fas fa-cut text-4xl text-gray-400"></i>
                </div>
                @endif

                <div class="p-6">
                    <h3 class="text-xl font-bold mb-2 text-gray-800">{{ $barbershop->name }}</h3>
                    <div class="flex items-center text-gray-600 mb-3">
                        <i class="fas fa-map-marker-alt mr-2"></i>
                        <span>{{ $barbershop->city }}, {{ $barbershop->state }}</span>
                    </div>
                    {{-- Display services from the JSON column --}}
                    @if (isset($barbershop->services) && is_array($barbershop->services) && count($barbershop->services) > 0)
                        <div class="text-gray-700 mb-2">
                            Services: {{ collect($barbershop->services)->pluck('name')->join(', ') }} {{-- Use collect() to treat the array as a collection --}}
                        </div>
                    @endif
                    <p class="text-gray-700 mb-4">{{ Str::limit($barbershop->description, 100) }}</p>
                    {{-- Link to individual barbershop page --}}
                    <a href="{{ route('barbershops.show', $barbershop->id) }}" class="inline-block bg-gray-800 text-white px-4 py-2 rounded-lg font-medium hover:bg-gray-700 transition">
                        View Details
                    </a>
                </div>
            </div>
            @endforeach
        </div>

        {{-- Pagination --}}
        <div class="mt-8 relative z-10"> {{-- Added relative z-10 --}}
            {{ $barbershops->links() }}
        </div>
        @else
        <div class="bg-white p-6 rounded-lg shadow-md text-center text-gray-600 relative z-10"> {{-- Added relative z-10 --}}
                <p>No barbershops found matching your criteria.</p>
            </div>
        @endif
    </div>
@endsection
