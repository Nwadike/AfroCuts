@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8 pt-24"> {{-- Added pt-24 for header spacing --}}
    <div class="flex justify-center">
        <div class="w-full max-w-md">
            <div class="bg-white shadow-md rounded-lg p-6">
                <h2 class="text-2xl font-bold text-gray-800 mb-6 text-center">{{ __('Register') }}</h2>

                <form method="POST" action="{{ route('register') }}">
                    @csrf

                    {{-- Name Field --}}
                    <div class="mb-4">
                        <label for="name" class="block text-gray-700 text-sm font-bold mb-2">{{ __('Name') }}</label>
                        <input id="name" type="text" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('name') border-red-500 @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                        @error('name')
                            <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Email Field --}}
                    <div class="mb-4">
                        <label for="email" class="block text-gray-700 text-sm font-bold mb-2">{{ __('Email Address') }}</label>
                        <input id="email" type="email" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('email') border-red-500 @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">
                        @error('email')
                            <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Password Field --}}
                    <div class="mb-4">
                        <label for="password" class="block text-gray-700 text-sm font-bold mb-2">{{ __('Password') }}</label>
                        <input id="password" type="password" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 mb-3 leading-tight focus:outline-none focus:shadow-outline @error('password') border-red-500 @enderror" name="password" required autocomplete="new-password">
                        @error('password')
                            <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Confirm Password Field --}}
                    <div class="mb-6">
                        <label for="password-confirm" class="block text-gray-700 text-sm font-bold mb-2">{{ __('Confirm Password') }}</label>
                        <input id="password-confirm" type="password" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" name="password_confirmation" required autocomplete="new-password">
                    </div>

                    {{-- Account Type Selection (Styled) --}}
                    <div class="mb-6" x-data="{ selectedType: '{{ old('account_type', 'regular') }}' }"> {{-- Use Alpine.js to track selection --}}
                        <label class="block text-gray-700 text-sm font-bold mb-2">{{ __('Account Type') }}</label>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4"> {{-- Use a grid for layout --}}

                            {{-- Regular Signup Option --}}
                            <label for="account_type_regular"
                                   class="flex flex-col items-center justify-center p-6 border rounded-lg cursor-pointer transition-all duration-200
                                          "
                                   :class="{ 'border-gray-800 bg-gray-100 shadow-inner': selectedType === 'regular', 'border-gray-300 bg-white hover:border-gray-500': selectedType !== 'regular' }"
                                   @click="selectedType = 'regular'"> {{-- Update Alpine state on click --}}
                                <input type="radio" id="account_type_regular" name="account_type" value="regular" class="hidden" {{ old('account_type', 'regular') == 'regular' ? 'checked' : '' }}> {{-- Hidden radio button --}}
                                <i class="fas fa-user text-3xl mb-3" :class="{ 'text-gray-800': selectedType === 'regular', 'text-gray-500': selectedType !== 'regular' }"></i> {{-- Icon --}}
                                <span class="text-lg font-semibold" :class="{ 'text-gray-800': selectedType === 'regular', 'text-gray-700': selectedType !== 'regular' }">{{ __('Regular') }}</span>
                                <p class="text-sm text-gray-600 text-center mt-1">Book appointments</p>
                            </label>

                            {{-- Business Signup Option --}}
                            <label for="account_type_business"
                                   class="flex flex-col items-center justify-center p-6 border rounded-lg cursor-pointer transition-all duration-200"
                                   :class="{ 'border-gray-800 bg-gray-100 shadow-inner': selectedType === 'business', 'border-gray-300 bg-white hover:border-gray-500': selectedType !== 'business' }"
                                   @click="selectedType = 'business'"> {{-- Update Alpine state on click --}}
                                <input type="radio" id="account_type_business" name="account_type" value="business" class="hidden" {{ old('account_type') == 'business' ? 'checked' : '' }}> {{-- Hidden radio button --}}
                                <i class="fas fa-store text-3xl mb-3" :class="{ 'text-gray-800': selectedType === 'business', 'text-gray-500': selectedType !== 'business' }"></i> {{-- Icon --}}
                                <span class="text-lg font-semibold" :class="{ 'text-gray-800': selectedType === 'business', 'text-gray-700': selectedType !== 'business' }">{{ __('Business') }}</span>
                                <p class="text-sm text-gray-600 text-center mt-1">List your barbershop</p>
                            </label>

                        </div>
                         @error('account_type')
                            <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>
                        @enderror
                    </div>


                    {{-- Register Button --}}
                    <div class="flex items-center justify-between">
                        <button type="submit" class="bg-gray-800 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                            {{ __('Register') }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
