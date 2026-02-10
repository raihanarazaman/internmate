<x-app-layout>
    <div class="py-12 bg-gray-100">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <!-- Page Header -->
            <div class="flex justify-between items-center mb-6">
                <h2 class="text-2xl font-bold text-gray-800">
                    My Internships
                </h2>

                <a href="{{ route('company.internships.create') }}"
                   class="px-4 py-2 bg-green-600 hover:bg-green-700 text-white rounded-md shadow transition">
                    + Post Internship
                </a>
            </div>

            @if(session('success'))
                <div class="mb-4 p-4 bg-green-100 text-green-800 rounded">
                    {{ session('success') }}
                </div>
            @endif

            @if($internships->count())
                <div class="bg-white shadow rounded-lg overflow-hidden">
                    <table class="w-full text-sm">
                        <thead class="bg-gray-50 border-b">
                            <tr>
                                <th class="p-4 text-left">Title</th>
                                <th class="p-4 text-left">Position</th>
                                <th class="p-4 text-left">Location</th>
                                <th class="p-4 text-left">Duration</th>
                                <th class="p-4 text-left">Posted</th>
                                <th class="p-4 text-right">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($internships as $internship)
                                <tr class="border-b hover:bg-gray-50">
                                    <td class="p-4 font-medium text-gray-800">
                                        {{ $internship->title }}
                                    </td>

                                    <td class="p-4 text-gray-600">
                                        {{ $internship->position }}
                                    </td>

                                    <td class="p-4 text-gray-600">
                                        {{ $internship->location }}
                                    </td>

                                    <td class="p-4 text-gray-600">
                                        {{ $internship->duration }}
                                    </td>

                                    <td class="p-4 text-gray-500">
                                        {{ $internship->created_at->format('d M Y') }}
                                    </td>

                                    <td class="p-4 text-right space-x-2">
                                        <a href="{{ route('company.internships.edit', $internship->id) }}"
                                           class="px-3 py-1 bg-blue-600 hover:bg-blue-700 text-white rounded text-xs">
                                            Edit
                                        </a>

                                        <form method="POST"
                                              action="{{ route('company.internships.destroy', $internship->id) }}"
                                              class="inline"
                                              onsubmit="return confirm('Delete this internship?')">
                                            @csrf
                                            @method('DELETE')
                                            <button
                                                class="px-3 py-1 bg-red-600 hover:bg-red-700 text-white rounded text-xs">
                                                Delete
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <div class="bg-white p-6 rounded shadow text-center text-gray-600">
                    You haven’t posted any internships yet.
                </div>
            @endif

        </div>
    </div>
</x-app-layout>
