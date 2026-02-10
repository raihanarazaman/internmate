<x-app-layout>
    <div class="py-12 bg-gray-100">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8 space-y-6">

            {{-- HEADER --}}
            <div>
                <h1 class="text-2xl font-bold text-gray-800">
                    Student Profile
                </h1>
                <p class="text-sm text-gray-600">
                    Detailed student information
                </p>
            </div>

            {{-- BASIC INFO --}}
            <div class="bg-white rounded-lg shadow p-6 space-y-2">
                <p><strong>Student ID:</strong> {{ $student->student_id }}</p>
                <p><strong>Full Name:</strong> {{ $student->full_name }}</p>
                <p><strong>Course:</strong> {{ $student->course }}</p>
                <p><strong>CGPA:</strong> {{ $student->cgpa ?? '—' }}</p>
                <p><strong>Interests:</strong> {{ $student->interests ?? '—' }}</p>
            </div>

            {{-- APPLICATION HISTORY --}}
            <div class="bg-white rounded-lg shadow p-6">
                <h3 class="text-lg font-semibold mb-4">
                    Internship Applications
                </h3>

                @if($student->applications->count())
                    <table class="w-full">
                        <thead class="border-b">
                            <tr>
                                <th class="p-3 text-left">Internship</th>
                                <th class="p-3 text-left">Company</th>
                                <th class="p-3 text-left">Status</th>
                                <th class="p-3 text-left">Applied At</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($student->applications as $app)
                                <tr class="border-b">
                                    <td class="p-3">
                                        {{ $app->internship->job_name }}
                                    </td>
                                    <td class="p-3">
                                        {{ $app->internship->company->company_name }}
                                    </td>
                                    <td class="p-3 capitalize">
                                        {{ str_replace('_', ' ', $app->status) }}
                                    </td>
                                    <td class="p-3 text-sm text-gray-600">
                                        {{ $app->created_at->format('d M Y') }}
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @else
                    <p class="text-gray-600">
                        This student has not applied for any internships yet.
                    </p>
                @endif
            </div>

            {{-- BACK --}}
            <div>
                <a href="{{ url()->previous() }}"
                   class="text-blue-600 hover:underline text-sm">
                    ← Back
                </a>
            </div>

        </div>
    </div>
</x-app-layout>
