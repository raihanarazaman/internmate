<x-app-layout>
    <div class="py-12 bg-gray-100">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-10">

            {{-- ================= HEADER ================= --}}
            <div>
                <h1 class="text-2xl font-bold text-gray-800">
                    Admin Dashboard
                </h1>
                <p class="text-sm text-gray-600">
                    Manage students, internship postings, and approvals
                </p>
            </div>

            {{-- ================= NOTIFICATIONS ================= --}}
            @if($notifications->count())
                <div class="bg-white p-5 rounded-lg shadow">
                    <h3 class="font-semibold mb-3">🔔 Notifications</h3>

                    @foreach($notifications as $notif)
                        <div class="border-b py-2 flex justify-between items-center">
                            <span>{{ $notif->data['message'] }}</span>

                            <form method="POST"
                                  action="{{ route('admin.notifications.read', $notif->id) }}">
                                @csrf
                                @method('PUT')
                                <button class="text-sm text-blue-600 hover:underline">
                                    Mark read
                                </button>
                            </form>
                        </div>
                    @endforeach
                </div>
            @endif


            {{-- ================= STUDENT OVERVIEW ================= --}}
            <div class="bg-white rounded-lg shadow p-6">
                <h3 class="text-lg font-bold mb-4">
                    👩‍🎓 Student Overview
                </h3>

                <table class="w-full">
                    <thead class="border-b bg-gray-50">
                        <tr>
                            <th class="p-3 text-left">Student</th>
                            <th class="p-3 text-left">Course</th>
                            <th class="p-3 text-left">Applications</th>
                            <th class="p-3 text-left">Final Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($students as $student)
                            <tr class="border-b hover:bg-gray-50">
                                <td class="p-3">
                                    {{ $student->full_name }}
                                    <div class="text-sm text-gray-500">
                                        {{ $student->student_id }}
                                    </div>
                                </td>

                                <td class="p-3">
                                    {{ $student->course }}
                                </td>

                                <td class="p-3">
                                    {{ $student->applications_count }}
                                </td>

                                <td class="p-3">
                                    @if($student->admin_approved_count)
                                        <span class="text-green-600 font-semibold">
                                            Admin Approved
                                        </span>
                                    @else
                                        <span class="text-gray-500">
                                            Not Approved
                                        </span>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>


            {{-- ================= PENDING INTERNSHIPS ================= --}}
            <div class="bg-white rounded-lg shadow p-6">
                <h3 class="text-lg font-bold mb-4">
                    🏢 Internship Posts Pending Approval
                </h3>

                @if($pendingInternships->count())
                    <table class="w-full">
                        <thead class="border-b bg-gray-50">
                            <tr>
                                <th class="p-3 text-left">Company</th>
                                <th class="p-3 text-left">Internship</th>
                                <th class="p-3 text-left">Location</th>
                                <th class="p-3 text-left">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($pendingInternships as $internship)
                                <tr class="border-b hover:bg-gray-50">
                                    <td class="p-3">
                                        {{ $internship->company->company_name }}
                                    </td>

                                    <td class="p-3">
                                        {{ $internship->job_name }}
                                    </td>

                                    <td class="p-3">
                                        {{ $internship->location }}
                                    </td>

                                    <td class="p-3 space-x-2">
                                        <form method="POST"
                                              action="{{ route('admin.internships.approve', $internship->id) }}"
                                              class="inline">
                                            @csrf
                                            @method('PUT')
                                            <button
                                                class="px-3 py-1 bg-green-600 text-white rounded hover:bg-green-700">
                                                Approve
                                            </button>
                                        </form>

                                        <form method="POST"
                                              action="{{ route('admin.internships.reject', $internship->id) }}"
                                              class="inline">
                                            @csrf
                                            @method('PUT')
                                            <button
                                                class="px-3 py-1 bg-red-600 text-white rounded hover:bg-red-700">
                                                Reject
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @else
                    <p class="text-gray-600">
                        No internship posts awaiting approval.
                    </p>
                @endif
            </div>


            {{-- ================= STUDENT SUBMISSIONS ================= --}}
            <div class="bg-white rounded-lg shadow p-6">
                <h3 class="text-lg font-bold mb-4">
                    📄 Applications Pending Final Approval
                </h3>

                @if($applications->count())
                    <table class="w-full">
                        <thead class="border-b bg-gray-50">
                            <tr>
                                <th class="p-3 text-left">Student</th>
                                <th class="p-3 text-left">Company</th>
                                <th class="p-3 text-left">Internship</th>
                                <th class="p-3 text-left">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($applications as $app)
                                <tr class="border-b hover:bg-gray-50">
                                    <td class="p-3">
                                        {{ $app->student->full_name }}
                                    </td>

                                    <td class="p-3">
                                        {{ $app->internship->company->company_name }}
                                    </td>

                                    <td class="p-3">
                                        {{ $app->internship->job_name }}
                                    </td>

                                    <td class="p-3 space-x-2">
                                        <form method="POST"
                                              action="{{ route('admin.applications.approve', $app->id) }}"
                                              class="inline">
                                            @csrf
                                            @method('PUT')
                                            <button
                                                class="px-3 py-1 bg-green-600 text-white rounded hover:bg-green-700">
                                                Approve
                                            </button>
                                        </form>

                                        <form method="POST"
                                              action="{{ route('admin.applications.reject', $app->id) }}"
                                              class="inline">
                                            @csrf
                                            @method('PUT')
                                            <button
                                                class="px-3 py-1 bg-red-600 text-white rounded hover:bg-red-700">
                                                Reject
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @else
                    <p class="text-gray-600">
                        No applications awaiting final approval.
                    </p>
                @endif
            </div>

        </div>
    </div>
</x-app-layout>
