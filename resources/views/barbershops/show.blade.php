@extends('layouts.app')

@section('content')

    @include('partials.header')

    <style>
    .rating-stars .star {
    transition: transform 0.2s, color 0.2s;
    }
    .rating-stars .star:hover {
        transform: scale(1.2);
    }

    </style>

    <div class="container mx-auto px-4 py-8 pt-24 relative overflow-hidden">

    {{-- Back to List Button (Moved to Top) --}}
            <div class="mb-8"> {{-- Added margin bottom --}}
                <a href="{{ route('barbershops.index') }}" class="inline-block bg-gray-300 text-gray-800 px-4 py-2 rounded-lg font-medium hover:bg-gray-400 transition">
                    <i class="fas fa-arrow-left mr-2"></i> Back to List
                </a>
        </div>

        {{-- Background Overlay --}}
        <div class="absolute inset-0 z-0 opacity-10"
             style="
                background-image: url('https://img.freepik.com/premium-vector/hairdressing-barbershop-tools-seamless-pattern-beauty-salon_341076-314.jpg?w=900');
                background-size: 200px auto;
                background-repeat: repeat;
                background-position: center;
                pointer-events: none;
                filter: blur(0px);
            "></div>

        <div class="relative z-10 max-w-7xl mx-auto space-y-10">

         {{-- Main Image / Gallery Section --}}
            <div class="mb-8 rounded-lg overflow-hidden shadow-sm">
                 {{-- Display main logo or a gallery if you have multiple images --}}
                @if($barbershop->logo)
                    <img src="{{ asset('storage/' . $barbershop->logo) }}" alt="{{ $barbershop->name }}" class="w-full h-96 object-cover"> {{-- Increased image height --}}
                @else
                    <div class="w-full h-96 bg-gray-200 flex items-center justify-center text-gray-400 text-6xl">
                        <i class="fas fa-cut"></i>
                    </div>
                @endif
                 {{-- If you have a gallery relationship, loop through and display images here --}}
                 {{-- <div class="grid grid-cols-2 md:grid-cols-3 gap-4 mt-4">
                     @foreach($barbershop->galleryImages as $image)
                         <img src="{{ asset('storage/' . $image->path) }}" alt="{{ $barbershop->name }} Gallery" class="w-full h-32 object-cover rounded-lg">
                     @endforeach
                 </div> --}}
            </div>


            {{-- Barbershop Image Banner --}}
            @if($barbershop->image)
                <img src="{{ asset('storage/' . $barbershop->image) }}" alt="{{ $barbershop->name }}"
                     class="w-full h-64 object-cover rounded-lg shadow-lg border border-white/10">
            @endif

            {{-- Header --}}
            <div class="text-center">
                <h1 class="text-4xl font-bold ">{{ $barbershop->name }}</h1>
                <p class="text-gray-300 mt-1"><i class="fas fa-map-marker-alt mr-1"></i> {{ $barbershop->city }}, {{ $barbershop->state }}</p>
            </div>

            {{-- Booking CTA --}}
            <div class="bg-gray-800 p-6 rounded-lg flex flex-col md:flex-row justify-between items-center shadow-xl">
                <div>
                    <h2 class="text-2xl font-semibold text-white">Ready to book?</h2>
                    <p class="text-sm text-gray-300">Don't miss your fresh cut at {{ $barbershop->name }}.</p>
                </div>
                <a href="{{ route('bookings.create', $barbershop->id) }}"
                   class="mt-4 md:mt-0 bg-yellow-400 text-gray-900 px-6 py-3 font-bold rounded shadow hover:bg-yellow-500">
                    Book Now
                </a>
            </div>

            {{-- Grid Layout --}}
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">

                {{-- LEFT SIDE --}}
                <div class="space-y-8">

                    {{-- About --}}
                    <div class="bg-white text-gray-800 p-6 rounded-lg shadow">
                        <h2 class="text-xl font-semibold mb-3">About</h2>
                        <p>{{ $barbershop->description ?? 'No description available.' }}</p>
                    </div>

                    {{-- Services --}}
                    <div class="bg-white text-gray-800 p-6 rounded-lg shadow">
                        <h2 class="text-xl font-semibold mb-3">Services</h2>
                        @if(is_array($barbershop->services) && count($barbershop->services) > 0)
                            <ul class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                                @foreach($barbershop->services as $service)
                                    <li class="bg-gray-100 p-3 rounded font-medium">{{ is_array($service) ? $service['name'] : $service }}</li>
                                @endforeach
                            </ul>
                        @else
                            <p class="text-gray-500">No services listed.</p>
                        @endif
                    </div>


                    {{--  + Rating --}}
                    <div class="bg-white rounded-lg shadow-md p-6">
                        <h3 class="text-xl font-semibold text-gray-700 mb-2">Rate</h3>
                        {{-- Rating Form --}}
                        @if(Auth::check() && Auth::user()->account_type !== 'barbershop')

                            <form action="{{ route('barbershop.rate', $barbershop->id) }}" method="POST">
                                @csrf

                                <div class="rating-stars mb-2">
                                    @for ($i = 1; $i <= 5; $i++)
                                        <i class="fa-regular fa-star fa-2x star" data-value="{{ $i }}"></i>
                                    @endfor
                                    <input type="hidden" name="rating" id="rating-value" required>
                                </div>

                                <textarea name="comment" class="form-control mb-3" placeholder="Write your comment (optional)" rows="3"></textarea>
                                <button class="btn btn-success" type="submit">Submit Rating</button>
                            </form>
                        @endif
                    </div>

                  
                    <div class="bg-white text-gray-800 p-6 rounded-lg shadow">
                        <h2 class="text-xl font-semibold mb-3">User Reviews</h2>
                        @forelse ($barbershop->ratings()->latest()->get() as $rating)
                            <div class="border-b pb-4 mb-4">
                                <div class="flex justify-between items-center">
                                    <strong>{{ $rating->user->name }}</strong>
                                    <small class="text-gray-500">{{ $rating->created_at->diffForHumans() }}</small>
                                </div>
                                <div class="text-yellow-500 my-1">
                                    @for ($i = 1; $i <= 5; $i++)
                                        <i class="{{ $i <= $rating->rating ? 'fas' : 'far' }} fa-star"></i>
                                    @endfor
                                </div>
                                @if ($rating->comment)
                                    <p class="text-gray-700">{{ $rating->comment }}</p>
                                @endif
                            </div>
                        @empty
                            <p class="text-gray-500">No reviews yet. Be the first to rate this barbershop!</p>
                        @endforelse
                    </div>

                </div>

                {{-- RIGHT SIDE --}}
                <div class="space-y-8">

                    {{-- Contact Info --}}
                    <div class="bg-white text-gray-800 p-6 rounded-lg shadow">
                        <h2 class="text-xl font-semibold mb-3">Contact Info</h2>
                        <ul class="space-y-2">
                            <li><strong>Phone:</strong> {{ $barbershop->phone ?? 'N/A' }}</li>
                            <li><strong>Email:</strong> {{ $barbershop->email ?? 'N/A' }}</li>
                            <li><strong>Website:</strong>
                                @if($barbershop->website)
                                    <a href="{{ $barbershop->website }}" class="text-blue-600 hover:underline" target="_blank">
                                        {{ $barbershop->website }}
                                    </a>
                                @else
                                    N/A
                                @endif
                            </li>
                            <li><strong>Address:</strong> {{ $barbershop->address ?? 'N/A' }}</li>
                        </ul>

                        {{-- Social Media and Website --}}
                        <div class="flex items-center space-x-4 mt-4">
                            @if($barbershop->website)
                                <a href="{{ $barbershop->website }}" target="_blank" class="text-gray-600 hover:text-gray-800 transition flex items-center"><i class="fas fa-globe mr-2"></i> Website</a>
                            @endif
                            @if($barbershop->instagram)
                                 {{-- Assuming Instagram handle is stored, construct the URL --}}
                                 <a href="https://www.instagram.com/{{ $barbershop->instagram }}" target="_blank" class="text-gray-600 hover:text-gray-800 transition flex items-center"><i class="fab fa-instagram mr-2"></i> Instagram</a>
                            @endif
                            @if($barbershop->facebook)
                                 {{-- Assuming Facebook handle or page ID is stored, construct the URL --}}
                                 <a href="https://www.facebook.com/{{ $barbershop->facebook }}" target="_blank" class="text-gray-600 hover:text-gray-800 transition flex items-center"><i class="fab fa-facebook-f mr-2"></i> Facebook</a>
                            @endif
                        </div>
                    </div>

                    {{-- Opening Hours --}}
                    <div class="bg-white text-gray-800 p-6 rounded-lg shadow">
                        <h2 class="text-xl font-semibold mb-3">Operating Hours</h2>
                         @if($barbershop->working_hours)
                            @foreach($barbershop->working_hours as $day => $hours)
                                <p class="text-gray-600">{{ ucfirst($day) }}: {{ $hours }}</p>
                            @endforeach
                        @else
                            <p class="text-gray-600">Hours not specified.</p>
                        @endif
                    </div>


                    {{-- Map Card  --}}
    
                        <div class="p-6 rounded-lg shadow bg-gray-200 h-64 rounded-lg flex items-center justify-center text-gray-600">
                            Map Placeholder
                            {{-- Integrate a map (e.g., Google Maps, Leaflet) here --}}
                        </div>
         

                    {{-- Map --}}
                    @if($barbershop->latitude && $barbershop->longitude)
                        <div class="bg-white p-6 rounded-lg shadow">
                            <h2 class="text-xl font-semibold mb-3 text-gray-800">Location Map</h2>
                            <iframe
                                width="100%" height="250" class="rounded"
                                frameborder="0" style="border:0"
                                src="https://www.google.com/maps/embed/v1/view?key=YOUR_GOOGLE_MAPS_API_KEY&center={{ $barbershop->latitude }},{{ $barbershop->longitude }}&zoom=15"
                                allowfullscreen>
                            </iframe>
                        </div>
                    @endif

                </div>
            </div>
        </div>
    </div>
    
    <script>
    const stars = document.querySelectorAll('.rating-stars .star');
    const ratingInput = document.getElementById('rating-value');

    stars.forEach(star => {
        star.addEventListener('click', () => {
            const value = star.dataset.value;
            ratingInput.value = value;

            stars.forEach(s => {
                const sVal = s.dataset.value;
                s.classList.remove('fas', 'far', 'text-yellow-400');
                if (sVal <= value) {
                    s.classList.add('fas', 'text-yellow-400');
                } else {
                    s.classList.add('far');
                }
            });
        });
    });
</script>


@endsection
