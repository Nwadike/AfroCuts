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
        <h2 class="text-2xl font-bold text-gray-800 text-center mb-6">{{ __('Reset Password') }}</h2>

        {{-- Session Status Message (e.g., "We have emailed your password reset link!") --}}
        @if (session('status'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                <span class="block sm:inline">{{ session('status') }}</span>
            </div>
        @endif

        <form method="POST" action="{{ route('password.email') }}">
            @csrf

            {{-- Email Address --}}
            <div class="mb-4">
                <label for="email" class="block text-gray-700 text-sm font-bold mb-2">{{ __('Email Address') }}</label>
                <input id="email" type="email" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('email') border-red-500 @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                @error('email')
                    <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>
                @enderror
            </div>

            {{-- Send Password Reset Link Button --}}
            <div class="flex items-center justify-between">
                <button type="submit" class="bg-gray-800 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline transition w-full">
                    {{ __('Send Password Reset Link') }}
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
