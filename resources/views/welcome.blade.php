<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'InternMate') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />

    <!-- Vite for CSS/JS (if available) -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-[#8BB381] text-black flex flex-col items-center justify-center min-h-screen p-6 lg:p-8">
    <div class="w-full max-w-md text-center">
        <!-- Top Bar: Logo + Buttons -->
        <div class="flex items-center justify-between mb-8">
            <!-- Logo (small) -->
            <img src="{{ asset('images/internmate-logo.jpg') }}" 
                 alt="InternMate" 
                 class="h-12 w-auto" />

            <!-- Auth Buttons -->
            <div class="flex gap-3">
                @if (Route::has('login'))
                    @auth
                        <a href="{{ url('/dashboard') }}"
                           class="px-4 py-2 bg-[#1B1B18] text-white rounded-full text-sm font-medium">
                            Dashboard
                        </a>
                    @else
                        <a href="{{ route('login') }}"
                           class="px-4 py-2 bg-[#1B1B18] text-white rounded-full text-sm font-medium">
                            LOGIN
                        </a>
                        @if (Route::has('register'))
                            <a href="{{ route('register') }}"
                               class="px-4 py-2 bg-[#1B1B18] text-white rounded-full text-sm font-medium">
                                REGISTER
                            </a>
                        @endif
                    @endauth
                @endif
            </div>
        </div>

        <!-- Main Content -->
        <h1 class="text-2xl font-bold mb-6">Welcome to InternMate !</h1>

        <!-- Centered Logo (larger) -->
        <div class="mb-8">
            <img src="{{ asset('images/internmate-logo.jpg') }}" 
                 alt="InternMate"
                 class="mx-auto h-48 w-auto" />
        </div>

        <p class="text-lg leading-relaxed">
            Here is where your internship finder will help you to match your preference.
        </p>
    </div>
</body>
</html>