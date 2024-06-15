<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
           Notifications
        </h2>
        @if(session('success'))
            <script>
                window.onload = function() {
                    alert("{{ session('success') }}");
                };
            </script>
        @endif
    </x-slot>

    <div class="p-6 bg-white border-b border-black-200">
        @foreach ($notifications as $notification)
        <a href="{{ route('exam.responses.show', $notification) }}" >
            <div class="flex items-center">
                <div class="mr-4">
                    @if ($notification->course)
                        <!-- Display Course Name -->
                        <p><strong>Course:</strong> {{ $notification->course->title }}</p>
                    @else
                        <p><strong>Course:</strong> Course not found</p>
                    @endif

                    @if ($notification->examination)
                        <!-- Display Examination Title -->
                        <p><strong>Examination:</strong> {{ $notification->examination->title }}</p>
                    @else
                        <p><strong>Examination:</strong> Examination not found</p>
                    @endif

                    <!-- Display Notification Message -->
                    <p><strong>Message:</strong> {{ $notification->message }}</p>
                </div>
            </div>
        </a>
            <hr class="my-4">
        @endforeach
    </div>
</x-app-layout>
