<footer class="bg-gray-900 text-white py-12 mt-auto"> {{-- Added mt-auto to push footer to bottom --}}
    <div class="container mx-auto px-4">
        <div class="flex flex-col items-center">
            <div class="mb-6">
                <a href="{{ url('/') }}" class="flex items-center space-x-2">
                    <span class="flex items-center justify-center flex-shrink-0 w-8 h-8 text-gray-900 rounded-full bg-gradient-to-br from-white via-gray-200 to-white">
                         {{-- SVG icon from app.blade.php --}}
                        <svg class="w-auto h-5 -translate-y-px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M12 2L15.09 8.26L22 9.27L17 14.14L18.18 21.02L12 17.77L5.82 21.02L7 14.14L2 9.27L8.91 8.26L12 2Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </span>
                    <span class="text-xl font-bold">AfroCuts</span>
                </a>
            </div>
            <div class="mb-6 text-center">
                <p class="text-gray-400">Connecting you with the best black barbershops in your area</p>
            </div>
            {{-- Social Media Links --}}
            <div class="flex space-x-6 mb-6">
                <a href="#" class="text-gray-400 hover:text-white transition">
                    <i class="fab fa-facebook-f"></i>
                </a>
                <a href="#" class="text-gray-400 hover:text-white transition">
                    <i class="fab fa-twitter"></i>
                </a>
                <a href="#" class="text-gray-400 hover:text-white transition">
                    <i class="fab fa-instagram"></i>
                </a>
            </div>
            <div class="text-center text-gray-500 text-sm">
                &copy; {{ date('Y') }} AfroCuts. All rights reserved.
            </div>
        </div>
    </div>
</footer>
