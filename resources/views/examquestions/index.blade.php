<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Questions for {{ $examination->title }}
            </h2>
            @auth
                @php
                    $authorized = false;
                    foreach(auth()->user()->courses as $course) {
                        if($course->id === $examination->course_id) {
                            $authorized = true;
                            break;
                        }
                    }
                @endphp
                @if($authorized)
                    <a href="{{ route('examquestions.create', ['examination_id' => $examination->id]) }}" class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 active:bg-indigo-800 focus:outline-none focus:border-indigo-900 focus:ring ring-indigo-300 disabled:opacity-25 transition ease-in-out duration-150">
                        Add Question
                    </a>
                @endif
            @endauth
        </div>
    </x-slot>

    <div class="bg-gray-200 bg-opacity-25 gap-6 lg:gap-8 p-6 lg:p-8">
        <div class="p-6 bg-white border-b border-gray-200">
            <form method="POST" action="{{ route('examinations.submit', ['examination_id' => $examination->id]) }}">
                @csrf
                <ul class="mt-4 space-y-4">
                    @forelse ($questions as $question)
                        <li class="bg-white shadow overflow-hidden sm:rounded-lg p-6 border-b border-gray-200">
                            <h3 class="font-semibold">{{ $question->id }}. {{ $question->question }}</h3>
                            <ul>
                                @foreach (json_decode($question->options) as $index => $option)
                                    <li>
                                        <label>
                                            <input type="radio" name="answers[{{ $question->id }}]" value="{{ $index }}" required>
                                            {{ $option }}
                                        </label>
                                    </li>
                                @endforeach
                            </ul>
                        </li>
                    @empty
                        <li class="bg-white shadow overflow-hidden sm:rounded-lg p-6 border-b border-gray-200">
                            <p class="text-gray-500">No questions available for this examination.</p>
                        </li>
                    @endforelse
                </ul>
                <div class="mt-4">
                    <button type="submit" class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 active:bg-indigo-800 focus:outline-none focus:border-indigo-900 focus:ring ring-indigo-300 disabled:opacity-25 transition ease-in-out duration-150">
                        Submit Answers
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
