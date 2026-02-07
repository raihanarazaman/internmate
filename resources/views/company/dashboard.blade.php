<x-app-layout>
    <div class="py-12" style="background-color: #f0fdf4;">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <!-- Top Summary: Company Name + Location Only -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <div class="p-6">
                    <p><strong>Company:</strong> {{ session('company_name') }}</p>
                    <p><strong>Location:</strong> {{ session('location') }}</p>
                    
                    <div class="mt-4">
                        <button id="edit-profile-btn" 
                                class="px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-md shadow-md transition">
                            Edit Profile
                        </button>
                    </div>
                </div>
            </div>

            <!-- Full Edit Form (Hidden by default) -->
            <div id="edit-profile-form" class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6" style="display: none;">
                <div class="p-6">
                    <h3 class="text-lg font-bold mb-4">Edit Your Company Profile</h3>
                    <form method="POST" action="{{ route('company.update') }}">
                        @csrf
                        @method('PUT')
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Company Name</label>
                                <input type="text" name="company_name"
                                    value="{{ session('company_name') }}"
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" />
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Email</label>
                                <input type="email" name="email"
                                    value="{{ session('email') }}"
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" />
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Location</label>
                                <input type="text" name="location"
                                    value="{{ session('location') }}"
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" />
                            </div>
                        </div>
                        <div class="mt-6 flex space-x-3">
                            <button type="submit" class="px-5 py-2 bg-blue-700 hover:bg-blue-800 text-white font-medium rounded-lg shadow-md transition">
                                Save Changes
                            </button>
                            <button type="button" id="cancel-edit-btn" class="px-5 py-2 bg-gray-600 hover:bg-gray-700 text-white font-medium rounded-lg shadow-md transition">
                                Cancel
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Post Internship Toggle Button -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <div class="p-6">
                    <button id="post-internship-btn" 
                            class="px-4 py-2 bg-green-600 hover:bg-green-700 text-white rounded-md shadow-md transition">
                        + Post New Internship
                    </button>
                </div>
            </div>

            <!-- Post Internship Form (Hidden by default) -->
            <div id="post-internship-form" class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6" style="display: none;">
                <div class="p-6">
                    <h3 class="text-lg font-bold mb-4">Post New Internship</h3>
                    <form method="POST" action="{{ route('internships.store') }}">
                        @csrf
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Job Name</label>
                                <input type="text" name="job_name" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Course Required</label>
                                <select name="course_required" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                    <option value="">Select a course</option>
                                    <option value="Computer Science">Computer Science</option>
                                    <option value="Graphic Design">Graphic Design</option>
                                    <option value="Business Administration">Business Administration</option>
                                    <!-- Add more as needed -->
                                </select>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Min CGPA</label>
                                <input type="number" step="0.01" name="min_cgpa" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Location</label>
                                <input type="text" name="location" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Duration</label>
                                <input type="text" name="duration" placeholder="e.g., 3 months" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Allowance (RM)</label>
                                <input type="number" step="0.01" name="allowance" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                            </div>
                            <div class="md:col-span-2">
                                <label class="inline-flex items-center">
                                    <input type="checkbox" name="hostel_provided" value="1" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                    <span class="ml-2 text-sm text-gray-700">Hostel Provided?</span>
                                </label>
                            </div>
                        </div>
                        <div class="mt-4 flex space-x-2">
                            <button type="submit" class="px-4 py-2 bg-green-700 hover:bg-green-800 text-white rounded shadow-md transition">
                                Post Internship
                            </button>
                            <button type="button" id="cancel-post-btn" class="px-4 py-2 bg-gray-600 hover:bg-gray-700 text-white rounded shadow-md transition">
                                Cancel
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- In company/dashboard.blade.php -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <div class="p-6">
                    <h3 class="text-lg font-bold mb-4">Filter Applications by CGPA</h3>
                    <form method="GET" class="flex items-end space-x-3">
                        <div>
                            <label class="block text-sm text-gray-700">Min CGPA</label>
                            <input type="number" step="0.01" name="min_cgpa" value="{{ request('min_cgpa') }}" 
                                class="border border-gray-300 rounded px-3 py-1 w-24">
                        </div>
                        <div>
                            <label class="block text-sm text-gray-700">Max CGPA</label>
                            <input type="number" step="0.01" name="max_cgpa" value="{{ request('max_cgpa') }}" 
                                class="border border-gray-300 rounded px-3 py-1 w-24">
                        </div>
                        <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">Filter</button>
                        @if(request()->has('min_cgpa') || request()->has('max_cgpa'))
                            <a href="{{ route('company.dashboard') }}" class="px-4 py-2 bg-gray-500 text-white rounded">Clear</a>
                        @endif
                    </form>
                </div>
            </div>

            <!-- Manage Applications -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <h3 class="text-lg font-bold mb-4">Manage Applications</h3>
                    @if(isset($applications) && $applications->count())
                        <table class="w-full">
                            <thead>
                                <tr class="text-left border-b">
                                    <th class="pb-2">Student ID</th>
                                    <th class="pb-2">Internship</th>
                                    <th class="pb-2">Status</th>
                                    <th class="pb-2">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($applications as $app)
                                <tr class="border-b">
                                    <td class="py-2">{{ $app->student->student_id }}</td>
                                    <td class="py-2">{{ $app->internship->job_name }}</td>
                                    <td class="py-2">{{ ucfirst($app->status) }}</td>
                                    <td class="py-2">
                                        @if($app->status === 'pending')
                                            <form method="POST" action="{{ route('applications.update', $app->id) }}" class="inline">
                                                @csrf
                                                @method('PUT')
                                                <input type="hidden" name="status" value="approved">
                                                <button type="submit" class="px-4 py-2 bg-green-600 hover:bg-green-700 text-white font-semibold rounded-lg shadow-md transition transform hover:scale-105 ml-2">
                                                    Approve
                                                </button>
                                            </form>
                                            <form method="POST" action="{{ route('applications.destroy', $app->id) }}" class="inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="px-4 py-2 bg-red-600 hover:bg-red-700 text-white font-semibold rounded-lg shadow-md transition transform hover:scale-105 ml-2"
                                                        onclick="return confirm('Are you sure you want to reject this application?')">
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
                        <p>No applications yet.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>

    {{-- 🔥 ADD THIS LINE TO INCLUDE THE CHATBOX --}}
    <x-ai-chatbox />

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const chatbox = document.getElementById('ai-chatbox');
            const messagesContainer = document.getElementById('chat-messages');
            const userInput = document.getElementById('user-message');
            const sendBtn = document.getElementById('send-message');
            const aiReplyBtn = document.getElementById('ai-smart-reply');
            const closeBtn = document.getElementById('close-chat');
            const loadingIndicator = document.getElementById('loading-indicator');

            // Toggle Post Internship Form
            const postBtn = document.getElementById('post-internship-btn');
            const postForm = document.getElementById('post-internship-form');
            const cancelPostBtn = document.getElementById('cancel-post-btn');

            if (postBtn && postForm && cancelPostBtn) {
                postBtn.addEventListener('click', () => {
                    postForm.style.display = 'block';
                    postBtn.style.display = 'none';
                });

                cancelPostBtn.addEventListener('click', () => {
                    postForm.style.display = 'none';
                    postBtn.style.display = 'block';
                });
            }

            // Toggle Edit Profile Form
            const editBtn = document.getElementById('edit-profile-btn');
            const editForm = document.getElementById('edit-profile-form');
            const cancelEditBtn = document.getElementById('cancel-edit-btn');

            if (editBtn && editForm && cancelEditBtn) {
                editBtn.addEventListener('click', () => {
                    editForm.style.display = 'block';
                    editBtn.style.display = 'none';
                });

                cancelEditBtn.addEventListener('click', () => {
                    editForm.style.display = 'none';
                    editBtn.style.display = 'block';
                });
            }

            // Toggle chatbox on logo click
            const logoTrigger = document.getElementById('logo-trigger');
            if (logoTrigger) {
                logoTrigger.addEventListener('click', function(e) {
                    e.preventDefault(); // Optional: prevent navigation if you want modal-only behavior
                    chatbox.classList.toggle('hidden');
                    if (!chatbox.classList.contains('hidden')) {
                        userInput.focus();
                    }
                });
            }

            // Close chatbox
            closeBtn.addEventListener('click', () => {
                chatbox.classList.add('hidden');
            });

            // Send message
            function sendMessage() {
                const message = userInput.value.trim();
                if (!message) return;

                addMessage(message, 'user');
                userInput.value = '';
                loadingIndicator.classList.remove('hidden');

                fetch("{{ route('ai.chat') }}", {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({ message })
                })
                .then(response => response.json())
                .then(data => {
                    loadingIndicator.classList.add('hidden');
                    if (data.success) {
                        addMessage(data.reply, 'ai');
                    } else {
                        addMessage("Sorry, I couldn't process your request.", 'ai');
                    }
                })
                .catch(() => {
                    loadingIndicator.classList.add('hidden');
                    addMessage("Something went wrong. Please try again.", 'ai');
                });
            }

            sendBtn.addEventListener('click', sendMessage);
            userInput.addEventListener('keypress', e => {
                if (e.key === 'Enter') sendMessage();
            });

            // AI Smart Reply
            aiReplyBtn.addEventListener('click', () => {
                const lastUserMsg = Array.from(messagesContainer.children)
                    .filter(el => el.dataset.role === 'user')
                    .pop();

                if (!lastUserMsg) {
                    addMessage("Please send a message first!", 'ai');
                    return;
                }

                const prompt = lastUserMsg.textContent.trim();
                loadingIndicator.classList.remove('hidden');

                fetch("{{ route('ai.chat') }}", {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({ message: prompt })
                })
                .then(response => response.json())
                .then(data => {
                    loadingIndicator.classList.add('hidden');
                    if (data.success) {
                        addMessage(data.reply, 'ai');
                    } else {
                        addMessage("Sorry, I couldn't generate a smart reply.", 'ai');
                    }
                })
                .catch(() => {
                    loadingIndicator.classList.add('hidden');
                    addMessage("Something went wrong. Please try again.", 'ai');
                });
            });

            function addMessage(text, role) {
                const msgDiv = document.createElement('div');
                msgDiv.className = `flex ${role === 'user' ? 'justify-end' : 'justify-start'} mb-2`;
                msgDiv.innerHTML = `
                    <div class="max-w-xs px-4 py-2 rounded-lg ${
                        role === 'user'
                            ? 'bg-blue-600 text-white'
                            : 'bg-gray-100 text-gray-800 border border-gray-200'
                    }">
                        ${text}
                    </div>
                `;
                msgDiv.dataset.role = role;
                messagesContainer.appendChild(msgDiv);
                messagesContainer.scrollTop = messagesContainer.scrollHeight;
            }
        });
    </script>
</x-app-layout>