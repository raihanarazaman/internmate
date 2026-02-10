<x-app-layout>
    <div class="py-12 bg-green-50">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">

            <h1 class="text-2xl font-bold mb-6">Company Profile</h1>

            @if(session('success'))
                <div class="mb-4 p-4 bg-green-100 text-green-800 rounded">
                    {{ session('success') }}
                </div>
            @endif

            <div class="bg-white rounded-lg shadow p-6">
                <form method="POST" action="{{ route('company.profile.update') }}">
                    @csrf
                    @method('PUT')

                    <div class="space-y-4">

                        <div>
                            <label class="block text-sm font-medium text-gray-700">
                                Company Name
                            </label>
                            <input type="text" name="company_name"
                                   value="{{ old('company_name', $company->company_name) }}"
                                   class="mt-1 w-full rounded-md border-gray-300 shadow-sm">
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700">
                                Company Email
                            </label>
                            <input type="email" name="company_email"
                                   value="{{ old('company_email', $company->company_email) }}"
                                   class="mt-1 w-full rounded-md border-gray-300 shadow-sm">
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700">
                                Location
                            </label>
                            <input type="text" name="location"
                                   value="{{ old('location', $company->location) }}"
                                   class="mt-1 w-full rounded-md border-gray-300 shadow-sm">
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700">
                                Company Description
                            </label>
                            <textarea name="description" rows="4"
                                class="mt-1 w-full rounded-md border-gray-300 shadow-sm">{{ old('description', $company->description) }}</textarea>
                        </div>

                        <div class="flex justify-end space-x-3 pt-4">
                            <a href="{{ route('company.dashboard') }}"
                               class="px-4 py-2 bg-gray-500 text-white rounded-md">
                                Cancel
                            </a>

                            <button type="submit"
                                class="px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-md">
                                Save Changes
                            </button>
                        </div>

                    </div>
                </form>
            </div>

        </div>
    </div>
</x-app-layout>
