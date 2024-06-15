<!-- resources/views/quizzes/index.blade.php -->

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Quizzes for {{ $course->title }}
        </h2>
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
                <h3 class="text-lg font-semibold">Quizzes</h3>
                @auth
                @if(auth()->user()->id == $course->user_id)
                <a href="{{ route('quizzes.create', $course->id) }}" class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 active:bg-indigo-800 focus:outline-none focus:border-indigo-900 focus:ring ring-indigo-300 disabled:opacity-25 transition ease-in-out duration-150">
                            Add Quiz
                        </a>
                    @endif
                @endauth
            </div>
            <ul class="mt-4 space-y-4">
                @forelse ($quizzes as $quiz)
                    <li class="bg-white shadow overflow-hidden sm:rounded-lg p-6 border-b border-gray-200">
                    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    <a href="{{ route('questions.index', ['quiz' => $quiz->id]) }}" class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 active:bg-indigo-800 focus:outline-none focus:border-indigo-900 focus:ring ring-indigo-300 disabled:opacity-25 transition ease-in-out duration-150">
                        {{ $quiz->title }}
                    </a>
                   </h2>
                    </li>
                @empty
                    <li class="bg-white shadow overflow-hidden sm:rounded-lg p-6 border-b border-gray-200">
                        <p class="text-gray-500">No quizzes available for this course.</p>
                    </li>
                @endforelse
            </ul>
        </div>
    </div>
</x-app-layout>
