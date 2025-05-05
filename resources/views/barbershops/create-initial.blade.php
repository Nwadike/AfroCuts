@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8 pt-24"> {{-- Added pt-24 for header spacing --}}
    <div class="flex justify-center">
        <div class="w-full max-w-md">
            <div class="bg-white shadow-md rounded-lg p-6">
                <h2 class="text-2xl font-bold text-gray-800 mb-6 text-center">Tell Us About Your Barbershop</h2>
                <p class="text-gray-600 mb-6 text-center">Just a few details to get started.</p>

                {{-- Use the existing barbershops.store route --}}
                <form method="POST" action="{{ route('barbershops.store') }}" enctype="multipart/form-data">
                    @csrf

                    {{-- Barbershop Name --}}
                    <div class="mb-4">
                        <label for="name" class="block text-gray-700 text-sm font-bold mb-2">Barbershop Name</label>
                        <input id="name" type="text" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('name') border-red-500 @enderror" name="name" value="{{ old('name') }}" required autofocus>
                        @error('name')
                            <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Address --}}
                    <div class="mb-4">
                        <label for="address" class="block text-gray-700 text-sm font-bold mb-2">Address</label>
                        <input id="address" type="text" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('address') border-red-500 @enderror" name="address" value="{{ old('address') }}" required>
                        @error('address')
                            <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- City --}}
                    <div class="mb-4">
                        <label for="city" class="block text-gray-700 text-sm font-bold mb-2">City</label>
                        <input id="city" type="text" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('city') border-red-500 @enderror" name="city" value="{{ old('city') }}" required>
                        @error('city')
                            <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- State --}}
                    <div class="mb-4">
                        <label for="state" class="block text-gray-700 text-sm font-bold mb-2">State</label>
                        <input id="state" type="text" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('state') border-red-500 @enderror" name="state" value="{{ old('state') }}" required>
                        @error('state')
                            <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Zip Code --}}
                    <div class="mb-6">
                        <label for="zip_code" class="block text-gray-700 text-sm font-bold mb-2">Zip Code</label>
                        <input id="zip_code" type="text" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('zip_code') border-red-500 @enderror" name="zip_code" value="{{ old('zip_code') }}" required>
                        @error('zip_code')
                            <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>
                        @enderror
                    </div>

                     {{-- Phone (Optional for initial) --}}
                    <div class="mb-4">
                        <label for="phone" class="block text-gray-700 text-sm font-bold mb-2">Phone (Optional)</label>
                        <input id="phone" type="text" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('phone') border-red-500 @enderror" name="phone" value="{{ old('phone') }}">
                        @error('phone')
                            <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>
                        @enderror
                    </div>


                    {{-- Submit Button --}}
                    <div class="flex items-center justify-between">
                        <button type="submit" class="bg-gray-800 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                            Create Barbershop
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
