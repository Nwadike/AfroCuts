@extends('user.layouts.main')

@section('dashboard_content')
<div class="space-y-8">
    {{-- Welcome Section --}}
    <div class="bg-white/95 backdrop-blur-sm rounded-2xl shadow-xl p-8 border border-white/20">
        <div class="flex flex-col md:flex-row md:items-center md:justify-between">
            <div class="mb-6 md:mb-0">
                <h1 class="text-3xl md:text-4xl font-bold text-gray-800 mb-2">
                    Welcome back, <span class="text-transparent bg-clip-text bg-gradient-to-r from-purple-600 to-pink-600">{{ Auth::user()->name }}!</span>
                </h1>
                <p class="text-gray-600 text-lg">Ready to find your next perfect haircut?</p>
            </div>
            <div class="flex items-center space-x-4">
                <div class="text-center">
                    <div class="text-3xl font-bold text-purple-600">{{ date('d') }}</div>
                    <div class="text-sm text-gray-500">{{ date('M Y') }}</div>
                </div>
                <div class="w-16 h-16 rounded-full bg-gradient-to-br from-purple-500 to-pink-500 flex items-center justify-center text-white text-2xl font-bold shadow-lg">
                    {{ substr(Auth::user()->name, 0, 1) }}
                </div>
            </div>
        </div>
    </div>

    {{-- Quick Stats Cards --}}
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        {{-- Total Bookings --}}
        <div class="bg-white/95 backdrop-blur-sm rounded-xl shadow-lg p-6 border border-white/20 hover:shadow-xl transition-all duration-300 hover:scale-105">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-600">Total Bookings</p>
                    <p class="text-3xl font-bold text-gray-800">{{ $totalBookings }}</p>
                </div>
                <div class="w-12 h-12 bg-gradient-to-br from-blue-500 to-blue-600 rounded-lg flex items-center justify-center">
                    <i class="fas fa-calendar-check text-white text-xl"></i>
                </div>
            </div>
        </div>

        {{-- Favorite Shops --}}
        <div class="bg-white/95 backdrop-blur-sm rounded-xl shadow-lg p-6 border border-white/20 hover:shadow-xl transition-all duration-300 hover:scale-105">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-600">Favorite Shops</p>
                    <p class="text-3xl font-bold text-gray-800">{{ $totalFavorites }}</p>
                </div>
                <div class="w-12 h-12 bg-gradient-to-br from-red-500 to-pink-600 rounded-lg flex items-center justify-center">
                    <i class="fas fa-heart text-white text-xl"></i>
                </div>
            </div>

        </div>

        {{-- Reviews Given --}}
        <div class="bg-white/95 backdrop-blur-sm rounded-xl shadow-lg p-6 border border-white/20 hover:shadow-xl transition-all duration-300 hover:scale-105">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-600">Reviews Given</p>
                    <p class="text-3xl font-bold text-gray-800">{{ $totalFavorites }}</p>
                </div>
                <div class="w-12 h-12 bg-gradient-to-br from-yellow-500 to-orange-600 rounded-lg flex items-center justify-center">
                    <i class="fas fa-star text-white text-xl"></i>
                </div>
            </div>
            <div class="mt-4 flex items-center text-sm">
                <span class="text-yellow-500 font-medium">0★</span>
                <span class="text-gray-500 ml-2">average rating</span>
            </div>
        </div>

 
    </div>

    {{-- Quick Actions --}}
    <div class="bg-white/95 backdrop-blur-sm rounded-2xl shadow-xl p-8 border border-white/20">
        <h2 class="text-2xl font-bold text-gray-800 mb-6">Quick Actions</h2>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <a href="#" class="group bg-gradient-to-br from-purple-500 to-purple-600 rounded-xl p-6 text-white hover:shadow-lg transition-all duration-300 hover:scale-105">
                <div class="flex items-center justify-between mb-4">
                    <i class="fas fa-search text-3xl"></i>
                    <i class="fas fa-arrow-right group-hover:translate-x-1 transition-transform"></i>
                </div>
                <h3 class="text-xl font-semibold mb-2">Find Barbershops</h3>
                <p class="text-purple-100">Discover top-rated black barbershops near you</p>
            </a>

            <a href="#" class="group bg-gradient-to-br from-blue-500 to-blue-600 rounded-xl p-6 text-white hover:shadow-lg transition-all duration-300 hover:scale-105">
                <div class="flex items-center justify-between mb-4">
                    <i class="fas fa-calendar-plus text-3xl"></i>
                    <i class="fas fa-arrow-right group-hover:translate-x-1 transition-transform"></i>
                </div>
                <h3 class="text-xl font-semibold mb-2">Book Appointment</h3>
                <p class="text-blue-100">Schedule your next haircut instantly</p>
            </a>

            <a href="#" class="group bg-gradient-to-br from-emerald-500 to-emerald-600 rounded-xl p-6 text-white hover:shadow-lg transition-all duration-300 hover:scale-105">
                <div class="flex items-center justify-between mb-4">
                    <i class="fas fa-gift text-3xl"></i>
                    <i class="fas fa-arrow-right group-hover:translate-x-1 transition-transform"></i>
                </div>
                <h3 class="text-xl font-semibold mb-2">View Offers</h3>
                <p class="text-emerald-100">Check out exclusive deals and discounts</p>
            </a>
        </div>
    </div>


    {{-- Recent Bookings --}}
    <div class="bg-white/95 backdrop-blur-sm rounded-2xl shadow-xl p-8 border border-white/20">
        <div class="flex items-center justify-between mb-6">
            <h2 class="text-2xl font-bold text-gray-800">Recent Bookings</h2>
            <a href="#" class="text-purple-600 hover:text-purple-800 font-medium flex items-center">
                View All <i class="fas fa-arrow-right ml-2"></i>
            </a>
        </div>




@if ($recentBookings->isEmpty())

        <div class="">
            {{-- Sample Recommended Barbershops --}}
            <div class="text-center py-12">
                <div class="w-24 h-24 bg-gradient-to-br from-purple-100 to-pink-100 rounded-full flex items-center justify-center mx-auto mb-6">
                    <i class="fas fa-calendar-alt text-4xl text-purple-500"></i>
                </div>
                <h3 class="text-xl font-semibold text-gray-800 mb-2">No bookings yet</h3>
                <p class="text-gray-600 mb-6">Start your grooming journey by booking your first appointment!</p>
                <a href="#" class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-purple-600 to-pink-600 text-white font-semibold rounded-lg hover:shadow-lg transition-all duration-300 hover:scale-105">
                    <i class="fas fa-search mr-2"></i>
                    Find Barbershops
                </a>
            </div>
            </div>
@else
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            {{-- Sample Recommended Barbershops --}}
            <div class="bg-gradient-to-br from-white to-gray-50 rounded-xl p-6 border border-gray-200/50 hover:shadow-lg transition-all duration-300 hover:scale-105">
                <div class="flex items-center justify-between mb-4">
                    <div class="w-12 h-12 bg-gradient-to-br from-blue-500 to-purple-500 rounded-lg flex items-center justify-center text-white font-bold text-lg shadow-md">
                        K
                    </div>
                    <div class="flex items-center text-yellow-500">
                        <i class="fas fa-star"></i>
                        <span class="ml-1 text-sm font-semibold text-gray-700">4.8</span>
                    </div>
                </div>
                <h3 class="text-lg font-semibold text-gray-800 mb-2">{{ $booking->barbershop->name ?? 'N/A' }}</h3>
                <p class="text-gray-600 text-sm mb-4">{{ $booking->service->name ?? 'N/A' }}</p>
                <div class="flex items-center justify-between text-sm text-gray-500 mb-4">
                    <span class="flex items-center">
                        <i class="fas fa-map-marker-alt mr-1"></i>
                        2.3 km away
                    </span>
                    <span class="flex items-center">
                        <i class="fas fa-clock mr-1"></i>
                        {{ $booking->service->name ?? 'N/A' }}
                    </span>
                </div>
                <button class="w-full bg-gradient-to-r from-purple-600 to-pink-600 text-white py-2 rounded-lg font-semibold hover:shadow-md transition-all duration-300">
                    View Appointment
                </button>
            </div>

        </div>
@endif
    </div>




    {{-- Special Offers & Promotions --}}
    <div class="bg-gradient-to-r from-amber-400 via-orange-500 to-red-500 rounded-2xl shadow-xl p-8 text-white relative overflow-hidden">
        {{-- Background Pattern --}}
        <div class="absolute inset-0 opacity-10">
            <div class="absolute transform rotate-45 -top-10 -right-10 w-40 h-40 bg-white rounded-full"></div>
            <div class="absolute transform -rotate-12 -bottom-10 -left-10 w-32 h-32 bg-white rounded-full"></div>
        </div>
        
        <div class="relative z-10">
            <div class="flex flex-col md:flex-row md:items-center md:justify-between">
                <div class="mb-6 md:mb-0">
                    <h2 class="text-3xl font-bold mb-2">Special Offers</h2>
                    <p class="text-white/90 text-lg">Save big on your next appointment!</p>
                </div>
                <div class="text-right">
                    <div class="text-4xl font-bold mb-1">20% OFF</div>
                    <div class="text-white/90">Weekend booking</div>
                </div>
            </div>
            
            <div class="mt-8 grid grid-cols-1 md:grid-cols-1 gap-6">
                <div class="bg-white/20 backdrop-blur-sm rounded-xl p-6">
                    <div class="flex items-center mb-3">
                        <i class="fas fa-percentage text-2xl mr-3"></i>
                        <h3 class="text-xl font-semibold">Weekend Special</h3>
                    </div>
                    <p class="text-white/90 mb-4">Get 20% off on all weekend bookings. Valid until this month end.</p>
                    <button class="bg-white text-orange-600 px-4 py-2 rounded-lg font-semibold hover:bg-gray-100 transition-colors">
                        Claim Offer
                    </button>
                </div>
                
            
            </div>
        </div>
    </div>

    <!-- RECENT ACTIVITIES  

    <h3>Recent Activity</h3>

<h4>Recent Bookings</h4>
<ul>
@foreach ($recentBookings as $booking)
    <li>{{ $booking->barbershop->name }} on {{ $booking->created_at->format('M d, Y') }}</li>
@endforeach
</ul>

<h4>Recent Reviews</h4>
<ul>
@foreach ($recentRatings as $review)
    <li>{{ $review->barbershop->name }}: {{ $review->stars }} stars</li>
@endforeach
</ul>

<h4>Recent Favorites</h4>
<ul>
@foreach ($recentFavorites as $shop)
    <li>{{ $shop->name }}</li>
@endforeach
</ul>

<h3>Stats</h3>
<ul>
    <li>Total Bookings: {{ $totalBookings }}</li>
    <li>Total Reviews: {{ $totalRatings }}</li>
    <li>Total Favorites: {{ $totalFavorites }}</li>
</ul>

-->

    {{-- Recent Activity Feed --}}
    <div class="bg-white/95 backdrop-blur-sm rounded-2xl shadow-xl p-8 border border-white/20">
        <h2 class="text-2xl font-bold text-gray-800 mb-6">Recent Activity</h2>
        
        <div class="space-y-4">
            <div class="flex items-start space-x-4 p-4 bg-gray-50/50 rounded-xl">
                <div class="w-10 h-10 bg-gradient-to-br from-green-500 to-emerald-500 rounded-full flex items-center justify-center flex-shrink-0">
                    <i class="fas fa-check text-white"></i>
                </div>
                <div class="flex-1">
                    <p class="text-gray-800 font-medium">Booking confirmed at King's Barber Shop</p>
                    <p class="text-gray-500 text-sm">Your appointment for tomorrow at 4:00 PM has been confirmed</p>
                    <p class="text-gray-400 text-xs mt-1">2 hours ago</p>
                </div>
            </div>
            
            <div class="flex items-start space-x-4 p-4 bg-gray-50/50 rounded-xl">
                <div class="w-10 h-10 bg-gradient-to-br from-blue-500 to-purple-500 rounded-full flex items-center justify-center flex-shrink-0">
                    <i class="fas fa-star text-white"></i>
                </div>
                <div class="flex-1">
                    <p class="text-gray-800 font-medium">Review submitted for Fresh Cuts Studio</p>
                    <p class="text-gray-500 text-sm">You rated your experience 5 stars</p>
                    <p class="text-gray-400 text-xs mt-1">1 day ago</p>
                </div>
            </div>
            
            <div class="flex items-start space-x-4 p-4 bg-gray-50/50 rounded-xl">
                <div class="w-10 h-10 bg-gradient-to-br from-amber-500 to-orange-500 rounded-full flex items-center justify-center flex-shrink-0">
                    <i class="fas fa-heart text-white"></i>
                </div>
                <div class="flex-1">
                    <p class="text-gray-800 font-medium">Added Afro Elite Cuts to favorites</p>
                    <p class="text-gray-500 text-sm">Now you can quickly book your favorite barbershop</p>
                    <p class="text-gray-400 text-xs mt-1">3 days ago</p>
                </div>
            </div>
        </div>
        
        <div class="text-center mt-6">
            <button class="text-purple-600 hover:text-purple-800 font-medium">
                View All Activity
            </button>
        </div>
    </div>
</div>

@push('scripts')
<script>
    // Add any custom JavaScript for interactions
    document.addEventListener('DOMContentLoaded', function() {
        // Animate stat cards on load
        const statCards = document.querySelectorAll('.hover\\:scale-105');
        statCards.forEach((card, index) => {
            setTimeout(() => {
                card.style.opacity = '0';
                card.style.transform = 'translateY(20px)';
                card.style.transition = 'all 0.6s ease';
                setTimeout(() => {
                    card.style.opacity = '1';
                    card.style.transform = 'translateY(0)';
                }, 100);
            }, index * 100);
        });
    });
</script>
@endpush

@endsection
            </a>
        </div>

        @if (isset($bookings) && $bookings->count())
            <div class="space-y-4">
                @foreach ($bookings->take(3) as $booking)
                    <div class="bg-gradient-to-r from-gray-50 to-gray-100/50 rounded-xl p-6 border border-gray-200/50 hover:shadow-md transition-all duration-300">
                        <div class="flex flex-col md:flex-row md:items-center md:justify-between">
                            <div class="flex items-start space-x-4 mb-4 md:mb-0">
                                {{-- Shop Avatar --}}
                                <div class="w-12 h-12 bg-gradient-to-br from-purple-500 to-pink-500 rounded-lg flex items-center justify-center text-white font-bold text-lg shadow-md">
                                    {{ substr($booking->barbershop->name, 0, 1) }}
                                </div>
                                
                                <div class="flex-1">
                                    <h3 class="text-lg font-semibold text-gray-800 mb-1">{{ $booking->barbershop->name }}</h3>
                                    <div class="flex flex-wrap items-center gap-4 text-sm text-gray-600">
                                        <span class="flex items-center">
                                            <i class="fas fa-calendar mr-2 text-purple-500"></i>
                                            {{ $booking->date->format('M d, Y') }}
                                        </span>
                                        <span class="flex items-center">
                                            <i class="fas fa-clock mr-2 text-blue-500"></i>
                                            {{ ucfirst($booking->time_slot) }}
                                        </span>
                                        <span class="flex items-center">
                                            <i class="fas fa-dollar-sign mr-2 text-green-500"></i>
                                            ${{ number_format($booking->total_amount, 2) }}
                                        </span>
                                    </div>
                                    
                                    {{-- Services --}}
                                    <div class="mt-2 flex flex-wrap gap-2">
                                        @if (is_array($booking->services))
                                            @foreach ($booking->services as $service)
                                                <span class="px-3 py-1 bg-purple-100 text-purple-700 rounded-full text-xs font-medium">
                                                    {{ $service['name'] }}
                                                </span>
                                            @endforeach
                                        @endif
                                    </div>
                                </div>
                            </div>
                            
                            <div class="flex items-center space-x-3">
                                {{-- Status Badge --}}
                                <span class="px-3 py-1 rounded-full text-xs font-semibold
                                    @if($booking->status === 'confirmed') bg-green-100 text-green-800
                                    @elseif($booking->status === 'pending') bg-yellow-100 text-yellow-800
                                    @elseif($booking->status === 'completed') bg-blue-100 text-blue-800
                                    @else bg-gray-100 text-gray-800 @endif">
                                    {{ ucfirst($booking->status) }}
                                </span>
                                
                                {{-- Action Buttons --}}
                                <div class="flex space-x-2">
                                    <button class="p-2 text-gray-400 hover:text-purple-600 transition-colors">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <button class="p-2 text-gray-400 hover:text-red-600 transition-colors">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            {{-- Pagination --}}
            @if($bookings->hasPages())
                <div class="mt-8 flex justify-center">
                    {{ $bookings->links() }}
                </div>
            @endif
        @else
        
        @endif
    </div>

  
    