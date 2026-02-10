<x-app-layout>
    <div class="py-12 bg-green-50">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            {{-- PAGE HEADER --}}
            <div>
                <h1 class="text-2xl font-bold text-gray-800">
                    Student Dashboard
                </h1>
                <p class="text-sm text-gray-600">
                    Welcome back, {{ $student->full_name }}
                </p>
            </div>

            {{-- PROFILE SUMMARY --}}
            <div class="bg-white rounded-lg shadow p-6 flex justify-between items-center">
                <div>
                    <p class="text-lg font-semibold text-gray-800">
                        {{ $student->full_name }}
                    </p>
                    <p class="text-sm text-gray-600">
                        {{ $student->student_id }} • {{ $student->course }}
                    </p>
                    <p class="text-sm text-gray-600">
                        CGPA: {{ $student->cgpa ?? '—' }}
                    </p>
                </div>

                <a href="{{ route('student.profile') }}"
                   class="px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-md shadow transition">
                    Edit Profile
                </a>
            </div>

            {{-- QUICK STATS --}}
            <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                <div class="bg-white p-5 rounded-lg shadow">
                    <p class="text-sm text-gray-500">Applications Submitted</p>
                    <p class="text-2xl font-bold text-gray-800">
                        {{ $stats['total_applications'] }}
                    </p>
                </div>

                <div class="bg-white p-5 rounded-lg shadow">
                    <p class="text-sm text-gray-500">Company Approved</p>
                    <p class="text-2xl font-bold text-green-600">
                        {{ $stats['company_approved'] }}
                    </p>
                </div>

                <div class="bg-white p-5 rounded-lg shadow">
                    <p class="text-sm text-gray-500">Final Approved</p>
                    <p class="text-2xl font-bold text-blue-700">
                        {{ $stats['admin_approved'] }}
                    </p>
                </div>
            </div>

            {{-- MAIN ACTIONS --}}
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

                {{-- BROWSE INTERNSHIPS --}}
                <a href="{{ route('student.internships.index') }}"
                   class="block bg-white rounded-lg shadow p-6 hover:shadow-lg transition">
                    <h3 class="text-lg font-semibold text-gray-800 mb-2">
                        Browse Internships
                    </h3>
                    <p class="text-sm text-gray-600">
                        View available internships and apply.
                    </p>
                </a>

                {{-- MY APPLICATIONS --}}
                <a href="{{ route('student.applications.index') }}"
                   class="block bg-white rounded-lg shadow p-6 hover:shadow-lg transition">
                    <h3 class="text-lg font-semibold text-gray-800 mb-2">
                        My Applications
                    </h3>
                    <p class="text-sm text-gray-600">
                        Track your application status and submit offers to admin.
                    </p>
                </a>

                {{-- NOTIFICATIONS --}}
                <a href="{{ route('notifications.index') }}"
                   class="block bg-white rounded-lg shadow p-6 hover:shadow-lg transition">
                    <h3 class="text-lg font-semibold text-gray-800 mb-2">
                        Notifications
                    </h3>
                    <p class="text-sm text-gray-600">
                        View updates from companies and admin.
                    </p>
                </a>
            </div>

        </div>
    </div>
</x-app-layout>
