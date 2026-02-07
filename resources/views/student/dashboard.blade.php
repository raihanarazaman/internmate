<!-- Notifications -->
@if(isset($notifications) && $notifications->count())
    <div class="mb-6">
        @foreach($notifications as $notif)
            <div class="bg-blue-100 border-l-4 border-blue-500 text-blue-700 p-4 mb-2 rounded">
                <div class="flex justify-between">
                    <span>{{ $notif->message }}</span>
                    <form method="POST" action="{{ route('notifications.mark-read', $notif->id) }}" class="inline">
                        @csrf
                        @method('PUT')
                        <button type="submit" class="text-sm underline">Mark as read</button>
                    </form>
                </div>
            </div>
        @endforeach
    </div>
@endif
<x-app-layout>
    <div class="py-12" style="background-color: #f0fdf4;">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <!-- Profile Section -->
            <div class="bg-white rounded-lg shadow p-6 mb-6">
                <h2 class="text-lg font-semibold mb-4">Your Profile</h2>
                <p><strong>ID:</strong> {{ session('student_id') }}</p>
                <p><strong>Name:</strong> {{ session('student_name') }}</p>
                <p><strong>Course:</strong> {{ session('course') }}</p>
                <p><strong>CGPA:</strong> {{ session('cgpa') }}</p>
                <p><strong>Interests:</strong> {{ session('interests') }}</p>

                <a href="{{ route('student.profile') }}" class="mt-4 inline-block px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-md shadow-md transition">
                    Edit Profile
                </a>
            </div>

           <!-- In student/dashboard.blade.php -->
<div class="bg-white rounded-lg shadow p-6 mb-6">
    <h2 class="text-lg font-semibold mb-4">Filter Internships</h2>
    <form method="GET" class="flex flex-wrap gap-3 items-end">
        <!-- Course Filter -->
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Course</label>
            <select name="course" class="border border-gray-300 rounded px-3 py-2">
                <option value="">All Courses</option>
                <option value="Computer Science" {{ request('course') == 'Computer Science' ? 'selected' : '' }}>Computer Science</option>
                <option value="Graphic Design" {{ request('course') == 'Graphic Design' ? 'selected' : '' }}>Graphic Design</option>
                <option value="Business Administration" {{ request('course') == 'Business Administration' ? 'selected' : '' }}>Business Administration</option>
            </select>
        </div>

        <!-- Location Filter -->
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Location</label>
            <select name="location" class="border border-gray-300 rounded px-3 py-2">
                <option value="">All Locations</option>
                <option value="Kuala Lumpur" {{ request('location') == 'Kuala Lumpur' ? 'selected' : '' }}>Kuala Lumpur</option>
                <option value="Petaling Jaya" {{ request('location') == 'Petaling Jaya' ? 'selected' : '' }}>Petaling Jaya</option>
                <option value="Shah Alam" {{ request('location') == 'Shah Alam' ? 'selected' : '' }}>Shah Alam</option>
                <option value="Cyberjaya" {{ request('location') == 'Cyberjaya' ? 'selected' : '' }}>Cyberjaya</option>
                <option value="Johor Bahru" {{ request('location') == 'Johor Bahru' ? 'selected' : '' }}>Johor Bahru</option>
                <option value="Penang" {{ request('location') == 'Penang' ? 'selected' : '' }}>Penang</option>
                <option value="Ipoh" {{ request('location') == 'Ipoh' ? 'selected' : '' }}>Ipoh</option>
                <option value="Kuching" {{ request('location') == 'Kuching' ? 'selected' : '' }}>Kuching</option>
                <option value="Kota Kinabalu" {{ request('location') == 'Kota Kinabalu' ? 'selected' : '' }}>Kota Kinabalu</option>
                <option value="Melaka" {{ request('location') == 'Melaka' ? 'selected' : '' }}>Melaka</option>
            </select>
        </div>

        <!-- Submit & Clear Buttons -->
        <div class="flex space-x-2">
            <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">Filter</button>
            @if(request()->has('course') || request()->has('location'))
                <a href="{{ route('student.dashboard') }}" class="px-4 py-2 bg-gray-500 text-white rounded">Clear</a>
            @endif
        </div>
    </form>
</div>


            <!-- Available Internships Section -->
<div class="bg-white rounded-lg shadow p-6">
    <h2 class="text-lg font-semibold mb-4">Available Internships</h2>

    @if($hasApprovedApplication)
        <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-4 rounded">
            <p class="font-bold">✅ You already have an approved internship!</p>
            <p class="mt-2">You cannot apply for new internships.</p>
            
            @if(isset($approvedInternship))
                <div class="mt-3 p-3 bg-white border border-gray-200 rounded">
                    <h3 class="font-bold">{{ $approvedInternship->internship->job_name }}</h3>
                    <p class="text-sm text-gray-600">Company: {{ $approvedInternship->internship->company->name }}</p>
                    <p class="text-sm text-gray-600">Location: {{ $approvedInternship->internship->location }}</p>
                    <p class="text-sm text-gray-600">Status: <span class="text-green-600 font-medium">Approved</span></p>
                </div>
            @endif
        </div>
    @else
        @if(isset($internships) && $internships->count())
            <div class="space-y-4">
                @foreach($internships as $job)
                    <div class="border-b pb-4 last:border-0 last:pb-0">
                        <div class="flex justify-between items-start">
                            <div>
                                <h3 class="font-bold text-gray-800">{{ $job->job_name }}</h3>
                                <p class="text-sm text-gray-600">{{ $job->location }}</p>
                                <p class="text-sm text-gray-500 mt-1">
                                    Min CGPA: {{ $job->min_cgpa }},
                                    Allowance: RM{{ $job->allowance ?? 'N/A' }}
                                </p>
                                @if($job->hostel_provided)
                                    <span class="inline-block mt-1 px-2 py-0.5 bg-green-100 text-green-800 text-xs rounded">Hostel Provided</span>
                                @endif
                            </div>
                            <div>
                                @php
                                    $hasApplied = $appliedInternshipIds->contains($job->id);
                                @endphp

                                @if($hasApplied)
                                    <span class="px-3 py-1 bg-gray-200 text-gray-600 text-sm rounded-md">Applied</span>
                                @else
                                    <form method="POST" action="{{ route('applications.store') }}" class="inline">
                                        @csrf
                                        <input type="hidden" name="internship_id" value="{{ $job->id }}">
                                        <button type="submit"
                                            class="px-4 py-1.5 bg-blue-600 hover:bg-blue-700 text-white text-sm rounded-md shadow transition"
                                            onclick="return confirm('Apply for this internship?')">
                                            Apply
                                        </button>
                                    </form>
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <p>No internships available yet.</p>
        @endif
    @endif
</div>
        </div>
    </div>

    {{-- AI Chatbox Component --}}
    <x-ai-chatbox />

    {{-- JavaScript for Chatbox --}}
    <script>
document.addEventListener('DOMContentLoaded', function() {
    const chatbox = document.getElementById('ai-chatbox');
    const messagesContainer = document.getElementById('chat-messages');
    const userInput = document.getElementById('user-message');
    const sendBtn = document.getElementById('send-message');
    const aiReplyBtn = document.getElementById('ai-smart-reply');
    const closeBtn = document.getElementById('close-chat');
    const loadingIndicator = document.getElementById('loading-indicator');

    // Toggle chatbox on logo click
    const logoTrigger = document.getElementById('logo-trigger');
    if (logoTrigger) {
        logoTrigger.addEventListener('click', function(e) {
            e.preventDefault(); // Prevent navigation if needed
            chatbox.classList.toggle('hidden');
            if (!chatbox.classList.contains('hidden')) {
                // Focus input when chat opens
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

<x-ai-chatbox />

<script>
document.addEventListener('DOMContentLoaded', function() {
    const chatbox = document.getElementById('ai-chatbox');
    const logo = document.getElementById('logo-trigger');

    if (logo && chatbox) {
        logo.addEventListener('click', (e) => {
            e.preventDefault();
            chatbox.classList.toggle('hidden');
        });
    } else {
        console.error('Chatbox or logo trigger not found!');
    }
});
</script>