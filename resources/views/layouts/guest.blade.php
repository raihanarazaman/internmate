<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>{{ config('app.name', 'InternMate') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600,700" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased bg-gray-50">
        <div class="min-h-screen flex flex-col">
            
            <!-- Top Navigation Bar -->
            <nav class="bg-white border-b border-gray-100">
                <div class="max-w-7xl mx-auto px-6 lg:px-8">
                    <div class="flex items-center justify-between h-16">
                        <!-- Logo -->
                        <a href="/" class="flex items-center gap-2">
                            <img src="{{ asset('images/internmate-logo.jpg') }}" 
                                 alt="InternMate" 
                                 class="h-10 w-auto" />
                        </a>

                        <!-- Back to Home Link -->
                        <a href="/" class="text-sm text-gray-600 hover:text-gray-900 transition-colors">
                            ← Back to Home
                        </a>
                    </div>
                </div>
            </nav>

            <!-- Main Content -->
            <div class="flex-1 flex items-center justify-center py-12 px-6 lg:px-8">
                <div class="w-full max-w-md">
                    <!-- Card Container -->
                    <div class="bg-white rounded-2xl shadow-lg border border-gray-100 overflow-hidden">
                        <div class="px-8 py-10">
                            {{ $slot }}
                        </div>
                    </div>
                </div>
            </div>

            <!-- Footer -->
            <footer class="bg-white border-t border-gray-100 py-6">
                <div class="max-w-7xl mx-auto px-6 lg:px-8">
                    <p class="text-center text-sm text-gray-500">
                        &copy; {{ date('Y') }} InternMate. All rights reserved.
                    </p>
                </div>
            </footer>

        </div>
    </body>
</html>