@extends('layouts.dashboard')

@section('dashboard_content')

{{-- Header Section with Welcome Message --}}
<div class="bg-gradient-to-r from-slate-900 to-slate-700 rounded-2xl p-8 mb-8 text-white relative overflow-hidden">
    <div class="absolute inset-0 bg-black opacity-10"></div>
    <div class="relative z-10">
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-4xl font-bold mb-2">Welcome back!</h1>
                <p class="text-slate-200 text-lg">
                    @if(Auth::user()->barbershop)
                        {{ Auth::user()->barbershop->name }}
                    @else
                        Ready to set up your barbershop?
                    @endif
                </p>
            </div>
            <div class="hidden md:block">
                <div class="bg-white bg-opacity-20 rounded-full p-4">
                    <i class="fas fa-cut text-3xl"></i>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Quick Stats Cards --}}
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
    {{-- Today's Bookings --}}
    <div class="bg-white rounded-xl shadow-lg border border-gray-100 p-6 hover:shadow-xl transition-all duration-300 hover:-translate-y-1">
        <div class="flex items-center justify-between mb-4">
            <div class="bg-blue-500 bg-opacity-10 rounded-lg p-3">
                <i class="fas fa-calendar-day text-blue-600 text-xl"></i>
            </div>
            <span class="text-2xl font-bold text-gray-800">12</span>
        </div>
        <h3 class="text-gray-600 font-medium">Today's Bookings</h3>
        <p class="text-sm text-green-600 mt-1">
            <i class="fas fa-arrow-up text-xs"></i> +15% from yesterday
        </p>
    </div>

    {{-- Total Revenue --}}
    <div class="bg-white rounded-xl shadow-lg border border-gray-100 p-6 hover:shadow-xl transition-all duration-300 hover:-translate-y-1">
        <div class="flex items-center justify-between mb-4">
            <div class="bg-green-500 bg-opacity-10 rounded-lg p-3">
                <i class="fas fa-dollar-sign text-green-600 text-xl"></i>
            </div>
            <span class="text-2xl font-bold text-gray-800">$2,450</span>
        </div>
        <h3 class="text-gray-600 font-medium">This Month</h3>
        <p class="text-sm text-green-600 mt-1">
            <i class="fas fa-arrow-up text-xs"></i> +8.2% from last month
        </p>
    </div>

    {{-- Customer Rating --}}
    <div class="bg-white rounded-xl shadow-lg border border-gray-100 p-6 hover:shadow-xl transition-all duration-300 hover:-translate-y-1">
        <div class="flex items-center justify-between mb-4">
            <div class="bg-yellow-500 bg-opacity-10 rounded-lg p-3">
                <i class="fas fa-star text-yellow-600 text-xl"></i>
            </div>
            <span class="text-2xl font-bold text-gray-800">4.8</span>
        </div>
        <h3 class="text-gray-600 font-medium">Average Rating</h3>
        <div class="flex items-center mt-1">
            <div class="flex text-yellow-400 text-sm">
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
            </div>
            <span class="text-xs text-gray-500 ml-2">(127 reviews)</span>
        </div>
    </div>

    {{-- Profile Status --}}
    <div class="bg-white rounded-xl shadow-lg border border-gray-100 p-6 hover:shadow-xl transition-all duration-300 hover:-translate-y-1">
        <div class="flex items-center justify-between mb-4">
            <div class="bg-purple-500 bg-opacity-10 rounded-lg p-3">
                <i class="fas fa-store text-purple-600 text-xl"></i>
            </div>
            @if(Auth::user()->barbershop && Auth::user()->barbershop->is_approved)
                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                    <i class="fas fa-check-circle text-xs mr-1"></i> Active
                </span>
            @else
                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                    <i class="fas fa-clock text-xs mr-1"></i> Pending
                </span>
            @endif
        </div>
        <h3 class="text-gray-600 font-medium">Shop Status</h3>
        <p class="text-sm text-gray-500 mt-1">
            @if(Auth::user()->barbershop && Auth::user()->barbershop->is_approved)
                Your shop is live
            @else
                Setup required
            @endif
        </p>
    </div>
</div>

{{-- Main Content Grid --}}
<div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
    {{-- Left Column - Recent Bookings --}}
    <div class="lg:col-span-2">
        <div class="bg-white rounded-xl shadow-lg border border-gray-100">
            <div class="p-6 border-b border-gray-100">
                <div class="flex items-center justify-between">
                    <h2 class="text-xl font-bold text-gray-800">Recent Bookings</h2>
                    <a href="#" class="text-blue-600 hover:text-blue-700 text-sm font-medium">View All</a>
                </div>
            </div>
            
            <div class="p-6">
                @if (isset($receivedBookings) && $receivedBookings->count())
                    <div class="space-y-4">
                        @foreach ($receivedBookings->take(5) as $booking)
                            <div class="flex items-center justify-between p-4 bg-gray-50 rounded-lg hover:bg-gray-100 transition-colors">
                                <div class="flex items-center space-x-4">
                                    <div class="w-12 h-12 bg-gradient-to-br from-blue-500 to-blue-600 rounded-full flex items-center justify-center text-white font-bold">
                                        {{ substr($booking->user->name, 0, 1) }}
                                    </div>
                                    <div>
                                        <h3 class="font-semibold text-gray-800">{{ $booking->user->name }}</h3>
                                        <p class="text-sm text-gray-600">
                                            {{ $booking->date->format('M d, Y') }} at {{ ucfirst($booking->time_slot) }}
                                        </p>
                                        <p class="text-xs text-gray-500">
                                            @if (is_array($booking->services))
                                                {{ collect($booking->services)->pluck('name')->implode(', ') }}
                                            @else
                                                Services unavailable
                                            @endif
                                        </p>
                                    </div>
                                </div>
                                <div class="text-right">
                                    <p class="font-bold text-gray-800">${{ number_format($booking->total_amount, 2) }}</p>
                                    <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium
                                        @if($booking->status === 'confirmed') bg-green-100 text-green-800
                                        @elseif($booking->status === 'pending') bg-yellow-100 text-yellow-800
                                        @elseif($booking->status === 'completed') bg-blue-100 text-blue-800
                                        @else bg-gray-100 text-gray-800
                                        @endif">
                                        {{ ucfirst($booking->status) }}
                                    </span>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    
                    @if($receivedBookings->count() > 5)
                        <div class="mt-6 text-center">
                            <a href="#" class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-lg text-sm font-medium text-gray-700 bg-white hover:bg-gray-50">
                                Load More Bookings
                                <i class="fas fa-chevron-down ml-2 text-xs"></i>
                            </a>
                        </div>
                    @endif
                @else
                    <div class="text-center py-12">
                        <div class="w-16 h-16 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
                            <i class="fas fa-calendar-alt text-gray-400 text-2xl"></i>
                        </div>
                        <h3 class="text-lg font-medium text-gray-900 mb-2">No bookings yet</h3>
                        <p class="text-gray-500 mb-4">Once customers start booking, they'll appear here.</p>
                        @if (Auth::user()->isBusiness() && !Auth::user()->barbershop)
                            <a href="{{ route('barbershops.create.initial') }}" class="inline-flex items-center px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors">
                                <i class="fas fa-plus mr-2"></i>
                                Complete Shop Setup
                            </a>
                        @endif
                    </div>
                @endif
            </div>
        </div>
    </div>

    {{-- Right Column - Shop Details & Quick Actions --}}
    <div class="space-y-6">
        {{-- Shop Profile Card --}}
        <div class="bg-white rounded-xl shadow-lg border border-gray-100">
            <div class="p-6 border-b border-gray-100">
                <h2 class="text-xl font-bold text-gray-800">Shop Profile</h2>
            </div>
            
            <div class="p-6">
                @if(Auth::user()->barbershop)
                    <div class="space-y-4">
                        <div class="flex items-center space-x-3">
                            <div class="w-12 h-12 bg-gradient-to-br from-slate-600 to-slate-700 rounded-lg flex items-center justify-center text-white">
                                <i class="fas fa-store"></i>
                            </div>
                            <div>
                                <h3 class="font-semibold text-gray-800">{{ Auth::user()->barbershop->name }}</h3>
                                <p class="text-sm text-gray-600">{{ Auth::user()->barbershop->email }}</p>
                            </div>
                        </div>
                        
                        <div class="space-y-2 text-sm">
                            <div class="flex items-center text-gray-600">
                                <i class="fas fa-phone w-4 mr-3"></i>
                                {{ Auth::user()->barbershop->phone ?? 'Not provided' }}
                            </div>
                            <div class="flex items-start text-gray-600">
                                <i class="fas fa-map-marker-alt w-4 mr-3 mt-1"></i>
                                <span>{{ Auth::user()->barbershop->address }}, {{ Auth::user()->barbershop->city }}, {{ Auth::user()->barbershop->state }} {{ Auth::user()->barbershop->zip_code }}</span>
                            </div>
                        </div>
                        
                        <div class="pt-2 border-t border-gray-100">
                            <div class="flex items-center justify-between">
                                <span class="text-sm text-gray-600">Status:</span>
                                @if(Auth::user()->barbershop->is_approved)
                                    <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                        <i class="fas fa-check-circle text-xs mr-1"></i> Approved
                                    </span>
                                @else
                                    <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                                        <i class="fas fa-clock text-xs mr-1"></i> Pending
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>
                @else
                    <div class="text-center py-6">
                        <div class="w-16 h-16 bg-yellow-100 rounded-full flex items-center justify-center mx-auto mb-4">
                            <i class="fas fa-exclamation-triangle text-yellow-600 text-2xl"></i>
                        </div>
                        <h3 class="text-lg font-medium text-gray-900 mb-2">Setup Required</h3>
                        <p class="text-gray-500 text-sm mb-4">Complete your barbershop profile to start receiving bookings and managing your business.</p>
                        <a href="{{ route('barbershops.create.initial') }}" class="inline-flex items-center px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors">
                            <i class="fas fa-plus mr-2"></i>
                            Setup Shop
                        </a>
                    </div>
                @endif
            </div>
        </div>

        {{-- Quick Actions --}}
        <div class="bg-white rounded-xl shadow-lg border border-gray-100">
            <div class="p-6 border-b border-gray-100">
                <h2 class="text-xl font-bold text-gray-800">Quick Actions</h2>
            </div>
            
            <div class="p-6">
                <div class="space-y-3">
                    <a href="{{ route('barbershop.analytics.index') }}" class="flex items-center justify-between p-3 rounded-lg hover:bg-gray-50 transition-colors group">
                        <div class="flex items-center space-x-3">
                            <div class="w-8 h-8 bg-blue-100 rounded-lg flex items-center justify-center group-hover:bg-blue-200 transition-colors">
                                <i class="fas fa-chart-line text-blue-600 text-sm"></i>
                            </div>
                            <span class="font-medium text-gray-700">View Analytics</span>
                        </div>
                        <i class="fas fa-chevron-right text-gray-400 text-sm"></i>
                    </a>
                    
                    <a href="#" class="flex items-center justify-between p-3 rounded-lg hover:bg-gray-50 transition-colors group">
                        <div class="flex items-center space-x-3">
                            <div class="w-8 h-8 bg-green-100 rounded-lg flex items-center justify-center group-hover:bg-green-200 transition-colors">
                                <i class="fas fa-cog text-green-600 text-sm"></i>
                            </div>
                            <span class="font-medium text-gray-700">Shop Settings</span>
                        </div>
                        <i class="fas fa-chevron-right text-gray-400 text-sm"></i>
                    </a>
                    
                    <a href="#" class="flex items-center justify-between p-3 rounded-lg hover:bg-gray-50 transition-colors group">
                        <div class="flex items-center space-x-3">
                            <div class="w-8 h-8 bg-purple-100 rounded-lg flex items-center justify-center group-hover:bg-purple-200 transition-colors">
                                <i class="fas fa-users text-purple-600 text-sm"></i>
                            </div>
                            <span class="font-medium text-gray-700">Manage Staff</span>
                        </div>
                        <i class="fas fa-chevron-right text-gray-400 text-sm"></i>
                    </a>
                    
                    <a href="#" class="flex items-center justify-between p-3 rounded-lg hover:bg-gray-50 transition-colors group">
                        <div class="flex items-center space-x-3">
                            <div class="w-8 h-8 bg-orange-100 rounded-lg flex items-center justify-center group-hover:bg-orange-200 transition-colors">
                                <i class="fas fa-scissors text-orange-600 text-sm"></i>
                            </div>
                            <span class="font-medium text-gray-700">Services & Pricing</span>
                        </div>
                        <i class="fas fa-chevron-right text-gray-400 text-sm"></i>
                    </a>
                </div>
            </div>
        </div>

        {{-- Performance Insights --}}
        <div class="bg-gradient-to-br from-indigo-50 to-purple-50 rounded-xl border border-indigo-100 p-6">
            <div class="flex items-center mb-4">
                <div class="w-10 h-10 bg-indigo-500 rounded-lg flex items-center justify-center text-white mr-3">
                    <i class="fas fa-lightbulb"></i>
                </div>
                <h3 class="text-lg font-bold text-gray-800">Pro Tip</h3>
            </div>
            <p class="text-gray-700 text-sm mb-3">Upload high-quality photos of your work to attract more customers. Shops with photos get 3x more bookings!</p>
            <a href="#" class="inline-flex items-center text-indigo-600 hover:text-indigo-700 font-medium text-sm">
                Manage Gallery
                <i class="fas fa-arrow-right ml-2 text-xs"></i>
            </a>
        </div>
    </div>
</div>

@endsection