<x-app-layout>
    <div class="py-12 bg-gray-100">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8 space-y-6">

            {{-- HEADER --}}
            <div>
                <h1 class="text-2xl font-bold text-gray-800">
                    Internship Details
                </h1>
                <p class="text-sm text-gray-600">
                    Review internship and company information
                </p>
            </div>

            {{-- INTERNSHIP INFO --}}
            <div class="bg-white rounded-lg shadow p-6 space-y-4">
                <div>
                    <h2 class="text-xl font-semibold">
                        {{ $internship->job_name }}
                    </h2>
                    <p class="text-gray-600">
                        {{ $internship->location }} · {{ $internship->duration }}
                    </p>
                </div>

                <div>
                    <h3 class="font-semibold">Description</h3>
                    <p class="text-gray-700">
                        {{ $internship->description }}
                    </p>
                </div>

                <div>
                    <h3 class="font-semibold">Job Scope</h3>
                    <p class="text-gray-700">
                        {{ $internship->job_scope }}
                    </p>
                </div>

                @if($internship->requirements)
                    <div>
                        <h3 class="font-semibold">Requirements</h3>
                        <p class="text-gray-700">
                            {{ $internship->requirements }}
                        </p>
                    </div>
                @endif

                <div class="grid grid-cols-2 gap-4 text-sm text-gray-700">
                    <div>
                        <strong>Course Required:</strong>
                        {{ $internship->course_required }}
                    </div>
                    <div>
                        <strong>Min CGPA:</strong>
                        {{ $internship->min_cgpa }}
                    </div>
                    <div>
                        <strong>Allowance:</strong>
                        RM{{ $internship->allowance ?? 'N/A' }}
                    </div>
                    <div>
                        <strong>Hostel Provided:</strong>
                        {{ $internship->hostel_provided ? 'Yes' : 'No' }}
                    </div>
                </div>
            </div>

            {{-- COMPANY INFO --}}
            <div class="bg-white rounded-lg shadow p-6 space-y-2">
                <h3 class="text-lg font-semibold">
                    Company Information
                </h3>

                <p>
                    <strong>Name:</strong>
                    {{ $internship->company->company_name }}
                </p>

                <p>
                    <strong>Email:</strong>
                    {{ $internship->company->company_email }}
                </p>

                <p>
                    <strong>Location:</strong>
                    {{ $internship->company->location }}
                </p>
            </div>

            {{-- STUDENT APPLICATIONS --}}
            <div class="bg-white rounded-lg shadow p-6">
                <h3 class="text-lg font-semibold mb-4">
                    Students Applied
                </h3>

                @if($internship->applications->count())
                    <table class="w-full">
                        <thead class="border-b">
                            <tr>
                                <th class="p-3 text-left">Student</th>
                                <th class="p-3 text-left">Status</th>
                                <th class="p-3 text-left">Applied At</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($internship->applications as $app)
                                <tr class="border-b">
                                    <td class="p-3">
                                        {{ $app->student->full_name }}
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
                        No students have applied yet.
                    </p>
                @endif
            </div>

            {{-- BACK --}}
            <div>
                <a href="{{ route('admin.dashboard') }}"
                   class="text-blue-600 hover:underline text-sm">
                    ← Back to Admin Dashboard
                </a>
            </div>

        </div>
    </div>
</x-app-layout>
