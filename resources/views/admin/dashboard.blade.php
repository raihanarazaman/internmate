<x-app-layout>
    <div class="py-12 bg-gray-100">
        @if($notifications->count())
    <div class="mb-6 bg-white p-4 rounded shadow">
        <h3 class="font-bold mb-3">Notifications</h3>

        @foreach($notifications as $notif)
            <div class="border-b py-2 flex justify-between">
                <span>{{ $notif->data['message'] }}</span>

                <form method="POST"
                    action="{{ route('admin.notifications.read', $notif->id) }}">
                    @csrf
                    @method('PUT')
                    <button class="text-sm text-blue-600 underline">
                        Mark read
                    </button>
                </form>
            </div>
        @endforeach
    </div>
@endif
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <h2 class="text-2xl font-bold mb-6">Admin Dashboard</h2>

            @if(session('success'))
                <div class="mb-4 p-4 bg-green-100 text-green-800 rounded">
                    {{ session('success') }}
                </div>
            @endif

            @if($applications->count())
                <table class="w-full bg-white shadow rounded-lg">
                    <thead>
                        <tr class="border-b">
                            <th class="p-3 text-left">Student</th>
                            <th class="p-3 text-left">Company</th>
                            <th class="p-3 text-left">Internship</th>
                            <th class="p-3 text-left">Status</th>
                            <th class="p-3 text-left">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($applications as $app)
                            <tr class="border-b">
                                <td class="p-3">
                                    {{ $app->student->full_name }}
                                </td>
                                <td class="p-3">
                                    {{ $app->internship->company->company_name }}
                                </td>
                                <td class="p-3">
                                    {{ $app->internship->job_name }}
                                </td>
                                <td class="p-3 font-semibold text-purple-600">
                                    Submitted
                                </td>
                                <td class="p-3 space-x-2">
                                    <form method="POST"
                                        action="{{ route('admin.applications.approve', $app->id) }}"
                                        class="inline">
                                        @csrf
                                        @method('PUT')
                                        <button class="px-3 py-1 bg-green-600 text-white rounded">
                                            Approve
                                        </button>
                                    </form>

                                    <form method="POST"
                                        action="{{ route('admin.applications.reject', $app->id) }}"
                                        class="inline">
                                        @csrf
                                        @method('PUT')
                                        <button class="px-3 py-1 bg-red-600 text-white rounded">
                                            Reject
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                <p class="text-gray-600">No applications submitted yet.</p>
            @endif

        </div>
    </div>
</x-app-layout>
