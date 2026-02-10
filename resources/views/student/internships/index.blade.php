<x-app-layout>
    <div class="py-12 bg-green-50">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            {{-- PAGE HEADER --}}
            <div>
                <h1 class="text-2xl font-bold text-gray-800">
                    Browse Internships
                </h1>
                <p class="text-sm text-gray-600">
                    Explore internship opportunities and apply
                </p>
            </div>

            {{-- FINAL APPROVAL WARNING --}}
            @if($hasFinalApproval)
                <div class="bg-green-100 border-l-4 border-green-500 p-4 rounded">
                    <p class="font-semibold text-green-800">
                        ✅ You already have an admin-approved internship.
                    </p>
                    <p class="text-sm text-green-700">
                        You can view internships, but you cannot apply for new ones.
                    </p>
                </div>
            @endif
             {{-- FILTERS --}}
<div class="bg-white rounded-lg shadow p-6">
    <h2 class="text-lg font-semibold mb-4">
        Filter Internships
    </h2>

    <form method="GET" class="flex flex-wrap gap-4 items-end">

        {{-- COURSE --}}
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">
                Course
            </label>
            <select name="course"
                    class="border border-gray-300 rounded px-3 py-2">
                <option value="">All Courses</option>
                <option value="Computer Science"
                    {{ request('course') === 'Computer Science' ? 'selected' : '' }}>
                    Computer Science
                </option>
                <option value="Graphic Design"
                    {{ request('course') === 'Graphic Design' ? 'selected' : '' }}>
                    Graphic Design
                </option>
                <option value="Business Administration"
                    {{ request('course') === 'Business Administration' ? 'selected' : '' }}>
                    Business Administration
                </option>
            </select>
        </div>

        {{-- LOCATION --}}
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">
                Location
            </label>
            <input type="text"
                   name="location"
                   value="{{ request('location') }}"
                   placeholder="e.g. Kuala Lumpur"
                   class="border border-gray-300 rounded px-3 py-2">
        </div>

        {{-- ACTIONS --}}
        <div class="flex gap-2">
            <button type="submit"
                class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
                Filter
            </button>

            @if(request()->hasAny(['course', 'location']))
                <a href="{{ route('student.internships.index') }}"
                   class="px-4 py-2 bg-gray-500 text-white rounded">
                    Clear
                </a>
            @endif
        </div>

    </form>
</div>       
            {{-- INTERNSHIP LIST --}}
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                @forelse($internships as $internship)
                    <div class="bg-white rounded-lg shadow p-6 flex flex-col justify-between">

                        {{-- HEADER --}}
                        <div>
                            <h3 class="text-lg font-semibold text-gray-800">
                                {{ $internship->job_name }}
                            </h3>

                            <p class="text-sm text-gray-600 mt-1">
                                {{ $internship->company->company_name }}
                                · {{ $internship->location }}
                            </p>

                            <p class="text-sm text-gray-500 mt-2">
                                Course: {{ $internship->course_required }}
                                · Min CGPA: {{ $internship->min_cgpa }}
                            </p>

                            {{-- DESCRIPTION --}}
                            <div class="mt-4 text-sm text-gray-700 space-y-2">
                                <p><strong>Description:</strong></p>
                                <p>{{ $internship->description }}</p>

                                <p><strong>Job Scope:</strong></p>
                                <p>{{ $internship->job_scope }}</p>

                                @if($internship->requirements)
                                    <p><strong>Requirements:</strong></p>
                                    <p>{{ $internship->requirements }}</p>
                                @endif
                            </div>
                        </div>

                        {{-- ACTIONS --}}
                        <div class="mt-6">
                            @if($hasFinalApproval)
                                <span class="text-sm text-gray-500 italic">
                                    Application locked
                                </span>

                            @elseif($appliedInternshipIds->contains($internship->id))
                                <span class="inline-block px-3 py-1 bg-gray-200 text-gray-600 rounded text-sm">
                                    Applied
                                </span>

                            @else
                                <form method="POST"
                                      action="{{ route('student.applications.store') }}"
                                      onsubmit="return confirm('Apply for this internship?')">
                                    @csrf
                                    <input type="hidden" name="internship_id"
                                           value="{{ $internship->id }}">

                                    <button
                                        class="px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded shadow">
                                        Apply
                                    </button>
                                </form>
                            @endif
                        </div>
                    </div>
                @empty
                    <div class="text-gray-600">
                        No internships available at the moment.
                    </div>
                @endforelse
            </div>

            {{-- BACK --}}
            <div>
                <a href="{{ route('student.dashboard') }}"
                   class="text-sm text-blue-600 hover:underline">
                    ← Back to Dashboard
                </a>
            </div>

        </div>
    </div>
</x-app-layout>
