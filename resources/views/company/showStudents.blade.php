<x-app-layout>
    <div class="py-12 bg-gray-100">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">

            <div class="mb-6">
                <h2 class="text-2xl font-bold text-gray-800">
                    Student Profile
                </h2>
            </div>

            <div class="bg-white shadow rounded-lg p-6 mb-6">
                <h3 class="text-lg font-semibold mb-4">
                    Basic Information
                </h3>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <p><strong>Student ID:</strong> {{ $student->student_id }}</p>
                    <p><strong>Full Name:</strong> {{ $student->full_name }}</p>
                    <p><strong>Course:</strong> {{ $student->course }}</p>
                    <p><strong>CGPA:</strong> {{ $student->cgpa ?? '—' }}</p>
                </div>

                <div class="mt-4">
                    <p><strong>Interests:</strong></p>
                    <p class="text-gray-700 mt-1">
                        {{ $student->interests ?? '—' }}
                    </p>
                </div>
            </div>

            <div class="bg-white shadow rounded-lg p-6">
                <h3 class="text-lg font-semibold mb-4">
                    Internship Applications (Your Company)
                </h3>

                <table class="w-full">
                    <thead>
                        <tr class="border-b text-left">
                            <th class="pb-2">Internship</th>
                            <th class="pb-2">Status</th>
                            <th class="pb-2">Applied At</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach(
                            $student->applications->filter(fn($app) =>
                                $app->internship->company->user_id === auth()->id()
                            ) as $app
                        )
                            <tr class="border-b">
                                <td class="py-2">
                                    {{ $app->internship->title }}
                                </td>
                                <td class="py-2">
                                    <span class="capitalize">
                                        {{ str_replace('_', ' ', $app->status) }}
                                    </span>
                                </td>
                                <td class="py-2 text-sm text-gray-600">
                                    {{ $app->created_at->format('d M Y') }}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="mt-6">
                <a href="{{ route('company.dashboard') }}"
                   class="px-4 py-2 bg-gray-600 text-white rounded">
                    Back to Dashboard
                </a>
            </div>

        </div>
    </div>
</x-app-layout>
