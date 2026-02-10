<x-app-layout>
    <div class="py-12 bg-gray-100">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="mb-6">
                <h2 class="text-2xl font-bold text-gray-800">
                    Internship Applications
                </h2>
                <p class="text-sm text-gray-600">
                    Review and manage student applications
                </p>
            </div>

            <div class="bg-white shadow rounded-lg overflow-hidden">
                @if($applications->count())
                    <table class="w-full">
                        <thead class="bg-gray-50 border-b">
                            <tr>
                                <th class="p-4 text-left">Student</th>
                                <th class="p-4 text-left">Internship</th>
                                <th class="p-4 text-left">Status</th>
                                <th class="p-4 text-left">Applied At</th>
                                <th class="p-4 text-left">Actions</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach($applications as $app)
                                <tr class="border-b hover:bg-gray-50">
                                <td class="p-4">
                                    <div class="font-medium text-gray-800">
                                        {{ $app->student->full_name }}
                                    </div>
                                    <div class="text-sm text-gray-500">
                                        {{ $app->student->student_id }}
                                    </div>
                                </td>

                                    <td class="p-4">
                                        {{ $app->internship->job_name }}
                                    </td>

                                    <td class="p-4">
                                        <span class="capitalize">
                                            {{ str_replace('_', ' ', $app->status) }}
                                        </span>
                                    </td>

                                    <td class="p-4 text-sm text-gray-600">
                                        {{ $app->created_at->format('d M Y') }}
                                    </td>

                                    <td class="p-4">
                                         {{-- VIEW PROFILE --}}
                                        <a href="{{ route('company.students.show', $app->student) }}"
                                        class="inline-block px-3 py-1 bg-blue-600 text-white rounded hover:bg-blue-700 text-sm">
                                            View Profile
                                        </a>
                                        @if($app->status === 'applied')
        {{-- APPROVE --}}
                                            <form method="POST"
                                                action="{{ route('company.applications.update', $app) }}"
                                                class="inline">
                                                @csrf
                                                @method('PUT')
                                                <input type="hidden" name="status" value="company_approved">
                                                <button
                                                    class="px-3 py-1 bg-green-600 text-white rounded hover:bg-green-700 text-sm">
                                                    Approve
                                                </button>
                                            </form>

                                            {{-- REJECT --}}
                                            <form method="POST"
                                                action="{{ route('company.applications.update', $app) }}"
                                                class="inline">
                                                @csrf
                                                @method('PUT')
                                                <input type="hidden" name="status" value="company_rejected">
                                                <button
                                                    class="px-3 py-1 bg-red-600 text-white rounded hover:bg-red-700 text-sm"
                                                    onclick="return confirm('Reject this application?')">
                                                    Reject
                                                </button>
                                            </form>
                                        @endif
                                        
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @else
                    <div class="p-6 text-gray-600">
                        No applications yet.
                    </div>
                @endif
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
