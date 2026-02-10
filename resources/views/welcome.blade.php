<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'InternMate') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600,700" rel="stylesheet" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-white text-gray-900 font-sans antialiased">
    
    <!-- Navigation -->
    <nav class="fixed top-0 left-0 right-0 z-50 bg-white/80 backdrop-blur-md border-b border-gray-100">
        <div class="max-w-7xl mx-auto px-6 lg:px-8">
            <div class="flex items-center justify-between h-16">
                <!-- Logo -->
                <div class="flex items-center gap-2">
                    <img src="{{ asset('images/internmate-logo.jpg') }}" 
                         alt="InternMate" 
                         class="h-10 w-auto" />
                </div>

                <!-- Auth Buttons -->
                <div class="flex items-center gap-3">
                    <a href="{{ route('login') }}"
                       class="px-5 py-2 text-gray-700 hover:text-gray-900 font-medium transition-colors">
                        Login
                    </a>
                    <a href="{{ route('register') }}"
                       class="px-5 py-2.5 bg-[#8BB381] hover:bg-[#7aa370] text-white rounded-full font-medium transition-all shadow-sm hover:shadow-md">
                        Get Started
                    </a>
                </div>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="pt-32 pb-20 px-6 lg:px-8">
        <div class="max-w-6xl mx-auto">
            <div class="text-center max-w-3xl mx-auto">
                <h1 class="text-5xl lg:text-6xl font-bold mb-6 leading-tight">
                    Your Computing Internship,
                    <span class="text-[#8BB381]">Simplified</span>
                </h1>
                <p class="text-xl text-gray-600 mb-10 leading-relaxed">
                    Connect with top tech companies tailored to your course. 
                    From Software Engineering to Cybersecurity — find your perfect internship match.
                </p>
                <div class="flex items-center justify-center gap-4">
                    <a href="{{ route('register') }}"
                       class="px-8 py-4 bg-[#8BB381] hover:bg-[#7aa370] text-white rounded-full font-semibold text-lg transition-all shadow-lg hover:shadow-xl transform hover:-translate-y-0.5">
                        Start Your Journey
                    </a>
                    <a href="{{ route('login') }}"
                       class="px-8 py-4 bg-white border-2 border-gray-200 hover:border-[#8BB381] text-gray-700 hover:text-[#8BB381] rounded-full font-semibold text-lg transition-all">
                        Sign In
                    </a>
                </div>
            </div>

            <!-- Logo Display -->
            <div class="mt-16 flex justify-center">
                <div class="bg-white rounded-2xl shadow-xl p-8 border border-gray-100">
                    <img src="{{ asset('images/internmate-logo.jpg') }}" 
                         alt="InternMate"
                         class="h-40 w-auto mx-auto" />
                </div>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section class="py-20 bg-gray-50 px-6 lg:px-8">
        <div class="max-w-6xl mx-auto">
            <div class="text-center mb-16">
                <h2 class="text-3xl lg:text-4xl font-bold mb-4">Everything You Need</h2>
                <p class="text-lg text-gray-600">Streamlined tools to help you land your dream internship</p>
            </div>

            <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-8">
                <!-- Feature 1: Course Filtering -->
                <div class="bg-white rounded-xl p-6 shadow-sm hover:shadow-md transition-shadow">
                    <div class="w-12 h-12 bg-[#8BB381]/10 rounded-lg flex items-center justify-center mb-4">
                        <svg class="w-6 h-6 text-[#8BB381]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z" />
                        </svg>
                    </div>
                    <h3 class="font-semibold text-lg mb-2">Smart Filtering</h3>
                    <p class="text-gray-600 text-sm">Find companies that match your specialization — Software Engineering, Multimedia, Cybersecurity, or Network.</p>
                </div>

                <!-- Feature 2: AI Chatbot -->
                <div class="bg-white rounded-xl p-6 shadow-sm hover:shadow-md transition-shadow">
                    <div class="w-12 h-12 bg-[#8BB381]/10 rounded-lg flex items-center justify-center mb-4">
                        <svg class="w-6 h-6 text-[#8BB381]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z" />
                        </svg>
                    </div>
                    <h3 class="font-semibold text-lg mb-2">AI Assistant</h3>
                    <p class="text-gray-600 text-sm">Get instant help with your internship search. Ask questions, get recommendations, and receive guidance anytime.</p>
                </div>

                <!-- Feature 3: Application Tracking -->
                <div class="bg-white rounded-xl p-6 shadow-sm hover:shadow-md transition-shadow">
                    <div class="w-12 h-12 bg-[#8BB381]/10 rounded-lg flex items-center justify-center mb-4">
                        <svg class="w-6 h-6 text-[#8BB381]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4" />
                        </svg>
                    </div>
                    <h3 class="font-semibold text-lg mb-2">Track Applications</h3>
                    <p class="text-gray-600 text-sm">Manage all your applications in one place. See status updates and never miss an opportunity.</p>
                </div>

                <!-- Feature 4: Notifications -->
                <div class="bg-white rounded-xl p-6 shadow-sm hover:shadow-md transition-shadow">
                    <div class="w-12 h-12 bg-[#8BB381]/10 rounded-lg flex items-center justify-center mb-4">
                        <svg class="w-6 h-6 text-[#8BB381]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                        </svg>
                    </div>
                    <h3 class="font-semibold text-lg mb-2">Stay Updated</h3>
                    <p class="text-gray-600 text-sm">Get real-time notifications about new opportunities, application updates, and company responses.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- How It Works Section -->
    <section class="py-20 px-6 lg:px-8">
        <div class="max-w-5xl mx-auto">
            <div class="text-center mb-16">
                <h2 class="text-3xl lg:text-4xl font-bold mb-4">How It Works</h2>
                <p class="text-lg text-gray-600">Three simple steps to your next internship</p>
            </div>

            <div class="grid md:grid-cols-3 gap-8">
                <!-- Step 1 -->
                <div class="text-center">
                    <div class="w-16 h-16 bg-[#8BB381] text-white rounded-full flex items-center justify-center text-2xl font-bold mx-auto mb-4">
                        1
                    </div>
                    <h3 class="font-semibold text-xl mb-2">Create Your Profile</h3>
                    <p class="text-gray-600">Sign up and tell us about your course, skills, and preferences.</p>
                </div>

                <!-- Step 2 -->
                <div class="text-center">
                    <div class="w-16 h-16 bg-[#8BB381] text-white rounded-full flex items-center justify-center text-2xl font-bold mx-auto mb-4">
                        2
                    </div>
                    <h3 class="font-semibold text-xl mb-2">Browse & Apply</h3>
                    <p class="text-gray-600">Explore companies matched to your specialization and apply with one click.</p>
                </div>

                <!-- Step 3 -->
                <div class="text-center">
                    <div class="w-16 h-16 bg-[#8BB381] text-white rounded-full flex items-center justify-center text-2xl font-bold mx-auto mb-4">
                        3
                    </div>
                    <h3 class="font-semibold text-xl mb-2">Get Hired</h3>
                    <p class="text-gray-600">Track your applications and connect with companies looking for talent like you.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="py-20 bg-gradient-to-br from-[#8BB381] to-[#7aa370] px-6 lg:px-8">
        <div class="max-w-4xl mx-auto text-center">
            <h2 class="text-3xl lg:text-4xl font-bold text-white mb-6">
                Ready to Find Your Internship?
            </h2>
            <p class="text-xl text-white/90 mb-8">
                Join students from Software Engineering, Multimedia, Cybersecurity, and Network courses finding their perfect match.
            </p>
            <a href="{{ route('register') }}"
               class="inline-block px-10 py-4 bg-white text-[#8BB381] rounded-full font-semibold text-lg hover:shadow-2xl transition-all transform hover:-translate-y-1">
                Create Free Account
            </a>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-[#1B1B18] text-white py-12 px-6 lg:px-8">
        <div class="max-w-6xl mx-auto">
            <div class="grid md:grid-cols-3 gap-8 mb-8">
                <!-- Brand -->
                <div>
                    <img src="{{ asset('images/internmate-logo.jpg') }}" 
                         alt="InternMate" 
                         class="h-10 w-auto mb-4 bg-white rounded p-1" />
                    <p class="text-gray-400 text-sm">
                        Connecting computing students with their ideal internship opportunities.
                    </p>
                </div>

                <!-- Quick Links -->
                <div>
                    <h4 class="font-semibold mb-4">Quick Links</h4>
                    <ul class="space-y-2 text-sm">
                        <li><a href="{{ route('login') }}" class="text-gray-400 hover:text-white transition-colors">Login</a></li>
                        <li><a href="{{ route('register') }}" class="text-gray-400 hover:text-white transition-colors">Register</a></li>
                    </ul>
                </div>

                <!-- Courses -->
                <div>
                    <h4 class="font-semibold mb-4">Supported Courses</h4>
                    <ul class="space-y-2 text-sm text-gray-400">
                        <li>Software Engineering</li>
                        <li>Multimedia</li>
                        <li>Cybersecurity</li>
                        <li>Network</li>
                    </ul>
                </div>
            </div>

            <div class="border-t border-gray-800 pt-8 text-center text-sm text-gray-400">
                <p>&copy; {{ date('Y') }} InternMate. All rights reserved.</p>
            </div>
        </div>
    </footer>

</body>
</html>