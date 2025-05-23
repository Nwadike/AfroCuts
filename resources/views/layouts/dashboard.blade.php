<!DOCTYPE html>
<html lang="en" x-data="{ sidebarOpen: window.innerWidth >= 768 ? true : false }">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AfroCuts Dashboard</title>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <style>
        [x-cloak] { display: none !important; }
        body {
            display: flex;
            flex-direction: column;
            min-height: 100vh;
            /* Removed bg-gray-100 */
            /* Added background image styling from login.blade.php */
            background-image: url('https://img.freepik.com/premium-vector/hairdressing-barbershop-tools-seamless-pattern-beauty-salon_341076-314.jpg?w=900'); /* Your doodle image URL */
            background-size: 200px auto; /* Size of the doodle */
            background-repeat: repeat; /* Ensure repeating */
            background-position: center; /* Center the repeating pattern */
        }
        main {
            flex-grow: 1;
            /* Removed bg-gray-50 to allow body background to show */
            background-color: transparent; /* Ensure no background here */
        }
        /* Custom scrollbar for aesthetic */
        .sidebar-nav::-webkit-scrollbar {
            width: 8px;
        }
        .sidebar-nav::-webkit-scrollbar-track {
            background: #2d3748; /* Darker gray */
        }
        .sidebar-nav::-webkit-scrollbar-thumb {
            background-color: #4a5568; /* Even darker gray */
            border-radius: 4px;
            border: 2px solid #2d3748;
        }

        /* Glass effect for the sidebar */
        .glass-sidebar {
            background-color: rgba(31, 41, 55, 0.8); /* bg-gray-800 with 80% opacity */
            backdrop-filter: blur(10px); /* Apply blur effect */
            -webkit-backdrop-filter: blur(10px); /* Safari support */
            border-right: 1px solid rgba(255, 255, 255, 0.1); /* Subtle white border */
        }
    </style>
    @stack('styles')
</head>
<body class="font-sans antialiased"> {{-- Removed bg-gray-100 from body class --}}

    {{-- Fixed Header (already included in your partials) --}}
    {{-- Ensure your header partial has a background color and z-index higher than the sidebar --}}
    @include('partials.header')

    {{-- Main wrapper div with padding-top to account for the fixed header --}}
    <div class="flex flex-1 pt-16"> {{-- Added pt-16 to account for fixed header height (adjust if your header height is different) --}}
        {{-- Sidebar --}}
        {{-- Adjusted positioning and z-index for responsiveness --}}
        {{-- Added glass-sidebar class for the effect --}}
        <aside class="w-64 space-y-6 py-7 px-2 fixed inset-y-0 left-0 transform -translate-x-full md:relative md:translate-x-0 transition duration-200 ease-in-out z-40 md:z-auto glass-sidebar"
               :class="{ 'translate-x-0 ease-out': sidebarOpen, '-translate-x-full ease-in': !sidebarOpen }" x-cloak>
            <div class="flex items-center justify-between px-4">
                {{-- Removed the logo element and barbershop name from the sidebar --}}
                {{-- <a href="{{ url('/') }}" class="flex items-center space-x-2 text-white hover:text-gray-300">
                    <span class="flex items-center justify-center flex-shrink-0 w-8 h-8 text-gray-900 rounded-full bg-gradient-to-br from-white via-gray-200 to-white">
                        <svg class="w-auto h-5 -translate-y-px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M12 2L15.09 8.26L22 9.27L17 14.14L18.18 21.02L12 17.77L5.82 21.02L7 14.14L2 9.27L8.91 8.26L12 2Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </span>
                    <span class="text-xl font-bold">AfroCuts</span>
                </a> --}}
                {{-- Mobile close button for sidebar --}}
                <button @click="sidebarOpen = false" class="md:hidden text-gray-400 hover:text-white focus:outline-none focus:text-white">
                    <i class="fas fa-times text-lg"></i>
                </button>
            </div>

            <nav class="sidebar-nav flex-1 px-2 py-4 overflow-y-auto">
                <ul class="space-y-2">
                    {{-- Dashboard Link (using your original route name) --}}
                    <li>
                        <a href="{{ route('dashboard') }}" class="flex items-center px-3 py-2 rounded-md text-gray-300 hover:bg-gray-700 hover:text-white transition @if(request()->routeIs('dashboard')) bg-gray-700 text-white @endif">
                            <i class="fas fa-tachometer-alt mr-2"></i> Dashboard
                        </a>
                    </li>

                    {{-- Regular User Menu Items --}}
                    @if(Auth::user()->isRegular())
                    <li>
                        <a href="{{ route('bookings.index') }}" class="flex items-center px-3 py-2 rounded-md text-gray-300 hover:bg-gray-700 hover:text-white transition @if(request()->routeIs('bookings.index')) bg-gray-700 text-white @endif">
                            <i class="fas fa-calendar-check mr-2"></i> My Bookings
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('barbershops.index') }}" class="flex items-center px-3 py-2 rounded-md text-gray-300 hover:bg-gray-700 hover:text-white transition @if(request()->routeIs('barbershops.index')) bg-gray-700 text-white @endif">
                            <i class="fas fa-search mr-2"></i> Discover Barbershops
                        </a>
                    </li>
                    @endif

                    {{-- Business User Menu Items --}}
                    @if(Auth::user()->isBusiness())
                    <li>
                        @if(Auth::user()->barbershop)
                        <a href="{{ route('barbershops.edit.business') }}" class="flex items-center px-3 py-2 rounded-md text-gray-300 hover:bg-gray-700 hover:text-white transition @if(request()->routeIs('barbershops.edit.business')) bg-gray-700 text-white @endif">
                            <i class="fas fa-store-alt mr-2"></i> Manage Barbershop
                        </a>
                        @else
                        <a href="{{ route('barbershops.create') }}" class="flex items-center px-3 py-2 rounded-md text-gray-300 hover:bg-gray-700 hover:text-white transition @if(request()->routeIs('barbershops.create')) bg-gray-700 text-white @endif">
                            <i class="fas fa-plus-circle mr-2"></i> Add My Barbershop
                        </a>
                        @endif
                    </li>
                    <li>
                        {{-- Link to received bookings - using a placeholder route name --}}
                        <a href="{{ route('barbershop.bookings.received') }}" class="flex items-center px-3 py-2 rounded-md text-gray-300 hover:bg-gray-700 hover:text-white transition">
                            <i class="fas fa-receipt mr-2"></i> Received Bookings
                        </a>
                    </li>
                    {{-- New Barbershop Specific Menu Items --}}
                    <li>
                         {{-- Link to Payment Options - using a placeholder route name --}}
                        <a href="{{ route('barbershop.payments.index') }}" class="flex items-center px-3 py-2 rounded-md text-gray-300 hover:bg-gray-700 hover:text-white transition">
                            <i class="fas fa-credit-card mr-2"></i> Payment Options
                        </a>
                    </li>
                    <li>
                         {{-- Link to Business Plans - using a placeholder route name --}}
                        <a href="{{ route('barbershop.plans.index') }}" class="flex items-center px-3 py-2 rounded-md text-gray-300 hover:bg-gray-700 hover:text-white transition">
                            <i class="fas fa-gem mr-2"></i> Business Plans
                        </a>
                    </li>
                    <li>
                         {{-- Link to Analytics & Reports - using a placeholder route name --}}
                        <a href="{{ route('barbershop.analytics.index') }}" class="flex items-center px-3 py-2 rounded-md text-gray-300 hover:bg-gray-700 hover:text-white transition">
                            <i class="fas fa-chart-line mr-2"></i> Analytics & Reports
                        </a>
                    </li>
                    <li>
                         {{-- Link to Customer Reviews - using a placeholder route name --}}
                        <a href="{{ route('barbershop.reviews.index') }}" class="flex items-center px-3 py-2 rounded-md text-gray-300 hover:bg-gray-700 hover:text-white transition">
                            <i class="fas fa-star mr-2"></i> Customer Reviews
                        </a>
                    </li>
                    @endif

                    {{-- General Settings/Account Links --}}
                    <li class="border-t border-gray-700 pt-2 mt-2"> {{-- Separator --}}
                         {{-- Link to Account Settings - using a placeholder route name --}}
                         <a href="{{ route('profile.edit') }}" class="flex items-center px-3 py-2 rounded-md text-gray-300 hover:bg-gray-700 hover:text-white transition">
                             <i class="fas fa-user-cog mr-2"></i> Account Settings
                         </a>
                     </li>

                    {{-- Logout Link --}}
                    <li>
                        <form method="POST" action="{{ route('logout') }}" class="w-full">
                            @csrf
                            <button type="submit" class="flex items-center w-full px-3 py-2 rounded-md text-gray-300 hover:bg-gray-700 hover:text-white transition text-left">
                                <i class="fas fa-sign-out-alt mr-2"></i> Logout
                            </button>
                        </form>
                    </li>
                </ul>
            </nav>
        </aside>

        {{-- Main Content Area --}}
        {{-- Removed md:pl-64 and mt-16 md:mt-0 as requested. This may cause layout issues. --}}
        <div class="flex-1 flex flex-col"> {{-- Removed padding and margin classes --}}
            {{-- Mobile Sidebar Toggle Button (Hamburger) --}}
            {{-- Fixed positioning and z-index to stay above content and sidebar --}}
            <div class="p-4 md:hidden bg-white shadow-sm fixed top-0 left-0 right-0 z-50 flex items-center justify-between">
                 <h1 class="text-xl font-bold text-gray-900">Dashboard</h1> {{-- Added a title for mobile header --}}
                <button @click="sidebarOpen = !sidebarOpen" class="bg-gray-800 text-white p-2 rounded-md focus:outline-none">
                    <i :class="{'fas fa-times': sidebarOpen, 'fas fa-bars': !sidebarOpen}"></i>
                    <span class="ml-2">Menu</span>
                </button>
            </div>

            <main class="flex-grow p-4 md:p-8"> {{-- Padding around the centered container --}}
                {{-- Centered Container for Main Content --}}
                <div class="container mx-auto max-w-screen-lg"> {{-- Added container, mx-auto, and max-width --}}
                    {{-- Removed the large desktop page title from the layout --}}
                    {{-- This is where the content from individual dashboard pages (like users/dashboard.blade.php) will be inserted --}}
                    @yield('dashboard_content')
                </div>
            </main>
        </div>
    </div>

    {{-- Removed the footer partial inclusion --}}
    {{-- @include('partials.footer') --}}

    @stack('scripts')
</body>
</html>
