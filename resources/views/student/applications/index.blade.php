<x-app-layout>
    <div class="py-12 bg-gray-100">
        <div class="max-w-6xl mx-auto bg-white shadow rounded-lg p-6">

            <h2 class="text-2xl font-bold mb-4">
                My Internship Applications
            </h2>

            @if($applications->count())
                <table class="w-full">
                    <thead class="border-b">
                        <tr>
                            <th class="p-3 text-left">Internship</th>
                            <th class="p-3 text-left">Company</th>
                            <th class="p-3 text-left">Status</th>
                            <th class="p-3 text-left">Actions</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach($applications as $app)
                            <tr class="border-b">
                                <td class="p-3">
                                    {{ $app->internship->job_name }}
                                </td>

                                <td class="p-3">
                                    {{ $app->internship->company->company_name }}
                                </td>

                                <td class="p-3 font-medium">
                                    @switch($app->status)
                                        @case('applied')
                                            <span class="text-gray-600">Applied</span>
                                            @break
                                        @case('company_approved')
                                            <span class="text-green-600">Company Approved</span>
                                            @break
                                        @case('student_submitted')
                                            <span class="text-indigo-600">Submitted to Admin</span>
                                            @break
                                        @case('admin_approved')
                                            <span class="text-blue-700">Admin Approved</span>
                                            @break
                                        @case('admin_rejected')
                                            <span class="text-red-600">Admin Rejected</span>
                                            @break
                                    @endswitch
                                </td>

                                <td class="p-3 space-x-2">
                                    <a href="{{ route('student.internships.show', $app->internship->id) }}"
                                       class="text-blue-600 underline">
                                        View
                                    </a>

                                    @if($app->status === 'company_approved')
                                        <form method="POST"
                                              action="{{ route('student.applications.submit', $app->id) }}"
                                              class="inline">
                                            @csrf
                                            <button class="px-3 py-1 bg-indigo-600 text-white rounded">
                                                Submit to Admin
                                            </button>
                                        </form>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                <p class="text-gray-600">You have not applied to any internships yet.</p>
            @endif

        </div>
    </div>
</x-app-layout>
