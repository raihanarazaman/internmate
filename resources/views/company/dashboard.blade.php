<x-app-layout>
    <div class="py-12 bg-green-50">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            {{-- PAGE TITLE --}}
            <div>
                <h1 class="text-2xl font-bold text-gray-800">Company Dashboard</h1>
                <p class="text-sm text-gray-600">
                    Overview of your internships and applications
                </p>
            </div>

            {{-- COMPANY SUMMARY --}}
            <div class="bg-white rounded-lg shadow p-6 flex justify-between items-center">
                <div>
                    <h2 class="text-lg font-semibold text-gray-800">
                        {{ $company->company_name }}
                    </h2>
                    <p class="text-gray-600">{{ $company->location }}</p>
                </div>

                <a href="{{ route('company.profile.edit') }}"
                   class="px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-md shadow transition">
                    Edit Profile
                </a>
            </div>

            {{-- QUICK STATS --}}
            <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                <div class="bg-white p-5 rounded-lg shadow">
                    <p class="text-sm text-gray-500">Internships Posted</p>
                    <p class="text-2xl font-bold text-gray-800">
                        {{ $stats['internships'] }}
                    </p>
                </div>

                <div class="bg-white p-5 rounded-lg shadow">
                    <p class="text-sm text-gray-500">Total Applications</p>
                    <p class="text-2xl font-bold text-gray-800">
                        {{ $stats['applications'] }}
                    </p>
                </div>

                <div class="bg-white p-5 rounded-lg shadow">
                    <p class="text-sm text-gray-500">Pending Decisions</p>
                    <p class="text-2xl font-bold text-orange-600">
                        {{ $stats['pending'] }}
                    </p>
                </div>
            </div>

            {{-- MAIN ACTIONS --}}
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

                {{-- MANAGE INTERNSHIPS --}}
                <a href="{{ route('company.internships.index') }}"
                   class="block bg-white rounded-lg shadow p-6 hover:shadow-lg transition">
                    <h3 class="text-lg font-semibold text-gray-800 mb-2">
                        Manage Internships
                    </h3>
                    <p class="text-sm text-gray-600">
                        View, edit, or delete internships you have posted.
                    </p>
                </a>

                {{-- VIEW APPLICATIONS --}}
                <a href="{{ route('company.applications.index') }}"
                   class="block bg-white rounded-lg shadow p-6 hover:shadow-lg transition">
                    <h3 class="text-lg font-semibold text-gray-800 mb-2">
                        View Applications
                    </h3>
                    <p class="text-sm text-gray-600">
                        Review students who applied to your internships.
                    </p>
                </a>

                {{-- POST INTERNSHIP --}}
                <a href="{{ route('company.internships.create') }}"
                   class="block bg-white rounded-lg shadow p-6 hover:shadow-lg transition">
                    <h3 class="text-lg font-semibold text-gray-800 mb-2">
                        Post New Internship
                    </h3>
                    <p class="text-sm text-gray-600">
                        Create a new internship opportunity for students.
                    </p>
                </a>
            </div>

        </div>
    </div>
</x-app-layout>
