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
    <link rel="stylesheet" href="{{asset('css/style.css')}}">

    @stack('style')
</head>

<body>

    {{-- Modern Fixed Header --}}
    <header class="fixed top-0 left-0 right-0 z-50 header-glass">
        @include('partials.header')
    </header>

    {{-- Main wrapper --}}
    <div class="flex pt-20"> {{-- Padding for fixed header --}}
        {{-- Modern Sidebar --}}
        <aside class="w-64 fixed inset-y-0 left-0 transform -translate-x-full md:relative md:translate-x-0 transition-transform duration-300 ease-in-out z-40 glass-sidebar"
               :class="{ 'translate-x-0': sidebarOpen, '-translate-x-full': !sidebarOpen }" 
               x-cloak>
            
            {{-- Sidebar Header --}}
            <div class="p-6 border-b border-white/20">
                <div class="flex items-center justify-between">
                    <div class="text-white">
                        <h2 class="text-lg font-semibold">Dashboard</h2>
                        <p class="text-xs text-white/70">Welcome back!</p>
                    </div>
                    <button @click="sidebarOpen = false" class="md:hidden text-white/70 hover:text-white">
                        <i class="fas fa-times text-lg"></i>
                    </button>
                </div>
            </div>

 {{-- Navigation --}}
            <nav class="flex-1 px-4 py-6 custom-scrollbar ">
                <div class="space-y-2">
                    {{-- Dashboard --}}
                    <a href="{{ route('dashboard') }}" 
                       class="nav-item flex items-center px-4 py-3 rounded-lg text-white/90 hover:text-white @if(request()->routeIs('dashboard')) active @endif">
                        <i class="fas fa-home mr-3 text-lg"></i>
                        <span class="font-medium">Dashboard</span>
                    </a>

                    {{-- Find Barbershops --}}
                    <a href="#" 
                       class="nav-item flex items-center px-4 py-3 rounded-lg text-white/90 hover:text-white">
                        <i class="fas fa-search mr-3 text-lg"></i>
                        <span class="font-medium">Find Barbershops</span>
                    </a>

                    {{-- My Bookings --}}
                    <a href="#" 
                       class="nav-item flex items-center px-4 py-3 rounded-lg text-white/90 hover:text-white">
                        <i class="fas fa-calendar-alt mr-3 text-lg"></i>
                        <span class="font-medium">My Bookings</span>
                        <span class="ml-auto bg-amber-500 text-white text-xs px-2 py-1 rounded-full">0</span>
                    </a>

                    {{-- Favorites --}}
                    <a href="#" 
                       class="nav-item flex items-center px-4 py-3 rounded-lg text-white/90 hover:text-white">
                        <i class="fas fa-heart mr-3 text-lg"></i>
                        <span class="font-medium">Favorites</span>
                    </a>

                    {{-- Reviews --}}
                    <a href="#" 
                       class="nav-item flex items-center px-4 py-3 rounded-lg text-white/90 hover:text-white">
                        <i class="fas fa-star mr-3 text-lg"></i>
                        <span class="font-medium">My Reviews</span>
                    </a>

                    {{-- Divider --}}
                    <div class="my-6 border-t border-white/20"></div>

                    {{-- Settings --}}
                    <a href="{{ route('profile.edit') }}" 
                       class="nav-item flex items-center px-4 py-3 rounded-lg text-white/90 hover:text-white">
                        <i class="fas fa-cog mr-3 text-lg"></i>
                        <span class="font-medium">Settings</span>
                    </a>

                    {{-- Help --}}
                    <a href="#" 
                       class="nav-item flex items-center px-4 py-3 rounded-lg text-white/90 hover:text-white">
                        <i class="fas fa-question-circle mr-3 text-lg"></i>
                        <span class="font-medium">Help & Support</span>
                    </a>
                </div>
            </nav>           

            {{-- Sidebar Footer --}}
            <div class="p-4 border-t border-white/20">
                <div class="bg-white/10 rounded-lg p-3 text-center">
                    <i class="fas fa-crown text-amber-400 text-2xl mb-2"></i>
                    <p class="text-white text-sm font-medium">Upgrade to Premium</p>
                    <p class="text-white/70 text-xs">Get exclusive features</p>
                    <button class="mt-2 w-full bg-amber-500 hover:bg-amber-600 text-white text-xs py-2 px-3 rounded-lg transition-colors">
                        Learn More
                    </button>
                </div>
            </div>
        </aside>

        {{-- Main Content Area --}}
        <div class="flex-1 flex flex-col md:ml-0">
            <main class="flex-grow p-6 md:p-8">
                <div class="max-w-7xl mx-auto">
                    @yield('dashboard_content')
                </div>
            </main>
        </div>
    </div>

    {{-- Mobile Overlay --}}
    <div x-show="sidebarOpen" @click="sidebarOpen = false" 
         class="fixed inset-0 bg-black/50 z-30 md:hidden"
         x-transition:enter="transition-opacity ease-linear duration-300"
         x-transition:enter-start="opacity-0"
         x-transition:enter-end="opacity-100"
         x-transition:leave="transition-opacity ease-linear duration-300"
         x-transition:leave-start="opacity-100"
         x-transition:leave-end="opacity-0"></div>

    @stack('scripts')
</body>
</html>