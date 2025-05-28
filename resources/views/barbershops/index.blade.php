@extends('layouts.app')

@section('content')
    {{-- Include the header --}}
    @include('partials.header')

    {{-- Hero Section with Cultural Background --}}
    <div class="relative bg-gray-50 overflow-hidden">
        {{-- Decorative Background Pattern --}}
        <div class="absolute inset-0 opacity-5">
            <div class="absolute inset-0" style="
                background-image: url('data:image/svg+xml,<svg xmlns=%22http://www.w3.org/2000/svg%22 viewBox=%220 0 100 100%22><circle cx=%2250%22 cy=%2250%22 r=%223%22 fill=%22%23000%22/><rect x=%2245%22 y=%2240%22 width=%2210%22 height=%225%22 fill=%22%23000%22/><path d=%22M30,60 Q40,50 50,60 Q60,50 70,60%22 stroke=%22%23000%22 stroke-width=%222%22 fill=%22none%22/></svg>');
                background-size: 80px 80px;
                background-repeat: repeat;
            "></div>
        </div>

        <div class="container mx-auto px-4 py-16 pt-32 relative z-10">
            {{-- Main Heading with Cultural Flair --}}
            <div class="text-center mb-12">
                <h1 class="text-5xl md:text-6xl font-bold text-gray-800 mb-4">
                    Find Your Shop
                </h1>
                <p class="text-xl text-gray-700 max-w-2xl mx-auto leading-relaxed">
                    Discover the finest Black-owned barbershops in your community. Where culture meets craft, and every cut tells a story.
                </p>
            </div>

            {{-- Enhanced Search Form --}}
            <div class="max-w-4xl mx-auto">
                <form action="{{ route('barbershops.search') }}" method="GET" 
                      class="bg-white/90 backdrop-blur-sm p-8 rounded-2xl shadow-2xl border border-white/50">
                    <div class="grid md:grid-cols-3 gap-4 mb-6">
                        <div class="relative">
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Shop Name or Services</label>
                            <input type="text" name="query" 
                                   placeholder="Fade, beard trim, hot towel..."
                                   class="w-full px-4 py-3 rounded-xl border-2 border-gray-200 focus:border-gray-800 focus:outline-none transition-colors"
                                   value="{{ request('query') }}">
                        </div>
                        <div class="relative">
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Location</label>
                            <input type="text" name="location" 
                                   placeholder="Atlanta, GA or 30309"
                                   class="w-full px-4 py-3 rounded-xl border-2 border-gray-200 focus:border-gray-800 focus:outline-none transition-colors"
                                   value="{{ request('location') }}">
                        </div>
                        <div class="flex items-end">
                            <button type="submit" 
                                    class="w-full bg-gray-800 text-white px-8 py-3 rounded-xl font-bold text-lg hover:bg-gray-700 transform hover:scale-105 transition-all duration-200 shadow-lg">
                                Find Shops
                            </button>
                        </div>
                    </div>
                    
                    {{-- Quick Filter Tags --}}
                    <div class="flex flex-wrap gap-2">
                        <span class="text-sm text-gray-600 mr-2">Popular:</span>
                        <button type="button" class="px-4 py-1 bg-gray-100 text-gray-800 rounded-full text-sm hover:bg-gray-200 transition-colors">
                            Fades
                        </button>
                        <button type="button" class="px-4 py-1 bg-gray-100 text-gray-800 rounded-full text-sm hover:bg-gray-200 transition-colors">
                            Beard Care
                        </button>
                        <button type="button" class="px-4 py-1 bg-gray-100 text-gray-800 rounded-full text-sm hover:bg-gray-200 transition-colors">
                            Hot Towel Shave
                        </button>
                        <button type="button" class="px-4 py-1 bg-gray-100 text-gray-800 rounded-full text-sm hover:bg-gray-200 transition-colors">
                            Walk-ins Welcome
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- Results Section --}}
    <div class="bg-gray-50 min-h-screen py-12">
        <div class="container mx-auto px-4">
            @if (isset($barbershops) && is_object($barbershops) && method_exists($barbershops, 'count') && $barbershops->count())
                {{-- Results Header --}}
                <div class="flex justify-between items-center mb-8">
                    <h2 class="text-3xl font-bold text-gray-800">
                        {{ $barbershops->total() }} Shops Found
                    </h2>
                    <div class="flex gap-2">
                        <button class="px-4 py-2 bg-white rounded-lg shadow border text-gray-700 hover:bg-gray-50 transition-colors">
                            <i class="fas fa-sort mr-2"></i>Sort by Rating
                        </button>
                        <button class="px-4 py-2 bg-white rounded-lg shadow border text-gray-700 hover:bg-gray-50 transition-colors">
                            <i class="fas fa-map mr-2"></i>Map View
                        </button>
                    </div>
                </div>

                {{-- Barbershops Grid --}}
                <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-8 mb-12">
                    @foreach ($barbershops as $barbershop)
                    <div class="bg-white rounded-2xl shadow-lg overflow-hidden hover:shadow-2xl transform hover:-translate-y-2 transition-all duration-300 border border-gray-100">
                        {{-- Shop Image --}}
                        <div class="relative h-56 overflow-hidden">
                            @if($barbershop->logo)
                                <img src="{{ asset('storage/' . $barbershop->logo) }}" 
                                     alt="{{ $barbershop->name }}" 
                                     class="w-full h-full object-cover transition-transform duration-300 hover:scale-110">
                            @else
                                <div class="w-full h-full bg-gray-800 flex items-center justify-center">
                                    <div class="text-center text-white">
                                        <i class="fas fa-cut text-4xl mb-2"></i>
                                        <p class="font-semibold">{{ substr($barbershop->name, 0, 1) }}</p>
                                    </div>
                                </div>
                            @endif
                            
                            {{-- Badge for featured shops --}}
                            <div class="absolute top-4 left-4">
                                <span class="bg-gray-800 text-white px-3 py-1 rounded-full text-xs font-bold">
                                    FEATURED
                                </span>
                            </div>
                            
                            {{-- Quick Action Buttons --}}
                            <div class="absolute top-4 right-4 flex gap-2">
                                <button class="w-10 h-10 bg-white/90 rounded-full flex items-center justify-center hover:bg-white transition-colors">
                                    <i class="fas fa-heart text-red-500"></i>
                                </button>
                                <button class="w-10 h-10 bg-white/90 rounded-full flex items-center justify-center hover:bg-white transition-colors">
                                    <i class="fas fa-share text-gray-600"></i>
                                </button>
                            </div>
                        </div>

                        {{-- Shop Details --}}
                        <div class="p-6">
                            {{-- Shop Name & Rating --}}
                            <div class="flex justify-between items-start mb-3">
                                <h3 class="text-xl font-bold text-gray-800 leading-tight">{{ $barbershop->name }}</h3>
                                {{-- Rating Display --}}
                            @if($barbershop->ratings()->count() > 0)
                                <div class="flex">
                                    <div class="flex text-yellow-400 ">
                                        @php $avgRating = $barbershop->ratings()->avg('rating') @endphp
                                        @for ($i = 1; $i <= 5; $i++)
                                            <i class="{{ $i <= round($avgRating) ? 'fas' : 'far' }} fa-star"></i>
                                        @endfor
                                    </div>
                                </div>
                            @endif
                            </div>

                            {{-- Location --}}
                            <div class="flex items-center text-gray-600 mb-3">
                                <i class="fas fa-map-marker-alt text-red-500 mr-2"></i>
                                <span class="font-medium">{{ $barbershop->city }}, {{ $barbershop->state }}</span>
                                <span class="text-sm ml-2 text-gray-500">• 2.3 mi</span>
                            </div>

                            {{-- Services --}}
                            @if (isset($barbershop->services) && is_array($barbershop->services) && count($barbershop->services) > 0)
                                <div class="mb-4">
                                    <div class="flex flex-wrap gap-1">
                                        @foreach(collect($barbershop->services)->take(3) as $service)
                                            <span class="px-2 py-1 bg-gray-100 text-gray-800 rounded-md text-xs font-medium">
                                                {{ $service['name'] ?? $service }}
                                            </span>
                                        @endforeach
                                        @if(count($barbershop->services) > 3)
                                            <span class="px-2 py-1 bg-gray-100 text-gray-600 rounded-md text-xs">
                                                +{{ count($barbershop->services) - 3 }} more
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            @endif

                            {{-- Description --}}
                            <p class="text-gray-600 text-sm mb-4 leading-relaxed">
                                {{ Str::limit($barbershop->description, 80) }}
                            </p>

                            {{-- Action Buttons --}}
                            <div class="flex gap-2">
                                <a href="{{ route('barbershops.show', $barbershop->id) }}" 
                                   class="flex-1 bg-gray-800 text-white text-center px-4 py-2 rounded-lg font-semibold hover:bg-gray-700 transition-all">
                                    View Shop
                                </a>
                                <button class="px-4 py-2 border-2 border-gray-800 text-gray-800 rounded-lg font-semibold hover:bg-gray-50 transition-colors">
                                    Call
                                </button>
                            </div>

                            {{-- Shop Status --}}
                            <div class="flex items-center justify-between mt-3 pt-3 border-t border-gray-100">
                                <div class="flex items-center">
                                    <div class="w-2 h-2 bg-green-500 rounded-full mr-2"></div>
                                    <span class="text-sm text-green-600 font-medium">Open Now</span>
                                </div>
                                <span class="text-sm text-gray-500">Closes 8 PM</span>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>

                {{-- Pagination --}}
                <div class="flex justify-center">
                    <div class="bg-white rounded-xl shadow-lg p-4">
                        {{ $barbershops->links() }}
                    </div>
                </div>

            @else
                {{-- No Results State --}}
                <div class="text-center py-16">
                    <div class="max-w-md mx-auto">
                        <div class="w-24 h-24 bg-gray-800 rounded-full flex items-center justify-center mx-auto mb-6">
                            <i class="fas fa-search text-white text-3xl"></i>
                        </div>
                        <h3 class="text-2xl font-bold text-gray-800 mb-4">No Shops Found</h3>
                        <p class="text-gray-600 mb-6">
                            We couldn't find any barbershops matching your search. Try adjusting your location or search terms.
                        </p>
                        <button class="bg-gray-800 text-white px-6 py-3 rounded-lg font-semibold hover:bg-gray-700 transition-all">
                            Browse All Shops
                        </button>
                    </div>
                </div>
            @endif
        </div>
    </div>

    {{-- Call-to-Action Section --}}
    <div class="bg-gradient-to-r from-gray-900 to-gray-800 py-16">
        <div class="container mx-auto px-4 text-center">
            <h2 class="text-3xl font-bold text-white mb-4">Own a Barbershop?</h2>
            <p class="text-gray-300 mb-8 max-w-2xl mx-auto">
                Join our community of Black-owned barbershops and connect with customers who value quality cuts and cultural experience.
            </p>
            <button class="bg-gray-800 text-white px-8 py-4 rounded-xl font-bold text-lg hover:bg-gray-700 transform hover:scale-105 transition-all duration-200 shadow-lg">
                List Your Shop
            </button>
        </div>
    </div>
@endsection

@push('styles')
<style>
    /* Custom scrollbar for webkit browsers */
    ::-webkit-scrollbar {
        width: 8px;
    }
    
    ::-webkit-scrollbar-track {
        background: #f1f1f1;
        border-radius: 4px;
    }
    
    ::-webkit-scrollbar-thumb {
        background: #374151;
        border-radius: 4px;
    }
    
    ::-webkit-scrollbar-thumb:hover {
        background: #1f2937;
    }

    /* Smooth animations */
    * {
        scroll-behavior: smooth;
    }
    
    /* Custom gradient text animation */
    @keyframes gradient-shift {
        0% { background-position: 0% 50%; }
        50% { background-position: 100% 50%; }
        100% { background-position: 0% 50%; }
    }
    
    .animate-gradient {
        background-size: 200% 200%;
        animation: gradient-shift 3s ease infinite;
    }
</style>
@endpush

@push('scripts')
<script>
    // Quick filter functionality
    document.querySelectorAll('[data-filter]').forEach(button => {
        button.addEventListener('click', function() {
            const filterValue = this.dataset.filter;
            const queryInput = document.querySelector('input[name="query"]');
            queryInput.value = filterValue;
        });
    });

    // Favorite functionality
    document.querySelectorAll('.fas.fa-heart').forEach(heart => {
        heart.addEventListener('click', function(e) {
            e.stopPropagation();
            this.classList.toggle('text-red-500');
            this.classList.toggle('text-gray-400');
        });
    });

    // Add subtle parallax effect to hero section
    window.addEventListener('scroll', function() {
        const scrolled = window.pageYOffset;
        const hero = document.querySelector('.hero-bg');
        if (hero) {
            hero.style.transform = `translateY(${scrolled * 0.5}px)`;
        }
    });
</script>
@endpush