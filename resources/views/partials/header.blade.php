{{-- Use Alpine.js to add classes based on scroll position --}}
{{-- Fixed header that becomes translucent and blurs on scroll --}}
<header class="fixed top-0 left-0 right-0 shadow-md z-50 transition-all duration-300"
        x-data="{ scrolled: false, userMenuOpen: false }" {{-- Added userMenuOpen here for the dropdown --}}
        x-init="window.addEventListener('scroll', () => { scrolled = window.scrollY > 50; })" {{-- Detect scroll > 50px --}}
        :class="{ 'bg-gray-900 bg-opacity-90 backdrop-filter backdrop-blur-lg': scrolled, 'bg-gray-900': !scrolled }"> {{-- Apply classes based on 'scrolled' state --}}
    <nav class="container mx-auto px-4 py-4 flex items-center justify-between">
        {{-- Logo --}}
        <a href="{{ url('/') }}" class="flex items-center space-x-2 text-white hover:text-gray-300">
            <span class="flex items-center justify-center flex-shrink-0 w-8 h-8 text-gray-900 rounded-full bg-gradient-to-br from-white via-gray-200 to-white">
                {{-- SVG icon from app.blade.php --}}
                <svg class="w-auto h-5 -translate-y-px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M12 2L15.09 8.26L22 9.27L17 14.14L18.18 21.02L12 17.77L5.82 21.02L7 14.14L2 9.27L8.91 8.26L12 2Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
            </span>
            <span class="text-xl font-bold">AfroCuts</span>
        </a>

        {{-- Navigation Links (Hidden on larger screens as requested) --}}
        {{-- <div class="hidden md:flex items-center space-x-6">
            <a href="{{ route('home') }}" class="text-gray-600 hover:text-gray-800 transition">Home</a>
            <a href="{{ route('barbershops.index') }}" class="text-gray-600 hover:text-gray-800 transition">Barbershops</a>
        </div> --}}

        {{-- Auth Links / User Dropdown --}}
        <div class="flex items-center space-x-4">
            @guest
                {{-- Login/Register links for guests --}}
                <a href="{{ route('login') }}" class="text-gray-300 hover:text-white transition">Login</a>
                @if (Route::has('register'))
                    <a href="{{ route('register') }}" class="bg-gray-700 text-white px-4 py-2 rounded-lg font-medium hover:bg-gray-600 transition">Register</a>
                @endif
            @else
                {{-- Authenticated User Profile Image and Dropdown --}}
                <div class="relative"> {{-- x-data is now on the header element --}}
                    {{-- Profile Image Placeholder Button --}}
                    <button @click="userMenuOpen = !userMenuOpen" class="flex items-center text-gray-300 hover:text-white focus:outline-none rounded-full overflow-hidden border-2 border-gray-700 w-10 h-10 justify-center items-center">
                         {{-- Replace with actual user avatar if available --}}
                         <i class="fas fa-user-circle text-2xl"></i> {{-- Placeholder icon --}}
                    </button>

                    {{-- Dropdown Menu (Translucent) --}}
                    <div x-show="userMenuOpen" @click.away="userMenuOpen = false" x-cloak
                         class="absolute right-0 mt-2 w-48 bg-gray-800 bg-opacity-90 rounded-md shadow-lg py-1 z-20 border border-gray-700"> {{-- Darker, slightly translucent background --}}
                        <div class="px-4 py-2 text-sm text-gray-200 border-b border-gray-700">
                            Signed in as:<br>
                            <span class="font-semibold">{{ Auth::user()->name }}</span>
                        </div>
                         {{-- Placeholder for other info --}}
                         {{-- <div class="px-4 py-2 text-sm text-gray-300 border-b border-gray-700">
                             Additional Info Here
                         </div> --}}
                        <a href="{{ route('dashboard') }}" class="block px-4 py-2 text-sm text-gray-300 hover:bg-gray-700 hover:text-white">Dashboard</a> {{-- Updated link --}}
                         {{-- Removed the "Add Barbershop" link from here --}}
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="block w-full text-left px-4 py-2 text-sm text-gray-300 hover:bg-gray-700 hover:text-white">Logout</button>
                        </form>
                    </div>
                </div>
            @endguest
        </div>
    </nav>
</header>
