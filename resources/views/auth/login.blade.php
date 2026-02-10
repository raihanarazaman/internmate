<x-guest-layout>
    <!-- Header -->
    <div class="text-center mb-8">
        <h2 class="text-3xl font-bold text-gray-900 mb-2">Welcome Back</h2>
        <p class="text-gray-600">Sign in to continue to InternMate</p>
    </div>

    <!-- Session Status -->
    @if (session('status'))
        <div class="mb-6 p-4 bg-green-50 border border-green-200 rounded-lg text-sm text-green-700">
            {{ session('status') }}
        </div>
    @endif

    <!-- Login Form -->
    <form method="POST" action="{{ route('login') }}" class="space-y-5">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" value="Email" class="text-gray-700 font-medium" />
            <x-text-input 
                id="email" 
                name="email" 
                type="email"
                class="block mt-2 w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#8BB381] focus:border-transparent transition-all"
                :value="old('email')" 
                placeholder="you@example.com"
                required 
                autofocus 
                autocomplete="username" 
            />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div>
            <x-input-label for="password" value="Password" class="text-gray-700 font-medium" />
            <x-text-input 
                id="password" 
                name="password"
                type="password"
                class="block mt-2 w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#8BB381] focus:border-transparent transition-all"
                placeholder="Enter your password"
                required 
                autocomplete="current-password" 
            />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Remember Me -->
        <div class="flex items-center justify-between">
            <label for="remember_me" class="inline-flex items-center cursor-pointer">
                <input 
                    id="remember_me" 
                    type="checkbox"
                    class="rounded border-gray-300 text-[#8BB381] shadow-sm focus:ring-[#8BB381] cursor-pointer"
                    name="remember"
                >
                <span class="ms-2 text-sm text-gray-600">Remember me</span>
            </label>

            @if (Route::has('password.request'))
                <a class="text-sm text-[#8BB381] hover:text-[#7aa370] font-medium transition-colors" href="{{ route('password.request') }}">
                    Forgot password?
                </a>
            @endif
        </div>

        <!-- Submit Button -->
        <div class="pt-2">
            <button 
                type="submit"
                class="w-full px-6 py-3.5 bg-[#8BB381] hover:bg-[#7aa370] text-white font-semibold rounded-lg transition-all shadow-sm hover:shadow-md transform hover:-translate-y-0.5"
            >
                Sign In
            </button>
        </div>

        <!-- Register Link -->
        <div class="text-center pt-4 border-t border-gray-100">
            <p class="text-sm text-gray-600">
                Don't have an account?
                <a href="{{ route('register') }}" class="text-[#8BB381] hover:text-[#7aa370] font-semibold transition-colors">
                    Create one now
                </a>
            </p>
        </div>
    </form>
</x-guest-layout>