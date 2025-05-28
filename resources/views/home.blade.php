@extends('layouts.app')

@section('content')

{{-- Hero Section with Animated Background --}}
<section class="relative w-full min-h-screen bg-gradient-to-br from-gray-950 via-black to-gray-900 overflow-hidden">
    {{-- Animated Background Pattern --}}
    <div class="absolute inset-0 opacity-5">
        <div class="absolute inset-0 bg-repeat animate-pulse" style="
            background-image: url('https://img.freepik.com/premium-vector/hairdressing-barbershop-tools-seamless-pattern-beauty-salon_341076-314.jpg?w=900');
            background-size: 200px auto;
            animation: float 20s ease-in-out infinite;
        "></div>
    </div>

    {{-- Floating Geometric Shapes --}}
    <div class="absolute inset-0 overflow-hidden pointer-events-none">
        <div class="absolute top-1/4 left-1/4 w-32 h-32 bg-gradient-to-r from-white/10 to-transparent rounded-full blur-xl animate-bounce"></div>
        <div class="absolute top-3/4 right-1/4 w-24 h-24 bg-gradient-to-l from-gray-400/20 to-transparent rounded-full blur-lg" style="animation: float 15s ease-in-out infinite reverse;"></div>
        <div class="absolute top-1/2 left-1/6 w-16 h-16 bg-white/5 rounded-full blur-md" style="animation: pulse 8s ease-in-out infinite;"></div>
    </div>

    <div class="relative z-10 mx-auto max-w-7xl">
        {{-- Enhanced Navigation --}}
        <nav class="flex items-center w-full py-6 px-6">
            <div class="flex items-center justify-between w-full">
                {{-- Logo with Glow Effect --}}
                <a href="{{ url('/') }}" class="group flex items-center space-x-3 transition-all duration-300 hover:scale-105">
                    <div class="relative">
                        <span class="flex items-center justify-center w-12 h-12 rounded-full bg-gradient-to-br from-white via-gray-200 to-white shadow-lg group-hover:shadow-white/20 transition-all duration-300">
                            <svg class="w-6 h-6 text-gray-900" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M12 2L15.09 8.26L22 9.27L17 14.14L18.18 21.02L12 17.77L5.82 21.02L7 14.14L2 9.27L8.91 8.26L12 2Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                        </span>
                        <div class="absolute inset-0 rounded-full bg-white/20 blur-md group-hover:blur-lg transition-all duration-300"></div>
                    </div>
                    <span class="text-2xl font-black text-white tracking-wide">AfroCuts</span>
                </a>

                {{-- Enhanced Auth Section --}}
                <div class="flex items-center space-x-6">
                    @guest
                        <a href="{{ route('login') }}" 
                           class="text-gray-300 hover:text-white transition-all duration-300 font-medium tracking-wide hover:scale-105">
                            Login
                        </a>
                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" 
                               class="bg-gradient-to-r from-gray-700 to-gray-800 text-white px-6 py-3 rounded-full font-bold hover:from-gray-600 hover:to-gray-700 transition-all duration-300 hover:scale-105 shadow-lg hover:shadow-xl">
                                Register
                            </a>
                        @endif
                    @else
                        <div class="relative" x-data="{ userMenuOpen: false }">
                            <button @click="userMenuOpen = !userMenuOpen" 
                                    class="flex items-center justify-center w-12 h-12 rounded-full bg-gradient-to-br from-gray-700 to-gray-800 text-white hover:from-gray-600 hover:to-gray-700 transition-all duration-300 hover:scale-110 shadow-lg hover:shadow-xl border-2 border-gray-600">
                                <i class="fas fa-user text-lg"></i>
                            </button>
                            <div x-show="userMenuOpen" @click.away="userMenuOpen = false" x-cloak
                                 x-transition:enter="transition ease-out duration-200"
                                 x-transition:enter-start="opacity-0 scale-95"
                                 x-transition:enter-end="opacity-100 scale-100"
                                 class="absolute right-0 mt-4 w-56 bg-gray-800/95 backdrop-blur-lg rounded-2xl shadow-2xl border border-gray-700/50 overflow-hidden">
                                <div class="px-6 py-4 border-b border-gray-700/50 bg-gradient-to-r from-gray-800 to-gray-700">
                                    <p class="text-xs text-gray-400 mb-1">Signed in as</p>
                                    <p class="font-bold text-white">{{ Auth::user()->name }}</p>
                                </div>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" 
                                            class="block w-full text-left px-6 py-4 text-gray-300 hover:bg-gray-700/50 hover:text-white transition-all duration-200 font-medium">
                                        <i class="fas fa-sign-out-alt mr-3"></i>Logout
                                    </button>
                                </form>
                            </div>
                        </div>
                    @endguest
                </div>
            </div>
        </nav>

        {{-- Hero Content --}}
        <div class="relative flex flex-col items-center justify-center min-h-[80vh] px-6 text-center">
            <div class="max-w-6xl mx-auto space-y-8">
                {{-- Main Heading with Staggered Animation --}}
                <div class="space-y-4">
                    <h1 class="text-4xl md:text-6xl font-black text-white leading-tight text-center">
                        <span class="block opacity-0 animate-fadeInUp" style="animation-delay: 0.2s; animation-fill-mode: forwards;">Find the</span>
                        <span class="block bg-gradient-to-r from-white via-gray-200 to-white bg-clip-text text-transparent opacity-0 animate-fadeInUp" style="animation-delay: 0.4s; animation-fill-mode: forwards;">Perfect</span>
                        <span class="block opacity-0 animate-fadeInUp" style="animation-delay: 0.6s; animation-fill-mode: forwards;">
                            Black Barbershop
                            <span class="inline-block ml-4 animate-bounce" style="animation-delay: 1s;">✂️💇🏽‍♂️</span>
                        </span>
                    </h1>
                </div>

                <p class="text-l md:text-2xl text-gray-300 max-w-3xl mx-auto leading-relaxed opacity-0 animate-fadeInUp font-light text-center" style="animation-delay: 0.8s; animation-fill-mode: forwards;">
                    Discover skilled barbers who specialize in African American hair care and styling in your neighborhood
                </p>

                {{-- Enhanced Search Form --}}
                <div class="opacity-0 animate-fadeInUp" style="animation-delay: 1s; animation-fill-mode: forwards;">
                    <form action="{{ route('barbershops.search') }}" method="GET" class="max-w-2xl mx-auto mt-12">
                        <div class="relative group">
                            <div class="absolute inset-0 bg-gradient-to-r from-white/20 to-white/10 rounded-full blur-xl group-hover:blur-2xl transition-all duration-300"></div>
                            <div class="relative bg-white/10 backdrop-blur-lg rounded-full border border-white/20 p-2 hover:bg-white/15 transition-all duration-300">
                                <div class="flex items-center">
                                    <div class="flex items-center justify-center w-12 h-12 ml-2">
                                        <i class="fas fa-search text-white text-lg"></i>
                                    </div>
                                    <input
                                        type="text"
                                        name="query"
                                        placeholder="Search for barbershops near you..."
                                        class="flex-1 bg-transparent text-white placeholder-gray-300 px-4 py-4 focus:outline-none text-lg">
                                    <button type="submit" 
                                            class="bg-gradient-to-r from-white to-gray-200 text-gray-900 px-8 py-4 rounded-full font-bold hover:from-gray-100 hover:to-gray-300 transition-all duration-300 hover:scale-105 shadow-lg hover:shadow-xl mr-2">
                                        Search
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            {{-- Scroll Indicator - Fixed positioning --}}
            <div class="absolute bottom-8 left-1/2 transform -translate-x-1/2 opacity-0 animate-fadeInUp" style="animation-delay: 1.2s; animation-fill-mode: forwards;">
                <div class="flex flex-col items-center text-gray-400 animate-bounce">
                    <i class="fas fa-chevron-down"></i>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- Find Your AfroCuts Specialist By City --}}
<section class="py-20 bg-gradient-to-br from-gray-100 to-white">
    <div class="container mx-auto px-6">
        <div class="text-center mb-16">
            <h2 class="text-4xl md:text-5xl font-black text-gray-900 mb-4">Find Your AfroCuts Specialist</h2>
            <p class="text-xl text-gray-600 max-w-2xl mx-auto">Browse barbershops by city and find the perfect cut in your area</p>
        </div>

        {{-- Popular Cities Grid --}}
        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-6 gap-4 mb-12">
            @php
            $cities = [
                ['name' => 'Atlanta', 'state' => 'GA', 'count' => 0],
                ['name' => 'Houston', 'state' => 'TX', 'count' => 0],
                ['name' => 'Chicago', 'state' => 'IL', 'count' => 0],
                ['name' => 'Detroit', 'state' => 'MI', 'count' => 0],
                ['name' => 'New York', 'state' => 'NY', 'count' => 0],
                ['name' => 'Los Angeles', 'state' => 'CA', 'count' => 0],
                ['name' => 'Philadelphia', 'state' => 'PA', 'count' => 0],
                ['name' => 'Miami', 'state' => 'FL', 'count' => 0],
                ['name' => 'Dallas', 'state' => 'TX', 'count' => 0],
                ['name' => 'Washington', 'state' => 'DC', 'count' => 0],
                ['name' => 'Memphis', 'state' => 'TN', 'count' => 0],
                ['name' => 'Birmingham', 'state' => 'AL', 'count' => 0]
            ];
            @endphp

            @foreach($cities as $index => $city)
            <a href="#" 
               class="group bg-gradient-to-br from-gray-800 to-gray-900 border border-gray-700 rounded-2xl p-6 hover:from-gray-700 hover:to-gray-800 transition-all duration-300 hover:scale-105 hover:shadow-xl opacity-0 animate-fadeInUp" 
               style="animation-delay: {{ $index * 0.1 }}s; animation-fill-mode: forwards;">
                <div class="text-center">
                    <h3 class="text-lg font-bold text-white mb-1">{{ $city['name'] }}</h3>
                    <p class="text-gray-400 text-sm mb-2">{{ $city['state'] }}</p>
                    <div class="bg-white/10 rounded-full px-3 py-1 inline-block">
                        <span class="text-white text-xs font-semibold">{{ $city['count'] }} shops</span>
                    </div>
                </div>
            </a>
            @endforeach
        </div>

        {{-- View All Cities Button --}}
        <div class="text-center">
            <a href="#" 
               class="inline-flex items-center space-x-3 bg-gradient-to-r from-gray-800 to-gray-900 text-white px-8 py-4 rounded-full font-bold hover:from-gray-700 hover:to-gray-800 transition-all duration-300 hover:scale-105 shadow-lg hover:shadow-xl">
                <span>View All Cities</span>
                <i class="fas fa-map-marker-alt"></i>
            </a>
        </div>
    </div>
</section>



{{-- Featured Barbershops Section --}}
<section class="py-20 bg-gradient-to-br from-white to-gray-50">
    <div class="container mx-auto px-6">
        <div class="text-center mb-16">
            <h2 class="text-4xl md:text-5xl font-black text-gray-900 mb-4">Featured Barbershops</h2>
            <p class="text-xl text-gray-600 max-w-2xl mx-auto">Handpicked establishments known for their exceptional service and expertise</p>
        </div>

        @if ($featuredBarbershops->count())
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 mb-16">
                @foreach ($featuredBarbershops as $index => $barbershop)
                <div class="group bg-white border border-gray-200 rounded-3xl shadow-lg hover:shadow-2xl transition-all duration-500 overflow-hidden hover:-translate-y-2 opacity-0 animate-fadeInUp" style="animation-delay: {{ $index * 0.1 }}s; animation-fill-mode: forwards;">
                    {{-- Image Container --}}
                    <div class="relative overflow-hidden">
                        @if($barbershop->logo)
                            <img src="{{ asset('storage/' . $barbershop->logo) }}" 
                                 alt="{{ $barbershop->name }}" 
                                 class="w-full h-56 object-cover group-hover:scale-110 transition-transform duration-500">
                        @else
                            <div class="w-full h-56 bg-gradient-to-br from-gray-200 to-gray-300 flex items-center justify-center group-hover:from-gray-300 group-hover:to-gray-400 transition-all duration-500">
                                <i class="fas fa-cut text-5xl text-gray-500 group-hover:scale-110 transition-transform duration-500"></i>
                            </div>
                        @endif
                        <div class="absolute top-4 right-4">
                            <span class="bg-gray-900/80 backdrop-blur-sm text-white px-3 py-1 rounded-full text-sm font-semibold">Featured</span>
                        </div>
                    </div>

                    {{-- Content --}}
                    <div class="p-6 space-y-4">
                        <h3 class="text-xl font-bold text-gray-900 group-hover:text-gray-700 transition-colors duration-300">
                            {{ $barbershop->name }}
                        </h3>
                        
                        <div class="flex items-center text-gray-600 space-x-2">
                            <div class="w-2 h-2 bg-red-500 rounded-full"></div>
                            <span class="font-medium">{{ $barbershop->city }}, {{ $barbershop->state }}</span>
                        </div>
                        
                        <p class="text-gray-700 leading-relaxed">{{ Str::limit($barbershop->description, 100) }}</p>
                        
                        <div class="flex items-center space-x-4 text-sm text-gray-600">
                            <div class="flex items-center space-x-1">
                                <i class="fas fa-star text-yellow-500"></i>
                                <span>4.8</span>
                            </div>
                            <div class="flex items-center space-x-1">
                                <i class="fas fa-clock"></i>
                                <span>Open Now</span>
                            </div>
                        </div>
                        
                        <a href="{{ route('barbershops.show', $barbershop->id) }}" 
                           class="inline-flex items-center space-x-2 bg-gradient-to-r from-gray-800 to-gray-900 text-white px-6 py-3 rounded-full font-bold hover:from-gray-700 hover:to-gray-800 transition-all duration-300 hover:scale-105 shadow-lg hover:shadow-xl">
                            <span>View Details</span>
                            <i class="fas fa-arrow-right text-sm group-hover:translate-x-1 transition-transform duration-300"></i>
                        </a>
                    </div>
                </div>
                @endforeach
            </div>

            {{-- View All Button --}}
            <div class="text-center">
                <a href="{{ route('barbershops.index') }}" 
                   class="inline-flex items-center space-x-3 bg-gradient-to-r from-gray-800 to-gray-900 text-white px-10 py-4 rounded-full font-black text-lg hover:from-gray-700 hover:to-gray-800 transition-all duration-300 hover:scale-105 shadow-2xl hover:shadow-3xl">
                    <span>View All Barbershops</span>
                    <i class="fas fa-arrow-right group-hover:translate-x-1 transition-transform duration-300"></i>
                </a>
            </div>
        @else
            <div class="max-w-md mx-auto bg-white border border-gray-200 rounded-3xl shadow-lg p-8 text-center">
                <div class="w-16 h-16 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-search text-gray-400 text-2xl"></i>
                </div>
                <h3 class="text-xl font-bold text-gray-900 mb-2">No Featured Barbershops</h3>
                <p class="text-gray-600">Check back soon for featured establishments in your area.</p>
            </div>
        @endif
    </div>
</section>

{{-- Why Choose AfroCuts Section --}}
<section class="py-20 bg-gradient-to-br from-gray-100 to-white">
    <div class="container mx-auto px-6">
        <div class="text-center mb-16">
            <h2 class="text-4xl md:text-5xl font-black text-gray-900 mb-4">Why Choose AfroCuts?</h2>
            <p class="text-xl text-gray-600 max-w-2xl mx-auto">We understand the unique needs of Black hair and connect you with specialists who do too</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-12">
            @php
            $features = [
                [
                    'icon' => 'fas fa-users',
                    'title' => 'Expert Barbers Only',
                    'description' => 'All our listed barbers are experienced in African American hair care and styling techniques.',
                    'color' => 'from-blue-500 to-blue-600'
                ],
                [
                    'icon' => 'fas fa-map-marked-alt',
                    'title' => 'Local & Convenient',
                    'description' => 'Find quality barbershops in your neighborhood with real reviews from the community.',
                    'color' => 'from-green-500 to-green-600'
                ],
                [
                    'icon' => 'fas fa-shield-alt',
                    'title' => 'Verified Reviews',
                    'description' => 'Read authentic reviews from customers who share your hair type and styling preferences.',
                    'color' => 'from-purple-500 to-purple-600'
                ]
            ];
            @endphp

            @foreach($features as $index => $feature)
            <div class="text-center group opacity-0 animate-fadeInUp" style="animation-delay: {{ $index * 0.2 }}s; animation-fill-mode: forwards;">
                <div class="relative mb-8">
                    <div class="w-20 h-20 bg-gradient-to-r {{ $feature['color'] }} rounded-2xl flex items-center justify-center mx-auto group-hover:scale-110 transition-transform duration-300 shadow-xl">
                        <i class="{{ $feature['icon'] }} text-white text-3xl"></i>
                    </div>
                    <div class="absolute inset-0 bg-gradient-to-r {{ $feature['color'] }} rounded-2xl blur-xl opacity-25 group-hover:opacity-40 transition-opacity duration-300"></div>
                </div>
                <h3 class="text-2xl font-bold text-gray-900 mb-4">{{ $feature['title'] }}</h3>
                <p class="text-gray-600 leading-relaxed text-lg">{{ $feature['description'] }}</p>
            </div>
            @endforeach
        </div>
    </div>
</section>

{{-- Call to Action Section --}}
<section class="py-20 bg-gradient-to-br from-white to-gray-50">
    <div class="container mx-auto px-6 text-center">
        <div class="max-w-4xl mx-auto">
            <h2 class="text-4xl md:text-5xl font-black text-gray-900 mb-6">Ready to Find Your Perfect Cut?</h2>
            <p class="text-xl text-gray-600 mb-12 leading-relaxed">Join thousands of satisfied customers who've found their go-to barber through AfroCuts</p>
            
            <div class="flex flex-col sm:flex-row gap-6 justify-center items-center">
                <a href="{{ route('barbershops.index') }}" 
                   class="bg-gradient-to-r from-gray-800 to-gray-900 text-white px-10 py-4 rounded-full font-black text-lg hover:from-gray-700 hover:to-gray-800 transition-all duration-300 hover:scale-105 shadow-2xl hover:shadow-3xl">
                    Browse Barbershops
                </a>
                
                @guest
                <a href="{{ route('register') }}" 
                   class="border-2 border-gray-800 text-gray-800 px-10 py-4 rounded-full font-bold hover:bg-gray-800 hover:text-white transition-all duration-300 hover:scale-105">
                    Join AfroCuts
                </a>
                @endguest
            </div>
        </div>
    </div>
</section>

@endsection