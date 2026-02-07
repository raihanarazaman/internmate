<div id="ai-chatbox" class="fixed bottom-0 left-0 w-96 bg-white rounded-tl-xl shadow-xl border border-gray-200 overflow-hidden hidden z-50">
    <!-- Header -->
    <div class="bg-blue-600 text-white px-4 py-3 flex justify-between items-center">
        <h3 class="font-semibold">Chat with us</h3>
        <button id="close-chat" class="text-white hover:text-gray-200">&times;</button>
    </div>

    <!-- Messages Container -->
    <div id="chat-messages" class="p-4 h-80 overflow-y-auto space-y-3 bg-gray-50">
        <!-- Messages will be appended here by JS -->
    </div>

    <!-- Input Area -->
    <div class="border-t p-3 bg-white">
        <div class="flex space-x-2">
            <input
                id="user-message"
                type="text"
                placeholder="Type your message..."
                class="flex-1 border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
                autocomplete="off"
            />
            <button
                id="send-message"
                class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 transition"
            >
                Send
            </button>
        </div>

        <!-- AI Smart Reply Button -->
        <div class="mt-2 text-right">
            <button
                id="ai-smart-reply"
                class="inline-flex items-center px-3 py-1 bg-indigo-600 text-white rounded-md text-sm hover:bg-indigo-700 transition"
            >
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                </svg>
                AI Smart Reply
            </button>
        </div>
    </div>

    <!-- Loading Indicator -->
    <div id="loading-indicator" class="hidden p-4 text-center text-gray-500">
        <svg class="animate-spin h-5 w-5 mx-auto mb-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V6a6 6 0 6112 0h-2v2a6 6 0 11-12 0v-2z"></path>
        </svg>
        Generating AI Answer...
    </div>
</div>