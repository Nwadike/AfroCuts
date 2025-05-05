<!DOCTYPE html>
<html lang="en" x-data="{ sidebarOpen: false }"> {{-- Added Alpine.js for sidebar toggle --}}
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
        }
        main {
            flex-grow: 1;
        }
    </style>
    @stack('styles')
</head>
<body class="bg-gray-100 font-sans antialiased">

    {{-- Fixed Header --}}
    {{-- Include the simple dark header partial --}}
    @include('partials.header')

    {{-- Main Content Area with Sidebar --}}
    <div class="flex flex-col md:flex-row mt-16"> {{-- Added mt-16 for header spacing --}}

        {{-- Sidebar (Hidden on mobile by default, shown on md and up) --}}
        {{-- Added Alpine.js x-show for mobile toggle --}}
        <aside class="w-full md:w-64 bg-gray-800 text-gray-200 flex-shrink-0 md:block"
               x-show="sidebarOpen"
               @click.away="sidebarOpen = false" {{-- Close sidebar when clicking outside on mobile --}}
               x-cloak
               :class="{ 'block': sidebarOpen, 'hidden': !sidebarOpen }">
            <div class="p-4">
                <h3 class="text-lg font-semibold mb-4 text-white">Dashboard Menu</h3>
                <nav>
                    <ul class="space-y-2">
                        {{-- Dashboard Link (Home for dashboard) --}}
                        <li>
                            <a href="{{ route('dashboard') }}" class="flex items-center px-3 py-2 rounded-md hover:bg-gray-700 transition">
                                <i class="fas fa-home mr-2"></i> Dashboard Home
                            </a>
                        </li>

                        {{-- Regular User Links --}}
                        @auth
                            @if (Auth::user()->isRegular())
                                <li>
                                    <a href="{{ route('dashboard') }}" class="flex items-center px-3 py-2 rounded-md hover:bg-gray-700 transition">
                                        <i class="fas fa-book-open mr-2"></i> My Bookings
                                    </a>
                                </li>
                                {{-- Add other regular user links here --}}
                            @endif
                        @endauth

                        {{-- Business User Links --}}
                         @auth
                             @if (Auth::user()->isBusiness())
                                 <li>
                                     <a href="{{ route('dashboard') }}" class="flex items-center px-3 py-2 rounded-md hover:bg-gray-700 transition">
                                         <i class="fas fa-calendar-check mr-2"></i> Received Bookings
                                     </a>
                                 </li>
                                 @if (Auth::user()->barbershop)
                                     <li>
                                         <a href="{{ route('barbershops.edit.business') }}" class="flex items-center px-3 py-2 rounded-md hover:bg-gray-700 transition">
                                             <i class="fas fa-store mr-2"></i> Barbershop Settings
                                         </a>
                                     </li>
                                      {{-- Add other business management links here (e.g., manage services) --}}
                                 @else
                                      <li>
                                          <a href="{{ route('barbershops.create.initial') }}" class="flex items-center px-3 py-2 rounded-md hover:bg-gray-700 transition">
                                              <i class="fas fa-plus-circle mr-2"></i> Create Barbershop
                                          </a>
                                      </li>
                                 @endif
                                 {{-- Add other business user links here --}}
                             @endif
                         @endauth

                        {{-- General Authenticated User Links --}}
                        {{-- <li>
                             <a href="#" class="flex items-center px-3 py-2 rounded-md hover:bg-gray-700 transition">
                                 <i class="fas fa-user-cog mr-2"></i> Account Settings
                             </a>
                         </li> --}}

                         {{-- Logout Link --}}
                         <li>
                             <form method="POST" action="{{ route('logout') }}" class="w-full">
                                 @csrf
                                 <button type="submit" class="flex items-center w-full px-3 py-2 rounded-md hover:bg-gray-700 transition text-left">
                                     <i class="fas fa-sign-out-alt mr-2"></i> Logout
                                 </button>
                             </form>
                         </li>
                    </ul>
                </nav>
            </div>
        </aside>

        {{-- Main Content --}}
        <main class="flex-grow p-4 md:p-8">
            {{-- Mobile Sidebar Toggle Button --}}
            <button @click="sidebarOpen = !sidebarOpen" class="md:hidden bg-gray-800 text-white p-2 rounded-md mb-4 focus:outline-none">
                <i :class="{'fas fa-times': sidebarOpen, 'fas fa-bars': !sidebarOpen}"></i> {{-- Toggle icon --}}
                <span class="ml-2">Menu</span>
            </button>

            @yield('dashboard_content') {{-- Content from the specific dashboard view goes here --}}
        </main>
    </div>

    {{-- Include the footer partial --}}
    @include('partials.footer')

    @stack('scripts')
</body>
</html>
