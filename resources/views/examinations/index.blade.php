<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Examinations for {{ $course->title }}
            </h2>
            @auth
            @if(auth()->user()->id == $course->user_id)
            <a href="{{ route('examinations.create', ['course_id' => $course->id]) }}" class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 active:bg-indigo-800 focus:outline-none focus:border-indigo-900 focus:ring ring-indigo-300 disabled:opacity-25 transition ease-in-out duration-150">
                        Add Examination
                    </a>
                @endif
            @endauth
        </div>
        @if(session('success'))
    <script>
        window.onload = function() {
            alert("{{ session('success') }}");
        };
    </script>
    @endif
    </x-slot>

    <div class="bg-gray-200 bg-opacity-25 gap-6 lg:gap-8 p-6 lg:p-8">
        <div class="p-6 bg-white border-b border-gray-200">
            <div class="flex justify-between items-center">
                <h3 class="text-lg font-semibold">Examinations</h3>
            </div>
            <ul class="mt-4 space-y-4">
                @forelse ($examinations as $examination)
                    <li class="bg-white shadow overflow-hidden sm:rounded-lg p-6 border-b border-gray-200">
                        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                            <a href="{{ route('Examquestions.index', ['examination_id' => $examination->id]) }}" class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 active:bg-indigo-800 focus:outline-none focus:border-indigo-900 focus:ring ring-indigo-300 disabled:opacity-25 transition ease-in-out duration-150">
                                {{ $examination->title }}
                            </a>
                        </h2>
                    </li>
                @empty
                    <li class="bg-white shadow overflow-hidden sm:rounded-lg p-6 border-b border-gray-200">
                        <p class="text-gray-500">No examinations available for this course.</p>
                    </li>
                @endforelse
            </ul>
        </div>
    </div>
</x-app-layout>
