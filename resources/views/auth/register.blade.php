<x-guest-layout>
    <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- Role -->
        <div>
            <x-input-label for="role" :value="__('Register as')" />
            <select id="role" name="role" class="block mt-1 w-full border-gray-300 rounded-md shadow-sm">
                <option value="student">Student</option>
                <option value="company">Company</option>
            </select>
        </div>

        <!-- Student Fields -->
        <div id="student-fields">
            <div class="mt-4">
                <x-input-label for="student_id" :value="__('Student ID')" />
                <x-text-input id="student_id" class="block mt-1 w-full" type="text" name="student_id" :value="old('student_id')"  />
                <x-input-error :messages="$errors->get('student_id')" class="mt-2" />
            </div>

            <div class="mt-4">
                <x-input-label for="full_name" :value="__('Full Name')" />
                <x-text-input id="full_name" class="block mt-1 w-full" type="text" name="full_name" :value="old('full_name')"  />
                <x-input-error :messages="$errors->get('full_name')" class="mt-2" />
            </div>

            <div class="mt-4">
                <x-input-label for="course" :value="__('Course')" />
                <select id="course" name="course" class="block mt-1 w-full border-gray-300 rounded-md shadow-sm" >
                    <option value="">-- Select --</option>
                    <option value="Computer Science">Computer Science</option>
                    <option value="Engineering">Engineering</option>
                    <option value="Business">Business</option>
                </select>
                <x-input-error :messages="$errors->get('course')" class="mt-2" />
            </div>
        </div>

        <!-- Company Fields -->
        <div id="company-fields" style="display:none;">
            <div class="mt-4">
                <x-input-label for="email" :value="__('Company Email')" />
                <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')"  />
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            <div class="mt-4">
                <x-input-label for="company_name" :value="__('Company Name')" />
                <x-text-input id="company_name" class="block mt-1 w-full" type="text" name="company_name" :value="old('company_name')"  />
                <x-input-error :messages="$errors->get('company_name')" class="mt-2" />
            </div>

            <div class="mt-4">
                <x-input-label for="location" :value="__('Location')" />
                <select id="location" name="location" class="block mt-1 w-full border-gray-300 rounded-md shadow-sm" >
                    <option value="">-- Select City --</option>
                    <option value="Kuala Lumpur" {{ old('location') == 'Kuala Lumpur' ? 'selected' : '' }}>Kuala Lumpur</option>
                    <option value="Petaling Jaya" {{ old('location') == 'Petaling Jaya' ? 'selected' : '' }}>Petaling Jaya</option>
                    <option value="Shah Alam" {{ old('location') == 'Shah Alam' ? 'selected' : '' }}>Shah Alam</option>
                    <option value="Cyberjaya" {{ old('location') == 'Cyberjaya' ? 'selected' : '' }}>Cyberjaya</option>
                    <option value="Johor Bahru" {{ old('location') == 'Johor Bahru' ? 'selected' : '' }}>Johor Bahru</option>
                    <option value="Penang" {{ old('location') == 'Penang' ? 'selected' : '' }}>Penang</option>
                    <option value="Ipoh" {{ old('location') == 'Ipoh' ? 'selected' : '' }}>Ipoh</option>
                    <option value="Kuching" {{ old('location') == 'Kuching' ? 'selected' : '' }}>Kuching</option>
                    <option value="Kota Kinabalu" {{ old('location') == 'Kota Kinabalu' ? 'selected' : '' }}>Kota Kinabalu</option>
                    <option value="Melaka" {{ old('location') == 'Melaka' ? 'selected' : '' }}>Melaka</option>
                </select>
                <x-input-error :messages="$errors->get('location')" class="mt-2" />
            </div>
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />
            <x-text-input id="password" class="block mt-1 w-full" type="password" name="password"  autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" />
            <x-text-input id="password_confirmation" class="block mt-1 w-full" type="password" name="password_confirmation"  autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('login') }}">
                {{ __('Already registered?') }}
            </a>

            <x-primary-button type="submit" class="ms-4">
                {{ __('Register') }}
            </x-primary-button>
        </div>
    </form>

    <!-- Safe JavaScript -->
    <script>
    document.addEventListener('DOMContentLoaded', function () {
        const roleSelect = document.getElementById('role');
        const studentFields = document.getElementById('student-fields');
        const companyFields = document.getElementById('company-fields');

        if (roleSelect && studentFields && companyFields) {
            function toggleFields() {
                if (roleSelect.value === 'student') {
                    studentFields.style.display = 'block';
                    companyFields.style.display = 'none';
                } else {
                    studentFields.style.display = 'none';
                    companyFields.style.display = 'block';
                }
            }

            roleSelect.addEventListener('change', toggleFields);
            toggleFields(); // Set initial state
        }
    });
    </script>
</x-guest-layout>