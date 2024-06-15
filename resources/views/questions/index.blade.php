<!-- resources/views/questions/index.blade.php -->

<x-app-layout>
    <x-slot name="header">
    <div class="flex justify-between items-center">

        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $quiz->title }} Quizz
        </h2>
        @auth
        @if(auth()->user()->courses->contains('id', $quiz->course_id))
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        
                    <a href= "{{ route('questions.create', ['quiz' => $quiz->id]) }}" class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 active:bg-indigo-800 focus:outline-none focus:border-indigo-900 focus:ring ring-indigo-300 disabled:opacity-25 transition ease-in-out duration-150">
                     Add Question
                    </a>
                </h2>
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
    
    <div class="bg-gray-200 bg-opacity-25 grid grid-cols-1 lg:gap-8  ">
   
<div class="bg-gray-200 bg-opacity-25 p-6">
<h3 class="font-semibold  p-6">Questions And Answers</h3>
        @forelse ($questions as $question)
            <div class="bg-white shadow-sm rounded-md p-4 mb-4 p-6">
                <h3 class="font-semibold">{{ $question->id }} - {{ $question->question }}</h3>
                <ul>
                    @foreach (json_decode($question->options) as $option)
                        <li>{{ $option }}</li>
                    @endforeach
                </ul>
                <p class="text-sm text-gray-500">Correct Answer: {{ $question->correct_answer }}</p>
            </div>
        @empty
            <p class="text-gray-500">No questions found for this quiz.</p>
        @endforelse
    </div>
</div>

</x-app-layout>
