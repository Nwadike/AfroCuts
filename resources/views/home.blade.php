@extends('layouts.app')

@section('content')

{{-- Hero Section with Search and Doodle Background --}}
{{-- Added relative and overflow-hidden. Removed py-12. --}}
<section class="w-full px-3 antialiased bg-gradient-to-br from-gray-950 via-black to-gray-900 lg:px-6 relative overflow-hidden">
    {{-- Doodle Background Overlay for the Hero Banner --}}
    {{-- Added absolute positioning, opacity, size, and repeat --}}
    <div class="absolute inset-0 z-0 opacity-5" style=" {{-- Reduced opacity for subtlety --}}
        background-image: url('https://img.freepik.com/premium-vector/hairdressing-barbershop-tools-seamless-pattern-beauty-salon_341076-314.jpg?w=900'); {{-- Your doodle image URL --}}
        background-size: 250px auto; {{-- Increased size slightly --}}
        background-repeat: repeat; {{-- Allow the doodle to repeat --}}
        background-position: center; {{-- Center the repeating pattern --}}
        pointer-events: none; {{-- Allows clicks to pass through the doodle --}}
    "></div>

    {{-- Main content div - Added relative z-10 to keep it above the background --}}
    <div class="mx-auto max-w-7xl relative z-10">
        {{-- Navigation - Removed h-24, added py-4 --}}
        <nav class="flex items-center w-full select-none py-4"> {{-- Adjusted padding --}}
            <div class="relative flex flex-wrap items-center justify-between w-full mx-auto font-medium md:justify-between">
                {{-- Logo - Kept py-4 for internal padding/click area --}}
                <a href="{{ url('/') }}" class="flex items-center py-4 pl-6 pr-4 space-x-2 font-extrabold text-white md:py-0">
                    <span class="flex items-center justify-center flex-shrink-0 w-8 h-8 text-gray-900 rounded-full bg-gradient-to-br from-white via-gray-200 to-white">
                        <svg class="w-auto h-5 -translate-y-px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M12 2L15.09 8.26L22 9.27L17 14.14L18.18 21.02L12 17.77L5.82 21.02L7 14.14L2 9.27L8.91 8.26L12 2Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </span>
                    <span class="text-xl font-bold">AfroCuts</span>
                </a>

                {{-- Auth Links / User Dropdown (kept from previous versions) --}}
                <div class="flex items-center space-x-4 pr-6">
                    @guest
                        <a href="{{ route('login') }}" class="text-gray-300 hover:text-white transition">Login</a>
                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="bg-gray-700 text-white px-4 py-2 rounded-lg font-medium hover:bg-gray-600 transition">Register</a>
                        @endif
                    @else
                        <div class="relative" x-data="{ userMenuOpen: false }">
                            <button @click="userMenuOpen = !userMenuOpen" class="flex items-center text-gray-300 hover:text-white focus:outline-none rounded-full overflow-hidden border-2 border-gray-700 w-10 h-10 justify-center items-center">
                                 <i class="fas fa-user-circle text-2xl"></i>
                            </button>
                            <div x-show="userMenuOpen" @click.away="userMenuOpen = false" x-cloak
                                 class="absolute right-0 mt-2 w-48 bg-gray-800 bg-opacity-90 rounded-md shadow-lg py-1 z-20 border border-gray-700">
                                <div class="px-4 py-2 text-sm text-gray-200 border-b border-gray-700">
                                    Signed in as:<br>
                                    <span class="font-semibold">{{ Auth::user()->name }}</span>
                                </div>
                                <a href="{{ route('dashboard') }}" class="block px-4 py-2 text-sm text-gray-300 hover:bg-gray-700 hover:text-white">Dashboard</a>
                                <a href="{{ route('barbershops.create') }}" class="block px-4 py-2 text-sm text-gray-300 hover:bg-gray-700 hover:text-white">Add Barbershop</a>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="block w-full text-left px-4 py-2 text-sm text-gray-300 hover:bg-gray-700 hover:text-white">Logout</button>
                                </form>
                            </div>
                        </div>
                    @endguest
                </div>
            </div>
        </nav>
        {{-- End of Navigation --}}

        {{-- Adjusted padding top for content to align below the navigation --}}
        <div class="container px-6 py-20 mx-auto md:py-32 text-center pt-12">
            <div class="max-w-3xl mx-auto">
                <h1 class="mb-6 text-4xl font-extrabold leading-tight text-white md:text-5xl">Find the Perfect Black Barbershop ✂️💇🏽‍♂️</h1>
                <p class="mb-10 text-xl text-gray-300">Discover barbers that specialize in African American hair care in your area</p>

                <form action="{{ route('barbershops.search') }}" method="GET" class="max-w-md mx-auto">
                    <div class="relative">
                        <input
                            type="text"
                            name="query"
                            placeholder="Search for barbershops..."
                            class="w-full px-5 py-4 pl-12 text-white bg-white bg-opacity-20 rounded-full focus:outline-none focus:ring-0 border-0 placeholder-gray-300">
                        <button type="submit" class="absolute left-3 top-1/2 transform -translate-y-1/2 text-white">
                            <i class="fas fa-search text-xl"></i>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>

{{-- Rest of the home page content --}}
<div class="container mx-auto px-4 py-8">
    <h2 class="text-2xl font-bold text-gray-800 mb-6">Featured Barbershops</h2>
    @if ($featuredBarbershops->count())
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
            @foreach ($featuredBarbershops as $barbershop)
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
                    <p class="text-gray-700 mb-4">{{ Str::limit($barbershop->description, 100) }}</p>
                    <a href="{{ route('barbershops.show', $barbershop->id) }}" class="inline-block bg-gray-800 text-white px-4 py-2 rounded-lg font-medium hover:bg-gray-700 transition">
                        View Details
                    </a>
                </div>
            </div>
            @endforeach
        </div>

        <div class="text-center mt-12">
            <a href="{{ route('barbershops.index') }}" class="inline-block bg-gray-800 text-white px-6 py-3 rounded-lg font-bold hover:bg-gray-700 transition">View All Barbershops</a>
        </div>
    @else
        <div class="bg-white p-6 rounded-lg shadow-md text-center text-gray-600">
            <p>No featured barbershops found.</p>
        </div>
    @endif
</div>
@endsection
