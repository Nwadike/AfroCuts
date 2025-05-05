@extends('layouts.app')

@section('content')
{{-- Container for the main content area with the doodle background --}}
{{-- Added relative positioning and overflow-hidden to this container --}}
{{-- Added pt-24 to give space for the fixed header --}}
<div class="min-h-screen flex items-center justify-center relative overflow-hidden py-12 pt-24"> {{-- Added min-h-screen, flex, items-center, justify-center --}}

    {{-- Doodle Background Overlay for the entire content area --}}
    {{-- Added absolute positioning, opacity, size, and repeat --}}
    <div class="absolute inset-0 z-0 opacity-10" style=" {{-- Adjusted opacity slightly if needed, or keep at 10 --}}
        background-image: url('https://img.freepik.com/premium-vector/hairdressing-barbershop-tools-seamless-pattern-beauty-salon_341076-314.jpg?w=900'); {{-- Your doodle image URL --}}
        background-size: 200px auto; {{-- Increased size of the doodle slightly --}}
        background-repeat: repeat; {{-- Ensure repeating --}}
        background-position: center; {{-- Center the repeating pattern --}}
        pointer-events: none; {{-- Allows clicks to pass through the doodle --}}
    "></div>

    <div class="w-full max-w-md relative z-10 bg-white rounded-lg shadow-md p-6 md:p-8"> {{-- Added relative z-10, bg-white, shadow, padding --}}
        <h2 class="text-2xl font-bold text-gray-800 text-center mb-6">Login</h2>

        <form method="POST" action="{{ route('login') }}">
            @csrf

            {{-- Email Address --}}
            <div class="mb-4">
                <label for="email" class="block text-gray-700 text-sm font-bold mb-2">{{ __('Email Address') }}</label>
                <input id="email" type="email" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('email') border-red-500 @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                @error('email')
                    <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>
                @enderror
            </div>

            {{-- Password --}}
            <div class="mb-6">
                <label for="password" class="block text-gray-700 text-sm font-bold mb-2">{{ __('Password') }}</label>
                <input id="password" type="password" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 mb-3 leading-tight focus:outline-none focus:shadow-outline @error('password') border-red-500 @enderror" name="password" required autocomplete="current-password">
                @error('password')
                    <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>
                @enderror
            </div>

            {{-- Remember Me --}}
            <div class="mb-4">
                <div class="flex items-center">
                    <input class="mr-2 leading-tight" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                    <label class="text-sm text-gray-700" for="remember">
                        {{ __('Remember Me') }}
                    </label>
                </div>
            </div>

            {{-- Login Button --}}
            <div class="flex items-center justify-between mb-4">
                <button type="submit" class="bg-gray-800 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline transition w-full">
                    {{ __('Login') }}
                </button>
            </div>

            {{-- Forgot Password Link --}}
            @if (Route::has('password.request'))
                <div class="text-center">
                    <a class="inline-block align-baseline font-bold text-sm text-gray-600 hover:text-gray-800" href="{{ route('password.request') }}">
                        {{ __('Forgot Your Password?') }}
                    </a>
                </div>
            @endif
        </form>
    </div>
</div>
@endsection
