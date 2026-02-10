<nav x-data="{ open: false }" class="bg-white border-b border-gray-100">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex items-center">
                <!-- Logo (NO id="logo-trigger" — just normal link) -->
                <div class="shrink-0 flex items-center">
                    @auth
                        @if(auth()->user()->role === 'student')
                            <a href="{{ route('student.dashboard') }}">
                        @elseif(auth()->user()->role === 'company')
                            <a href="{{ route('company.dashboard') }}">
                        @elseif(auth()->user()->role === 'admin')
                            <a href="{{ route('admin.dashboard') }}">
                        @endif
                            <img src="{{ asset('images/internmate-logo.jpg') }}" class="h-8 w-auto">
                        </a>
                    @else
                        <a href="/">
                            <img src="{{ asset('images/internmate-logo.jpg') }}" class="h-8 w-auto">
                        </a>
                    @endauth
                </div>

                <!-- Navigation Links -->
                <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                    @auth
                        @if(auth()->user()->role === 'student')
                            <x-nav-link :href="route('student.dashboard')">
                                Student Dashboard
                            </x-nav-link>
                        @elseif(auth()->user()->role === 'company')
                            <x-nav-link :href="route('company.dashboard')">
                                Company Dashboard
                            </x-nav-link>
                        @elseif(auth()->user()->role === 'admin')
                            <x-nav-link :href="route('admin.dashboard')">
                                Admin Dashboard
                            </x-nav-link>
                        @endif
                    @endauth
                </div>
            </div>

            <!-- Welcome + Notifications + Logout (Right Side) -->
            <div class="hidden sm:flex items-center space-x-4">
               @auth
                    @if(auth()->user()->role === 'student')
                        <span class="text-gray-700">
                            Welcome, {{ auth()->user()->student->full_name }}
                        </span>

          

                    @elseif(auth()->user()->role === 'company')
                        <span class="text-gray-700">
                            Welcome, {{ auth()->user()->company->company_name }}
                        </span>

                    @elseif(auth()->user()->role === 'admin')
                        <span class="text-gray-700">
                            Welcome, {{ auth()->user()->admin->full_name }}
                        </span>
                    @endif

                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit"
                            class="px-3 py-1 bg-red-600 hover:bg-red-700 text-white rounded-md text-sm">
                            Logout
                        </button>
                    </form>
                      <a href="{{ route('notifications.index') }}"
                    class="relative text-sm text-gray-700 hover:text-gray-900">

                        Notifications

                        @if(auth()->user()->unreadNotifications->count())
                            <span
                                class="absolute -top-2 -right-2 bg-red-600 text-white text-xs
                                    rounded-full px-1.5 py-0.5">
                                {{ auth()->user()->unreadNotifications->count() }}
                            </span>
                        @endif
                    </a>
                @endauth
            </div>

            <!-- Hamburger (Mobile) -->
            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Menu (Mobile) -->
    <div x-show="open" class="pt-4 pb-1 border-t border-gray-200 sm:hidden">
        <div class="px-4 space-y-2">
        @auth
                @if(auth()->user()->role === 'student')
                    <a href="{{ route('student.dashboard') }}" class="block px-4 py-2">
                        Student Dashboard
                    </a>
                    <div class="px-4 py-2 text-gray-600">
                        Welcome, {{ auth()->user()->student->full_name }}
                    </div>

                @elseif(auth()->user()->role === 'company')
                    <a href="{{ route('company.dashboard') }}" class="block px-4 py-2">
                        Company Dashboard
                    </a>
                    <div class="px-4 py-2 text-gray-600">
                        Welcome, {{ auth()->user()->company->company_name }}
                    </div>

                @elseif(auth()->user()->role === 'admin')
                    <a href="{{ route('admin.dashboard') }}" class="block px-4 py-2">
                        Admin Dashboard
                    </a>
                    <div class="px-4 py-2 text-gray-600">
                        Welcome, {{ auth()->user()->admin->full_name }}
                    </div>
                @endif

                <form method="POST" action="{{ route('logout') }}" class="px-4">
                    @csrf
                    <button type="submit"
                        class="w-full text-left px-4 py-2 text-red-600 hover:bg-red-50 rounded-md">
                        Logout
                    </button>
                </form>
            @endauth
        </div>
    </div>
</nav>

{{-- ✅ AI Chatbox Component (outside nav!) --}}
<x-ai-chatbox />

{{-- Floating AI Chat Button (Bottom-Right, Bigger) --}}
<button 
    onclick="toggleChatbox()" 
    class="fixed bottom-6 left-30 w-14 h-14 rounded-full bg-blue-600 text-white text-2xl shadow-lg hover:bg-blue-700 flex items-center justify-center transition-all duration-300 z-50 hover:scale-110"
    aria-label="Open AI Chat">
    💬
</button>

{{-- ✅ Chatbox JavaScript --}}
<script>
function toggleChatbox() {
    const chatbox = document.getElementById('ai-chatbox');
    if (chatbox) {
        chatbox.classList.toggle('hidden');
        if (!chatbox.classList.contains('hidden')) {
            document.getElementById('user-message')?.focus();
        }
    }
}

// Close chat when clicking close button
document.addEventListener('DOMContentLoaded', function() {
    const closeBtn = document.getElementById('close-chat');
    if (closeBtn) {
        closeBtn.addEventListener('click', () => {
            document.getElementById('ai-chatbox')?.classList.add('hidden');
        });
    }

    // ... rest of your sendMessage, generateAiReply logic ...
    const messagesContainer = document.getElementById('chat-messages');
    const userInput = document.getElementById('user-message');
    const sendBtn = document.getElementById('send-message');
    const aiReplyBtn = document.getElementById('ai-smart-reply');
    const loadingIndicator = document.getElementById('loading-indicator');

    function sendMessage() {
        const message = userInput?.value.trim();
        if (!message) return;

        addMessage(message, 'user');
        userInput.value = '';
        loadingIndicator?.classList.remove('hidden');

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
            loadingIndicator?.classList.add('hidden');
            if (data.success) {
                addMessage(data.reply, 'ai');
            } else {
                addMessage("Sorry, I couldn't process your request.", 'ai');
            }
        })
        .catch(() => {
            loadingIndicator?.classList.add('hidden');
            addMessage("Something went wrong. Please try again.", 'ai');
        });
    }

    function generateAiReply() {
        const lastUserMsg = Array.from(messagesContainer?.children || [])
            .filter(el => el.dataset.role === 'user')
            .pop();

        if (!lastUserMsg) {
            addMessage("Please send a message first!", 'ai');
            return;
        }

        const prompt = lastUserMsg.textContent.trim();
        loadingIndicator?.classList.remove('hidden');

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
            loadingIndicator?.classList.add('hidden');
            if (data.success) {
                addMessage(data.reply, 'ai');
            } else {
                addMessage("Sorry, I couldn't generate a smart reply.", 'ai');
            }
        })
        .catch(() => {
            loadingIndicator?.classList.add('hidden');
            addMessage("Something went wrong. Please try again.", 'ai');
        });
    }

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
        messagesContainer?.appendChild(msgDiv);
        messagesContainer.scrollTop = messagesContainer.scrollHeight;
    }

    if (sendBtn) sendBtn.addEventListener('click', sendMessage);
    if (userInput) userInput.addEventListener('keypress', e => {
        if (e.key === 'Enter') sendMessage();
    });
    if (aiReplyBtn) aiReplyBtn.addEventListener('click', generateAiReply);
});
</script>