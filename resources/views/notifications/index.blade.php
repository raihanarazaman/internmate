<x-app-layout>
    <div class="py-12 max-w-6xl mx-auto">

        <h2 class="text-2xl font-bold mb-6">
            Notifications
        </h2>

        @forelse($notifications as $notif)
            <div class="mb-4 p-4 rounded border
                {{ $notif->read_at ? 'bg-gray-100' : 'bg-blue-50 border-blue-300' }}">

                <p class="font-semibold">
                    {{ $notif->data['message'] ?? 'Notification' }}
                </p>

                @if(isset($notif->data['student']))
                    <p class="text-sm text-gray-600 mt-1">
                        Student: {{ $notif->data['student'] }}<br>
                        Company: {{ $notif->data['company'] ?? '-' }}<br>
                        Internship: {{ $notif->data['internship'] ?? '-' }}
                    </p>
                @endif

                @if(!$notif->read_at)
                    <form method="POST"
                          action="{{ route('notifications.read', $notif->id) }}"
                          class="mt-2">
                        @csrf
                        @method('PUT')
                        <button class="text-sm text-blue-600 underline">
                            Mark as read
                        </button>
                    </form>
                @endif
            </div>
        @empty
            <p class="text-gray-600">No notifications.</p>
        @endforelse

    </div>
</x-app-layout>
