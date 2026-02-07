<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Profile</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet"></head>

    <body class="bg-gray-100">
    <div class="max-w-4xl mx-auto px-4 py-8">
        <h1 class="text-2xl font-bold mb-6">Edit Your Profile</h1>

        <!-- ✅ FORM START -->
        <form method="POST" action="{{ route('student.update') }}">
            @csrf
            @method('PUT')

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                <div>
                    <label for="student_id" class="block text-sm font-medium mb-1">Student ID</label>
                    <input type="text" id="student_id" name="student_id" value="{{ old('student_id', $student->student_id) }}" 
                           class="w-full rounded border-gray-300" required>
                </div>

                <div>
                    <label for="full_name" class="block text-sm font-medium mb-1">Full Name</label>
                    <input type="text" id="full_name" name="full_name" value="{{ old('full_name', $student->full_name) }}" 
                           class="w-full rounded border-gray-300" required>
                </div>

                <div>
                    <label for="course" class="block text-sm font-medium mb-1">Course</label>
                    <input type="text" id="course" name="course" value="{{ old('course', $student->course) }}" 
                           class="w-full rounded border-gray-300" required>
                </div>

                <div>
                    <label for="cgpa" class="block text-sm font-medium mb-1">CGPA (0.00-4.00)</label>
                    <input type="number" step="0.01" min="0" max="4" id="cgpa" name="cgpa" 
                           value="{{ old('cgpa', $student->cgpa) }}" 
                           class="w-full rounded border-gray-300">
                </div>

                <div class="md:col-span-2">
                    <label for="interests" class="block text-sm font-medium mb-1">Interests</label>
                    <input type="text" id="interests" name="interests" value="{{ old('interests', $student->interests) }}" 
                           class="w-full rounded border-gray-300" placeholder="e.g., design,coding">
                </div>
            </div>

            <div class="flex space-x-3">
                <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
                    Save Changes
                </button>
                <a href="{{ route('student.dashboard') }}" class="px-4 py-2 bg-gray-500 text-white rounded hover:bg-gray-600">
                    Cancel
                </a>
            </div>
        </form>
        <!-- ✅ FORM END -->

    </div>
</body>
</html>