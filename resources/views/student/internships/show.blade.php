<x-app-layout>
    <div class="py-12 bg-gray-100">
        <div class="max-w-5xl mx-auto space-y-6">

            {{-- HEADER --}}
            <div class="bg-white shadow rounded-lg p-6">
                <h1 class="text-2xl font-bold text-gray-800">
                    {{ $internship->job_name }}
                </h1>

                @if($internship->position)
                    <p class="text-gray-600 mt-1">
                        Position: {{ $internship->position }}
                    </p>
                @endif

                <p class="text-sm text-gray-500 mt-2">
                    {{ $internship->company->company_name }} • {{ $internship->location }}
                </p>
            </div>

            {{-- DETAILS GRID --}}
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

                {{-- MAIN CONTENT --}}
                <div class="md:col-span-2 bg-white shadow rounded-lg p-6 space-y-5">

                    <div>
                        <h3 class="font-semibold text-gray-800 mb-1">
                            Internship Description
                        </h3>
                        <p class="text-gray-700 whitespace-pre-line">
                            {{ $internship->description }}
                        </p>
                    </div>

                    <div>
                        <h3 class="font-semibold text-gray-800 mb-1">
                            Job Scope
                        </h3>
                        <p class="text-gray-700 whitespace-pre-line">
                            {{ $internship->job_scope }}
                        </p>
                    </div>

                    <div>
                        <h3 class="font-semibold text-gray-800 mb-1">
                            Requirements
                        </h3>
                        <p class="text-gray-700 whitespace-pre-line">
                            {{ $internship->requirements ?? 'No specific requirements listed.' }}
                        </p>
                    </div>

                </div>

                {{-- SIDEBAR --}}
                <div class="bg-white shadow rounded-lg p-6 space-y-4">

                    <h3 class="font-semibold text-gray-800">
                        Internship Info
                    </h3>

                    <div class="text-sm text-gray-700 space-y-2">
                        <p>
                            <strong>Course:</strong>
                            {{ $internship->course_required }}
                        </p>

                        <p>
                            <strong>Minimum CGPA:</strong>
                            {{ $internship->min_cgpa }}
                        </p>

                        <p>
                            <strong>Work Type:</strong>
                            {{ $internship->work_type ?? '—' }}
                        </p>

                        <p>
                            <strong>Duration:</strong>
                            {{ $internship->duration }}
                        </p>

                        <p>
                            <strong>Allowance:</strong>
                            RM{{ $internship->allowance ?? 'N/A' }}
                        </p>

                        <p>
                            <strong>Hostel Provided:</strong>
                            {{ $internship->hostel_provided ? 'Yes' : 'No' }}
                        </p>
                    </div>

                </div>
            </div>

            {{-- FOOTER ACTIONS --}}
            <div class="flex justify-between items-center">
                <a href="{{ route('student.internships.index') }}"
                   class="px-4 py-2 bg-gray-600 text-white rounded hover:bg-gray-700">
                    ← Back to Internships
                </a>

                {{-- APPLY BUTTON (optional – controlled by dashboard logic later) --}}
                @if(isset($canApply) && $canApply)
                    <form method="POST" action="{{ route('student.applications.store') }}">
                        @csrf
                        <input type="hidden" name="internship_id" value="{{ $internship->id }}">
                        <button
                            class="px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded">
                            Apply for Internship
                        </button>
                    </form>
                @endif
            </div>

        </div>
    </div>
</x-app-layout>