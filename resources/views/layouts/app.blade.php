<!DOCTYPE html>
<html lang="en" x-data="{ mobileMenuOpen: false, userDropdownOpen: false }">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AfroCuts - Black Barbershop Directory</title>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="https://cdn.tailwindcss.com"></script>


    {{-- <link href="{{ asset('css/style.css') }}" rel="stylesheet"> --}}

    <style>
        [x-cloak] { display: none !important; }
         /* Optional: Basic styling to ensure footer is at the bottom */
        body {
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }
        main {
            flex-grow: 1;
        }
    </style>
    @stack('styles')
</head>
<body class="bg-gray-50 font-sans antialiased">

    {{-- Header is now included directly in specific views (like index.blade.php and show.blade.php) or is part of the content section (like home.blade.php) --}}
    {{-- @include('partials.header') --}} {{-- Removed from here --}}

    <main>
        @yield('content')
    </main>

    {{-- Include the footer partial --}}
    @include('partials.footer')

    @stack('scripts')
    
</body>
</html>
