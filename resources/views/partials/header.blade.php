{{-- Enhanced Fixed Header with Glassmorphism and Smooth Transitions --}}
<header class="fixed top-0 left-0 right-0 z-50 transition-all duration-500 ease-out"
        x-data="{ scrolled: false, userMenuOpen: false }"
        x-init="window.addEventListener('scroll', () => { scrolled = window.scrollY > 50; })"
        :class="{ 
            'bg-gray-900/95 backdrop-blur-xl shadow-2xl border-b border-white/10': !scrolled, 
            'bg-gray-900/60 backdrop-blur-lg shadow-lg border-b border-white/5': scrolled 
        }">
    
    {{-- Animated Background Gradient Overlay --}}
    <div class="absolute inset-0 transition-opacity duration-500"
         :class="{ 'opacity-30': scrolled, 'opacity-100': !scrolled }">
        <div class="absolute inset-0 bg-gradient-to-r from-gray-900/90 via-black/95 to-gray-900/90"></div>
        <div class="absolute inset-0 bg-gradient-to-b from-transparent via-transparent to-white/5"></div>
    </div>

    <nav class="relative container mx-auto px-6 py-4 flex items-center justify-between">
        {{-- Enhanced Logo with Glow Effect --}}
        <a href="{{ url('/') }}" 
           class="group flex items-center space-x-3 transition-all duration-300 hover:scale-105 relative z-10">
            <div class="relative">
                {{-- Logo Icon with Dynamic Background --}}
                <span class="flex items-center justify-center w-10 h-10 rounded-full bg-gradient-to-br from-white via-gray-200 to-white shadow-lg group-hover:shadow-white/30 transition-all duration-300 transform group-hover:rotate-12"
                      :class="{ 'shadow-white/20': scrolled }">
                    <svg class="w-5 h-5 text-gray-900 transition-transform duration-300 group-hover:scale-110" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M12 2L15.09 8.26L22 9.27L17 14.14L18.18 21.02L12 17.77L5.82 21.02L7 14.14L2 9.27L8.91 8.26L12 2Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                </span>
                {{-- Animated Glow Ring --}}
                <div class="absolute inset-0 rounded-full bg-white/10 blur-md opacity-0 group-hover:opacity-100 group-hover:scale-150 transition-all duration-500"></div>
            </div>
            {{-- Brand Text with Enhanced Typography --}}
            <span class="text-xl font-black text-white tracking-wide group-hover:text-gray-100 transition-colors duration-300"
                  :class="{ 'drop-shadow-lg': scrolled }">
                AfroCuts
            </span>
        </a>

        {{-- Enhanced Auth Section --}}
        <div class="flex items-center space-x-6 relative z-10">
            @guest
                {{-- Guest Login/Register with Modern Styling --}}
                <a href="{{ route('login') }}" 
                   class="text-gray-300 hover:text-white transition-all duration-300 font-medium tracking-wide hover:scale-105 relative group">
                    Login
                    <span class="absolute bottom-0 left-0 w-0 h-0.5 bg-white transition-all duration-300 group-hover:w-full"></span>
                </a>
                @if (Route::has('register'))
                    <a href="{{ route('register') }}" 
                       class="relative overflow-hidden bg-gradient-to-r from-white/20 to-white/10 backdrop-blur-sm text-white px-6 py-2.5 rounded-full font-bold border border-white/20 hover:border-white/40 transition-all duration-300 hover:scale-105 group"
                       :class="{ 
                           'shadow-lg bg-gradient-to-r from-white/30 to-white/20': !scrolled,
                           'shadow-md bg-gradient-to-r from-white/15 to-white/10': scrolled 
                       }">
                        <span class="relative z-10">Register</span>
                        {{-- Animated Background on Hover --}}
                        <div class="absolute inset-0 bg-gradient-to-r from-white/30 to-white/20 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                    </a>
                @endif
            @else
                {{-- Enhanced User Profile Dropdown --}}
                <div class="relative">
                    {{-- Profile Button with Ring Animation --}}
                    <button @click="userMenuOpen = !userMenuOpen" 
                            class="relative flex items-center justify-center w-11 h-11 rounded-full bg-gradient-to-br from-white/20 to-white/10 backdrop-blur-sm text-white hover:from-white/30 hover:to-white/20 transition-all duration-300 hover:scale-110 border border-white/20 hover:border-white/40 group"
                            :class="{ 
                                'shadow-lg bg-gradient-to-br from-white/25 to-white/15': !scrolled,
                                'shadow-md bg-gradient-to-br from-white/15 to-white/5': scrolled 
                            }">
                        <i class="fas fa-user text-lg transition-transform duration-300 group-hover:scale-110"></i>
                        {{-- Active Ring Indicator --}}
                        <div class="absolute inset-0 rounded-full border-2 border-white/0 transition-all duration-300"
                             :class="{ 'border-white/30 scale-110': userMenuOpen }"></div>
                    </button>

                    {{-- Enhanced Dropdown Menu with Glassmorphism --}}
                    <div x-show="userMenuOpen" 
                         @click.away="userMenuOpen = false" 
                         x-cloak
                         x-transition:enter="transition ease-out duration-300"
                         x-transition:enter-start="opacity-0 scale-95 translate-y-2"
                         x-transition:enter-end="opacity-100 scale-100 translate-y-0"
                         x-transition:leave="transition ease-in duration-200"
                         x-transition:leave-start="opacity-100 scale-100 translate-y-0"
                         x-transition:leave-end="opacity-0 scale-95 translate-y-2"
                         class="absolute right-0 mt-4 w-64 bg-gray-900/95 backdrop-blur-xl rounded-2xl shadow-2xl border border-white/10 overflow-hidden">
                        
                        {{-- User Info Header with Gradient --}}
                        <div class="relative px-6 py-4 bg-gradient-to-r from-gray-800/80 to-gray-700/80 border-b border-white/10">
                            <div class="absolute inset-0 bg-gradient-to-r from-white/5 to-transparent"></div>
                            <div class="relative">
                                <p class="text-xs text-gray-400 mb-1 font-medium tracking-wide uppercase">Signed in as</p>
                                <p class="font-bold text-white text-lg">{{ Auth::user()->name }}</p>
                            </div>
                        </div>
                        @php
                        $user = Auth::user();
                        $dashboardRoute = '#'; // Default fallback

                        if ($user) {
                            switch ($user->account_type) {
                                case 'regular':
                                    $dashboardRoute = route('user.dashboard');
                                    break;
                                case 'business':
                                    $dashboardRoute = route('business.dashboard');
                                    break;
                                case 'admin':
                                    $dashboardRoute = route('admin.dashboard');
                                    break;
                                case 'superadmin':
                                    $dashboardRoute = route('superadmin.dashboard');
                                    break;
                            }
                        }
                    @endphp
                    <div class="p-2">
                    <a class="group flex items-center w-full text-left px-4 py-3 text-gray-300 hover:text-white hover:bg-white/10 rounded-xl transition-all duration-300 font-medium" 
                       href="{{ $dashboardRoute }}" class="block px-4 py-2 text-sm text-gray-300 hover:bg-gray-700 hover:text-white">
                        Dashboard
                    </a>
                    </div>

                        {{-- Logout Button with Hover Effect --}}
                        <div class="p-2">
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" 
                                        class="group flex items-center w-full text-left px-4 py-3 text-gray-300 hover:text-white hover:bg-white/10 rounded-xl transition-all duration-300 font-medium">
                                    <div class="flex items-center justify-center w-8 h-8 rounded-lg bg-red-500/20 text-red-400 group-hover:bg-red-500/30 group-hover:text-red-300 transition-all duration-300 mr-3">
                                        <i class="fas fa-sign-out-alt text-sm"></i>
                                    </div>
                                    <span class="group-hover:translate-x-1 transition-transform duration-300">Logout</span>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            @endguest
        </div>
    </nav>

    {{-- Bottom Border Animation --}}
    <div class="absolute bottom-0 left-0 right-0 h-px bg-gradient-to-r from-transparent via-white/20 to-transparent transition-opacity duration-500"
         :class="{ 'opacity-100': !scrolled, 'opacity-30': scrolled }"></div>
</header>