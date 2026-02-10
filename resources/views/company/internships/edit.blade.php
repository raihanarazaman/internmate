<x-app-layout>
    <div class="py-12 bg-gray-100">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">

            <!-- Header -->
            <div class="mb-6">
                <h2 class="text-2xl font-bold text-gray-800">
                    Edit Internship
                </h2>
                <p class="text-gray-600 text-sm">
                    Update internship details.
                </p>
            </div>

            <!-- Errors -->
            @if ($errors->any())
                <div class="mb-6 p-4 bg-red-50 border border-red-200 rounded-lg">
                    <ul class="list-disc list-inside text-sm text-red-700">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="bg-white shadow rounded-lg p-6">
                <form method="POST"
                      action="{{ route('company.internships.update', $internship->id) }}">
                    @csrf
                    @method('PUT')

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                        <!-- Title -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700">
                                Internship Title
                            </label>
                            <input type="text" name="job_name"
                                   value="{{ old('job_name', $internship->job_name) }}"
                                   class="mt-1 w-full rounded border-gray-300">
                        </div>

                        <!-- Position -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700">
                                Position
                            </label>
                            <input type="text" name="position"
                                   value="{{ old('position', $internship->position) }}"
                                   class="mt-1 w-full rounded border-gray-300">
                        </div>

                        <!-- Course -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700">
                                Course Required
                            </label>
                            <select name="course_required"
                                    class="mt-1 w-full rounded border-gray-300">
                                @foreach(['Computer Science','Business Administration','Graphic Design'] as $course)
                                    <option value="{{ $course }}"
                                        @selected(old('course_required', $internship->course_required) === $course)>
                                        {{ $course }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Min CGPA -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700">
                                Minimum CGPA
                            </label>
                            <input type="number" step="0.01" name="min_cgpa"
                                   value="{{ old('min_cgpa', $internship->min_cgpa) }}"
                                   class="mt-1 w-full rounded border-gray-300">
                        </div>

                        <!-- Location -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700">
                                Location
                            </label>
                            <input type="text" name="location"
                                   value="{{ old('location', $internship->location) }}"
                                   class="mt-1 w-full rounded border-gray-300">
                        </div>

                        <!-- Duration -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700">
                                Duration
                            </label>
                            <input type="text" name="duration"
                                   value="{{ old('duration', $internship->duration) }}"
                                   class="mt-1 w-full rounded border-gray-300">
                        </div>

                        <!-- Allowance -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700">
                                Allowance (RM)
                            </label>
                            <input type="number" step="0.01" name="allowance"
                                   value="{{ old('allowance', $internship->allowance) }}"
                                   class="mt-1 w-full rounded border-gray-300">
                        </div>

                        <!-- Hostel -->
                        <div class="flex items-center mt-6">
                            <input type="checkbox" name="hostel_provided" value="1"
                                   @checked(old('hostel_provided', $internship->hostel_provided))
                                   class="rounded border-gray-300 text-blue-600">
                            <span class="ml-2 text-sm text-gray-700">
                                Hostel Provided
                            </span>
                        </div>
                    </div>

                    <!-- Description -->
                    <div class="mt-6">
                        <label class="block text-sm font-medium text-gray-700">
                            Internship Description
                        </label>
                        <textarea name="description" rows="4"
                                  class="mt-1 w-full rounded border-gray-300">{{ old('description', $internship->description) }}</textarea>
                    </div>

                    <!-- Job Scope -->
                    <div class="mt-6">
                        <label class="block text-sm font-medium text-gray-700">
                            Job Scope
                        </label>
                        <textarea name="job_scope" rows="4"
                                  class="mt-1 w-full rounded border-gray-300">{{ old('job_scope', $internship->job_scope) }}</textarea>
                    </div>

                    <!-- Actions -->
                    <div class="mt-8 flex justify-end space-x-3">
                        <a href="{{ route('company.internships.index') }}"
                           class="px-4 py-2 bg-gray-500 text-white rounded">
                            Cancel
                        </a>
                        <button type="submit"
                                class="px-5 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded shadow">
                            Update Internship
                        </button>
                    </div>

                </form>
            </div>
        </div>
    </div>
</x-app-layout>
