<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="stylesheet" href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap">

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <!-- Custom styles for consistent look -->
    <style>
        .soft-green-bg {
            background-color: #f0fdf4; /* Soft green background */
        }
    </style>
</head>
<body class="soft-green-bg">
    <div class="min-h-screen bg-gray-100">
        <!-- Header with logo and logout button -->
        <header class="bg-white shadow">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4 flex justify-between items-center">
                <!-- Logo on the left -->
                <div class="flex items-center">
                    <img src="{{ asset('images/internmate-logo.jpg') }}" alt="Internmate Logo" class="h-8 w-auto mr-2">
                    <h1 class="text-xl font-bold">Internmate Dashboard</h1>
                </div>
                
                <!-- Logout button on the right -->
                <div class="flex items-center space-x-4">
                    <span class="text-gray-700">Welcome, {{ session('company_name') }}</span>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="px-3 py-1 bg-red-600 hover:bg-red-700 text-white rounded-md shadow-sm transition">
                            Logout
                        </button>
                    </form>
                </div>
            </div>
        </header>

        <!-- Page Content -->
        <main>
            {{ $content ?? '' }}
        </main>
    </div>
</body>
</html>