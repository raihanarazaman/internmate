<x-guest-layout>
    <!-- Header -->
    <div class="text-center mb-8">
        <h2 class="text-3xl font-bold text-gray-900 mb-2">Create Account</h2>
        <p class="text-gray-600">Join InternMate to find your perfect internship</p>
    </div>

    <!-- Error Messages -->
    @if ($errors->any())
        <div class="mb-6 p-4 bg-red-50 border border-red-200 rounded-lg">
            <div class="flex items-start">
                <svg class="w-5 h-5 text-red-600 mt-0.5 mr-2 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
                </svg>
                <div class="flex-1">
                    <p class="text-sm font-semibold text-red-800 mb-1">Please fix the following errors:</p>
                    <ul class="list-disc list-inside text-sm text-red-700 space-y-1">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    @endif

    <!-- Registration Form -->
    <form method="POST" action="{{ route('register') }}" class="space-y-5">
        @csrf

        {{-- ================= ROLE SELECTION ================= --}}
        <div>
            <x-input-label for="role" value="I am registering as" class="text-gray-700 font-medium" />
            <select 
                id="role" 
                name="role"
                class="block mt-2 w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#8BB381] focus:border-transparent transition-all"
                required
            >
                <option value="student" {{ old('role') === 'student' ? 'selected' : '' }}>
                    🎓 Student
                </option>
                <option value="company" {{ old('role') === 'company' ? 'selected' : '' }}>
                    🏢 Company
                </option>
                <option value="admin" {{ old('role') === 'admin' ? 'selected' : '' }}>
                    👨‍🏫 Lecturer / Supervisor
                </option>
            </select>
            <x-input-error :messages="$errors->get('role')" class="mt-2" />
        </div>

        {{-- ================= COMMON FIELDS ================= --}}
        <div class="pt-4 border-t border-gray-100">
            <h3 class="text-sm font-semibold text-gray-700 mb-4">Account Details</h3>
            
            <!-- Username -->
            <div>
                <x-input-label for="name" value="Username" class="text-gray-700 font-medium" />
                <x-text-input 
                    id="name" 
                    name="name"
                    class="block mt-2 w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#8BB381] focus:border-transparent transition-all"
                    :value="old('name')" 
                    placeholder="Choose a username"
                    required 
                />
                <x-input-error :messages="$errors->get('name')" class="mt-2" />
            </div>

            <!-- Email -->
            <div class="mt-4">
                <x-input-label for="email" value="Email Address" class="text-gray-700 font-medium" />
                <x-text-input 
                    id="email" 
                    name="email" 
                    type="email"
                    class="block mt-2 w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#8BB381] focus:border-transparent transition-all"
                    :value="old('email')" 
                    placeholder="you@example.com"
                    required 
                />
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>
        </div>

        {{-- ================= STUDENT FIELDS ================= --}}
        <div id="student-fields" class="pt-4 border-t border-gray-100 space-y-4">
            <h3 class="text-sm font-semibold text-gray-700 mb-4">Student Information</h3>
            
            <div>
                <x-input-label for="student_id" value="Student ID" class="text-gray-700 font-medium" />
                <x-text-input 
                    id="student_id" 
                    name="student_id"
                    class="block mt-2 w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#8BB381] focus:border-transparent transition-all"
                    :value="old('student_id')" 
                    placeholder="e.g., 2021123456"
                />
                <x-input-error :messages="$errors->get('student_id')" class="mt-2" />
            </div>

            <div>
                <x-input-label for="full_name" value="Full Name" class="text-gray-700 font-medium" />
                <x-text-input 
                    id="full_name" 
                    name="full_name"
                    class="block mt-2 w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#8BB381] focus:border-transparent transition-all"
                    :value="old('full_name')" 
                    placeholder="Your full name as per IC"
                />
                <x-input-error :messages="$errors->get('full_name')" class="mt-2" />
            </div>

            <div>
                <x-input-label for="course" value="Course" class="text-gray-700 font-medium" />
                <select 
                    id="course" 
                    name="course"
                    class="block mt-2 w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#8BB381] focus:border-transparent transition-all"
                >
                    <option value="">-- Select Your Course --</option>
                    <option value="Software Engineering" {{ old('course') === 'Software Engineering' ? 'selected' : '' }}>
                        Software Engineering
                    </option>
                    <option value="Multimedia" {{ old('course') === 'Multimedia' ? 'selected' : '' }}>
                        Multimedia
                    </option>
                    <option value="Cybersecurity" {{ old('course') === 'Cybersecurity' ? 'selected' : '' }}>
                        Cybersecurity
                    </option>
                    <option value="Network" {{ old('course') === 'Network' ? 'selected' : '' }}>
                        Network
                    </option>
                </select>
                <x-input-error :messages="$errors->get('course')" class="mt-2" />
            </div>

            <div>
                <x-input-label for="cgpa" value="CGPA (Optional)" class="text-gray-700 font-medium" />
                <x-text-input 
                    id="cgpa" 
                    name="cgpa"
                    type="number" 
                    step="0.01" 
                    min="0" 
                    max="4"
                    class="block mt-2 w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#8BB381] focus:border-transparent transition-all"
                    :value="old('cgpa')" 
                    placeholder="e.g., 3.50"
                />
                <p class="mt-1 text-xs text-gray-500">Enter your current CGPA (0.00 - 4.00)</p>
                <x-input-error :messages="$errors->get('cgpa')" class="mt-2" />
            </div>

            <div>
                <x-input-label for="interests" value="Interests (Optional)" class="text-gray-700 font-medium" />
                <x-text-input 
                    id="interests" 
                    name="interests"
                    class="block mt-2 w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#8BB381] focus:border-transparent transition-all"
                    :value="old('interests')" 
                    placeholder="e.g., Web Development, AI, Cloud Computing"
                />
                <p class="mt-1 text-xs text-gray-500">Separate multiple interests with commas</p>
            </div>
        </div>

        {{-- ================= COMPANY FIELDS ================= --}}
        <div id="company-fields" class="pt-4 border-t border-gray-100 space-y-4 hidden">
            <h3 class="text-sm font-semibold text-gray-700 mb-4">Company Information</h3>
            
            <div>
                <x-input-label for="company_name" value="Company Name" class="text-gray-700 font-medium" />
                <x-text-input 
                    id="company_name" 
                    name="company_name"
                    class="block mt-2 w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#8BB381] focus:border-transparent transition-all"
                    :value="old('company_name')" 
                    placeholder="e.g., Tech Solutions Sdn Bhd"
                />
                <x-input-error :messages="$errors->get('company_name')" class="mt-2" />
            </div>

            <div>
                <x-input-label for="company_email" value="Company Email" class="text-gray-700 font-medium" />
                <x-text-input 
                    id="company_email" 
                    name="company_email"
                    type="email"
                    class="block mt-2 w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#8BB381] focus:border-transparent transition-all"
                    :value="old('company_email')" 
                    placeholder="contact@company.com"
                />
                <x-input-error :messages="$errors->get('company_email')" class="mt-2" />
            </div>

            <div>
                <x-input-label for="location" value="Location" class="text-gray-700 font-medium" />
                <select 
                    id="location" 
                    name="location"
                    class="block mt-2 w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#8BB381] focus:border-transparent transition-all"
                >
                    <option value="">-- Select City --</option>
                    @foreach(['Kuala Lumpur','Petaling Jaya','Shah Alam','Cyberjaya','Johor Bahru','Penang','Ipoh','Kuching','Kota Kinabalu','Melaka'] as $city)
                        <option value="{{ $city }}" {{ old('location') === $city ? 'selected' : '' }}>
                            {{ $city }}
                        </option>
                    @endforeach
                </select>
                <x-input-error :messages="$errors->get('location')" class="mt-2" />
            </div>
        </div>

        {{-- ================= ADMIN FIELDS ================= --}}
        <div id="admin-fields" class="pt-4 border-t border-gray-100 space-y-4 hidden">
            <h3 class="text-sm font-semibold text-gray-700 mb-4">Lecturer Information</h3>
            
            <div>
                <x-input-label for="staff_id" value="Staff ID" class="text-gray-700 font-medium" />
                <x-text-input 
                    id="staff_id" 
                    name="staff_id"
                    class="block mt-2 w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#8BB381] focus:border-transparent transition-all"
                    :value="old('staff_id')" 
                    placeholder="e.g., L2021001"
                />
                <x-input-error :messages="$errors->get('staff_id')" class="mt-2" />
            </div>

            <div>
                <x-input-label for="admin_full_name" value="Full Name" class="text-gray-700 font-medium" />
                <x-text-input 
                    id="admin_full_name" 
                    name="admin_full_name"
                    class="block mt-2 w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#8BB381] focus:border-transparent transition-all"
                    :value="old('admin_full_name')" 
                    placeholder="Your full name"
                />
                <x-input-error :messages="$errors->get('admin_full_name')" class="mt-2" />
            </div>
        </div>

        {{-- ================= PASSWORD FIELDS ================= --}}
        <div class="pt-4 border-t border-gray-100 space-y-4">
            <h3 class="text-sm font-semibold text-gray-700 mb-4">Security</h3>
            
            <div>
                <x-input-label for="password" value="Password" class="text-gray-700 font-medium" />
                <x-text-input 
                    id="password" 
                    name="password"
                    type="password"
                    class="block mt-2 w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#8BB381] focus:border-transparent transition-all"
                    placeholder="Create a strong password"
                    autocomplete="new-password" 
                    required 
                />
                <p class="mt-1 text-xs text-gray-500">Minimum 8 characters</p>
                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>

            <div>
                <x-input-label for="password_confirmation" value="Confirm Password" class="text-gray-700 font-medium" />
                <x-text-input 
                    id="password_confirmation"
                    name="password_confirmation"
                    type="password"
                    class="block mt-2 w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#8BB381] focus:border-transparent transition-all"
                    placeholder="Re-enter your password"
                    required 
                />
            </div>
        </div>

        {{-- ================= SUBMIT BUTTON ================= --}}
        <div class="pt-2">
            <button 
                type="submit"
                class="w-full px-6 py-3.5 bg-[#8BB381] hover:bg-[#7aa370] text-white font-semibold rounded-lg transition-all shadow-sm hover:shadow-md transform hover:-translate-y-0.5"
            >
                Create Account
            </button>
        </div>

        {{-- ================= LOGIN LINK ================= --}}
        <div class="text-center pt-4 border-t border-gray-100">
            <p class="text-sm text-gray-600">
                Already have an account?
                <a href="{{ route('login') }}" class="text-[#8BB381] hover:text-[#7aa370] font-semibold transition-colors">
                    Sign in instead
                </a>
            </p>
        </div>
    </form>

    {{-- ================= JAVASCRIPT FOR CONDITIONAL FIELDS ================= --}}
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const role = document.getElementById('role');
            const studentFields = document.getElementById('student-fields');
            const companyFields = document.getElementById('company-fields');
            const adminFields = document.getElementById('admin-fields');

            function setDisabled(container, disabled) {
                container.querySelectorAll('input, select, textarea').forEach(el => {
                    el.disabled = disabled;
                });
            }

            function toggleFields() {
                // Hide all sections
                studentFields.classList.add('hidden');
                companyFields.classList.add('hidden');
                adminFields.classList.add('hidden');

                // Disable all fields
                setDisabled(studentFields, true);
                setDisabled(companyFields, true);
                setDisabled(adminFields, true);

                // Show and enable based on selected role
                if (role.value === 'student') {
                    studentFields.classList.remove('hidden');
                    setDisabled(studentFields, false);
                } else if (role.value === 'company') {
                    companyFields.classList.remove('hidden');
                    setDisabled(companyFields, false);
                } else if (role.value === 'admin') {
                    adminFields.classList.remove('hidden');
                    setDisabled(adminFields, false);
                }
            }

            // Listen for role changes
            role.addEventListener('change', toggleFields);

            // Initialize on page load
            toggleFields();
        });
    </script>
</x-guest-layout>