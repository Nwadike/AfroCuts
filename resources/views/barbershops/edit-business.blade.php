@extends('layouts.dashboard') {{-- Use the new dashboard layout --}}

@section('dashboard_content') {{-- Content goes into the dashboard layout's section --}}
<div class="bg-white rounded-lg shadow-md p-6 md:p-8">
    <h2 class="text-2xl font-bold text-gray-800 mb-6">Edit Barbershop Details</h2>

    @if (session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
            <span class="block sm:inline">{{ session('success') }}</span>
        </div>
    @endif

    <form method="POST" action="{{ route('barbershops.update', $barbershop->id) }}" enctype="multipart/form-data">
        @csrf
        @method('PUT') {{-- Use the PUT method for updates --}}

        {{-- Barbershop Name (Read-only) --}}
        <div class="mb-4">
            <label for="name" class="block text-gray-700 text-sm font-bold mb-2">Barbershop Name</label>
            <input id="name" type="text" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline bg-gray-100 cursor-not-allowed" value="{{ $barbershop->name }}" readonly>
        </div>

        {{-- Description --}}
        <div class="mb-4">
            <label for="description" class="block text-gray-700 text-sm font-bold mb-2">Description</label>
            <textarea id="description" name="description" rows="4" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('description') border-red-500 @enderror">{{ old('description', $barbershop->description) }}</textarea>
            @error('description')
                <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>
            @enderror
        </div>

        {{-- Address --}}
        <div class="mb-4">
            <label for="address" class="block text-gray-700 text-sm font-bold mb-2">Address</label>
            <input id="address" type="text" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('address') border-red-500 @enderror" name="address" value="{{ old('address', $barbershop->address) }}" required>
            @error('address')
                <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>
            @enderror
        </div>

        {{-- City --}}
        <div class="mb-4">
            <label for="city" class="block text-gray-700 text-sm font-bold mb-2">City</label>
            <input id="city" type="text" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('city') border-red-500 @enderror" name="city" value="{{ old('city', $barbershop->city) }}" required>
            @error('city')
                <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>
            @enderror
        </div>

        {{-- State --}}
        <div class="mb-4">
            <label for="state" class="block text-gray-700 text-sm font-bold mb-2">State</label>
            <input id="state" type="text" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('state') border-red-500 @enderror" name="state" value="{{ old('state', $barbershop->state) }}" required>
            @error('state')
                <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>
            @enderror
        </div>

        {{-- Zip Code --}}
        <div class="mb-4">
            <label for="zip_code" class="block text-gray-700 text-sm font-bold mb-2">Zip Code</label>
            <input id="zip_code" type="text" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('zip_code') border-red-500 @enderror" name="zip_code" value="{{ old('zip_code', $barbershop->zip_code) }}" required>
            @error('zip_code')
                <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>
            @enderror
        </div>

        {{-- Phone --}}
        <div class="mb-4">
            <label for="phone" class="block text-gray-700 text-sm font-bold mb-2">Phone</label>
            <input id="phone" type="text" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('phone') border-red-500 @enderror" name="phone" value="{{ old('phone', $barbershop->phone) }}">
            @error('phone')
                <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>
            @enderror
        </div>

        {{-- Email --}}
        <div class="mb-4">
            <label for="email" class="block text-gray-700 text-sm font-bold mb-2">Email</label>
            <input id="email" type="email" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('email') border-red-500 @enderror" name="email" value="{{ old('email', $barbershop->email) }}">
            @error('email')
                <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>
            @enderror
        </div>

         {{-- Website --}}
        <div class="mb-4">
            <label for="website" class="block text-gray-700 text-sm font-bold mb-2">Website (Optional)</label>
            <input id="website" type="url" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('website') border-red-500 @enderror" name="website" value="{{ old('website', $barbershop->website) }}">
            @error('website')
                <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>
            @enderror
        </div>

         {{-- Instagram --}}
        <div class="mb-4">
            <label for="instagram" class="block text-gray-700 text-sm font-bold mb-2">Instagram Handle (Optional)</label>
            <input id="instagram" type="text" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('instagram') border-red-500 @enderror" name="instagram" value="{{ old('instagram', $barbershop->instagram) }}">
            @error('instagram')
                <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>
            @enderror
        </div>

         {{-- Facebook --}}
        <div class="mb-6">
            <label for="facebook" class="block text-gray-700 text-sm font-bold mb-2">Facebook Page ID/Handle (Optional)</label>
            <input id="facebook" type="text" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('facebook') border-red-500 @enderror" name="facebook" value="{{ old('facebook', $barbershop->facebook) }}">
            @error('facebook')
                <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>
            @enderror
        </div>

        {{-- Logo Upload --}}
        <div class="mb-6">
            <label for="logo" class="block text-gray-700 text-sm font-bold mb-2">Barbershop Logo (Optional)</label>
            <input id="logo" type="file" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('logo') border-red-500 @enderror" name="logo">
            @error('logo')
                <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>
            @enderror
            @if($barbershop->logo)
                <p class="text-gray-600 text-sm mt-2">Current Logo:</p>
                <img src="{{ asset('storage/' . $barbershop->logo) }}" alt="Current Logo" class="w-20 h-20 object-cover rounded-lg mt-2">
            @endif
        </div>

        {{-- Working Hours (Placeholder - you'll need a more robust UI for this) --}}
         <div class="mb-6">
             <h3 class="text-xl font-semibold text-gray-700 mb-2">Working Hours (Edit in full profile)</h3>
             <p class="text-gray-600">Working hours editing is available in the full barbershop profile management section.</p>
             {{-- You would ideally have a complex form here for editing hours --}}
         </div>

         {{-- Services (Placeholder - you'll need a more robust UI for this) --}}
         <div class="mb-6">
              <h3 class="text-xl font-semibold text-gray-700 mb-2">Services (Edit in full profile)</h3>
              <p class="text-gray-600">Service management is available in the full barbershop profile management section.</p>
              {{-- You would ideally have a complex form here for editing services --}}
          </div>


        {{-- Update Button --}}
        <div class="flex items-center justify-between">
            <button type="submit" class="bg-gray-800 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                Update Barbershop
            </button>
        </div>
    </form>
</div>
@endsection
