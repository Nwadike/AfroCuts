@extends('layouts.app')

@section('content')

    @include('partials.header')

    <div class="min-h-screen ">
        {{-- Hero Section with Barbershop Image --}}
        <div class="relative h-96 bg-gradient-to-r from-gray-900 to-gray-700 overflow-hidden">
            @if($barbershop->image)
                <img src="{{ asset('storage/' . $barbershop->image) }}" alt="{{ $barbershop->name }}"
                     class="absolute inset-0 w-full h-full object-cover opacity-60">
            @endif
            <div class="absolute inset-0 bg-black bg-opacity-40"></div>
            
            <div class="relative z-10 container mx-auto px-4 h-full flex flex-col justify-center">
                {{-- Back Button --}}
                <div class="mb-6">
                    <a href="{{ route('barbershops.index') }}" 
                       class="inline-flex items-center text-white hover:text-yellow-400 transition-colors">
                        <i class="fas fa-arrow-left mr-2"></i>
                        <span class="font-medium">Back to Directory</span>
                    </a>
                </div>
                
                {{-- Barbershop Title --}}
                <div class="text-white">
                    <h1 class="text-5xl font-bold mb-2">{{ $barbershop->name }}</h1>
                    <div class="flex items-center text-xl text-gray-200">
                        <i class="fas fa-map-marker-alt mr-2"></i>
                        <span>{{ $barbershop->city }}, {{ $barbershop->state }}</span>
                    </div>
                    
                    {{-- Rating Display --}}
                    @if($barbershop->ratings()->count() > 0)
                        <div class="flex items-center mt-3">
                            <div class="flex text-yellow-400 mr-2">
                                @php $avgRating = $barbershop->ratings()->avg('rating') @endphp
                                @for ($i = 1; $i <= 5; $i++)
                                    <i class="{{ $i <= round($avgRating) ? 'fas' : 'far' }} fa-star"></i>
                                @endfor
                            </div>
                            <span class="text-white">{{ number_format($avgRating, 1) }} ({{ $barbershop->ratings()->count() }} reviews)</span>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        {{-- Main Content --}}
        <div class="container mx-auto px-4 py-8">
            {{-- Quick Actions Bar --}}
            <div class="bg-white bg-white/95 backdrop-blur-sm rounded-2xl shadow-xl p-8 border border-white/20 rounded-lg shadow-sm p-6 mb-8">
                <div class="flex flex-col md:flex-row gap-4 items-center justify-between">
                    <div class="flex-1">
                        <h2 class="text-2xl font-bold text-gray-900 mb-1">Ready for a fresh cut?</h2>
                        <p class="text-gray-600">Book your appointment at {{ $barbershop->name }} today</p>
                    </div>
                    <div class="flex gap-3">
                        @if($barbershop->phone)
                            <a href="tel:{{ $barbershop->phone }}" 
                               class="bg-green-600 text-white px-6 py-3 rounded-lg font-semibold hover:bg-green-700 transition-colors flex items-center">
                                <i class="fas fa-phone mr-2"></i>
                                Call Now
                            </a>
                        @endif
                        <a href="{{ route('bookings.create', $barbershop->id) }}"
                           class="bg-yellow-500 text-black px-6 py-3 rounded-lg font-semibold hover:bg-yellow-600 transition-colors flex items-center">
                            <i class="fas fa-calendar-alt mr-2"></i>
                            Book Online
                        </a>
                    </div>
                </div>
            </div>

            {{-- Main Grid Layout --}}
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                
                {{-- Left Column - Main Content --}}
                <div class="lg:col-span-2 space-y-8">
                    
                    {{-- About Section --}}
                    <div class="bg-white rounded-lg shadow-sm p-6 ">
                        <h3 class="text-2xl font-bold text-gray-900 mb-4">About {{ $barbershop->name }}</h3>
                        <p class="text-gray-700 leading-relaxed">
                            {{ $barbershop->description ?? 'Experience premium barbering services in a welcoming atmosphere. Our skilled barbers are dedicated to providing exceptional cuts and grooming services.' }}
                        </p>
                    </div>

                    {{-- Services Section --}}
                    <div class="bg-white rounded-lg shadow-sm p-6">
                        <h3 class="text-2xl font-bold text-gray-900 mb-4">Our Services</h3>
                        @if(is_array($barbershop->services) && count($barbershop->services) > 0)
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                                @foreach($barbershop->services as $service)
                                    <div class="bg-gray-50 p-4 rounded-lg border-l-4 border-yellow-500">
                                        <div class="flex items-center">
                                            <i class="fas fa-cut text-yellow-500 mr-3"></i>
                                            <span class="font-medium text-gray-900">
                                                {{ is_array($service) ? $service['name'] : $service }}
                                            </span>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <p class="text-gray-600">Contact us to learn about our full range of services.</p>
                        @endif
                    </div>

                    {{-- Gallery Section --}}
                    @if($barbershop->logo)
                        <div class="bg-white rounded-lg shadow-sm p-6">
                            <h3 class="text-2xl font-bold text-gray-900 mb-4">Gallery</h3>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <img src="{{ asset('storage/' . $barbershop->logo) }}" 
                                     alt="{{ $barbershop->name }}" 
                                     class="w-full h-48 object-cover rounded-lg">
                                {{-- Placeholder for additional images --}}
                                <div class="w-full h-48 bg-gray-100 rounded-lg flex items-center justify-center text-gray-400">
                                    <i class="fas fa-camera text-4xl"></i>
                                </div>
                            </div>
                        </div>
                    @endif

                    {{-- Reviews Section --}}
                    <div class="bg-white rounded-lg shadow-sm p-6">
                        <h3 class="text-2xl font-bold text-gray-900 mb-6">Customer Reviews</h3>
                        
                        {{-- Write Review (if authenticated) --}}
                        @if(Auth::check() && Auth::user()->account_type !== 'barbershop')
                            <div class="bg-yellow-50 border border-yellow-200 rounded-lg p-4 mb-6">
                                <h4 class="font-semibold text-gray-900 mb-3">Share Your Experience</h4>
                                <form action="{{ route('barbershop.rate', $barbershop->id) }}" method="POST">
                                    @csrf
                                    <div class="mb-4">
                                        <div class="flex items-center space-x-1 mb-2">
                                            @for ($i = 1; $i <= 5; $i++)
                                                <i class="fa-regular fa-star fa-lg star cursor-pointer hover:text-yellow-500 transition-colors" 
                                                   data-value="{{ $i }}"></i>
                                            @endfor
                                        </div>
                                        <input type="hidden" name="rating" id="rating-value" required>
                                    </div>
                                    <textarea name="comment" 
                                              class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-yellow-500 focus:border-transparent" 
                                              placeholder="Tell others about your experience..." 
                                              rows="3"></textarea>
                                    <button type="submit" 
                                            class="mt-3 bg-yellow-500 text-black px-4 py-2 rounded-lg font-semibold hover:bg-yellow-600 transition-colors">
                                        Submit Review
                                    </button>
                                </form>
                            </div>
                        @endif

                        {{-- Review List --}}
                        <div class="space-y-4">
                            @forelse ($barbershop->ratings()->latest()->limit(5)->get() as $rating)
                                <div class="border-b border-gray-200 pb-4">
                                    <div class="flex items-center justify-between mb-2">
                                        <div class="flex items-center">
                                            <div class="w-10 h-10 bg-yellow-500 rounded-full flex items-center justify-center text-white font-bold mr-3">
                                                {{ substr($rating->user->name, 0, 1) }}
                                            </div>
                                            <div>
                                                <h5 class="font-semibold text-gray-900">{{ $rating->user->name }}</h5>
                                                <div class="flex text-yellow-500 text-sm">
                                                    @for ($i = 1; $i <= 5; $i++)
                                                        <i class="{{ $i <= $rating->rating ? 'fas' : 'far' }} fa-star"></i>
                                                    @endfor
                                                </div>
                                            </div>
                                        </div>
                                        <small class="text-gray-500">{{ $rating->created_at->diffForHumans() }}</small>
                                    </div>
                                    @if ($rating->comment)
                                        <p class="text-gray-700 ml-13">{{ $rating->comment }}</p>
                                    @endif
                                </div>
                            @empty
                                <div class="text-center py-8">
                                    <i class="fas fa-comments text-4xl text-gray-300 mb-3"></i>
                                    <p class="text-gray-600">No reviews yet. Be the first to share your experience!</p>
                                </div>
                            @endforelse
                        </div>
                    </div>
                </div>

                {{-- Right Column - Sidebar --}}
                <div class="space-y-6">
                    
                    {{-- Contact Information --}}
                    <div class="bg-white rounded-lg shadow-sm p-6">
                        <h3 class="text-xl font-bold text-gray-900 mb-4">Contact Information</h3>
                        <div class="space-y-3">
                            @if($barbershop->phone)
                                <div class="flex items-center">
                                    <i class="fas fa-phone w-5 text-gray-500 mr-3"></i>
                                    <a href="tel:{{ $barbershop->phone }}" class="text-gray-700 hover:text-yellow-600">
                                        {{ $barbershop->phone }}
                                    </a>
                                </div>
                            @endif
                            
                            @if($barbershop->email)
                                <div class="flex items-center">
                                    <i class="fas fa-envelope w-5 text-gray-500 mr-3"></i>
                                    <a href="mailto:{{ $barbershop->email }}" class="text-gray-700 hover:text-yellow-600">
                                        {{ $barbershop->email }}
                                    </a>
                                </div>
                            @endif
                            
                            @if($barbershop->address)
                                <div class="flex items-start">
                                    <i class="fas fa-map-marker-alt w-5 text-gray-500 mr-3 mt-1"></i>
                                    <span class="text-gray-700">{{ $barbershop->address }}</span>
                                </div>
                            @endif
                            
                            @if($barbershop->website)
                                <div class="flex items-center">
                                    <i class="fas fa-globe w-5 text-gray-500 mr-3"></i>
                                    <a href="{{ $barbershop->website }}" target="_blank" 
                                       class="text-gray-700 hover:text-yellow-600">
                                        Visit Website
                                    </a>
                                </div>
                            @endif
                        </div>
                        
                        {{-- Social Media --}}
                        @if($barbershop->instagram || $barbershop->facebook)
                            <div class="mt-6 pt-4 border-t border-gray-200">
                                <h4 class="font-semibold text-gray-900 mb-3">Follow Us</h4>
                                <div class="flex space-x-3">
                                    @if($barbershop->instagram)
                                        <a href="https://www.instagram.com/{{ $barbershop->instagram }}" target="_blank"
                                           class="w-10 h-10 bg-gradient-to-r from-purple-500 to-pink-500 rounded-lg flex items-center justify-center text-white hover:opacity-80 transition-opacity">
                                            <i class="fab fa-instagram"></i>
                                        </a>
                                    @endif
                                    
                                    @if($barbershop->facebook)
                                        <a href="https://www.facebook.com/{{ $barbershop->facebook }}" target="_blank"
                                           class="w-10 h-10 bg-blue-600 rounded-lg flex items-center justify-center text-white hover:opacity-80 transition-opacity">
                                            <i class="fab fa-facebook-f"></i>
                                        </a>
                                    @endif
                                </div>
                            </div>
                        @endif
                    </div>

                    {{-- Operating Hours --}}
                    <div class="bg-white rounded-lg shadow-sm p-6">
                        <h3 class="text-xl font-bold text-gray-900 mb-4">Hours of Operation</h3>
                        @if($barbershop->working_hours)
                            <div class="space-y-2">
                                @foreach($barbershop->working_hours as $day => $hours)
                                    <div class="flex justify-between">
                                        <span class="font-medium text-gray-700">{{ ucfirst($day) }}</span>
                                        <span class="text-gray-600">{{ $hours }}</span>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <p class="text-gray-600">Contact us for current hours.</p>
                        @endif
                    </div>

                    {{-- Map --}}
                    <div class="bg-white rounded-lg shadow-sm p-6">
                        <h3 class="text-xl font-bold text-gray-900 mb-4">Location</h3>
                        @if($barbershop->latitude && $barbershop->longitude)
                            <iframe
                                width="100%" height="200" class="rounded-lg"
                                frameborder="0" style="border:0"
                                src="https://www.google.com/maps/embed/v1/view?key=YOUR_GOOGLE_MAPS_API_KEY&center={{ $barbershop->latitude }},{{ $barbershop->longitude }}&zoom=15"
                                allowfullscreen>
                            </iframe>
                        @else
                            <div class="bg-gray-100 h-48 rounded-lg flex items-center justify-center text-gray-500">
                                <div class="text-center">
                                    <i class="fas fa-map text-3xl mb-2"></i>
                                    <p>Map coming soon</p>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        .star {
            transition: all 0.2s ease;
        }
        .star:hover {
            transform: scale(1.1);
        }
    </style>

    <script>
        const stars = document.querySelectorAll('.star');
        const ratingInput = document.getElementById('rating-value');

        stars.forEach((star, index) => {
            star.addEventListener('click', () => {
                const value = star.dataset.value;
                ratingInput.value = value;

                stars.forEach((s, i) => {
                    s.classList.remove('fas', 'far', 'text-yellow-500');
                    if (i < value) {
                        s.classList.add('fas', 'text-yellow-500');
                    } else {
                        s.classList.add('far');
                    }
                });
            });

            star.addEventListener('mouseenter', () => {
                const value = star.dataset.value;
                stars.forEach((s, i) => {
                    s.classList.remove('text-yellow-500', 'text-gray-400');
                    if (i < value) {
                        s.classList.add('text-yellow-500');
                    } else {
                        s.classList.add('text-gray-400');
                    }
                });
            });
        });

        // Reset on mouse leave
        document.querySelector('.star').closest('div').addEventListener('mouseleave', () => {
            const currentRating = ratingInput.value;
            stars.forEach((s, i) => {
                s.classList.remove('text-yellow-500', 'text-gray-400');
                if (currentRating && i < currentRating) {
                    s.classList.add('text-yellow-500');
                }
            });
        });
    </script>

@endsection