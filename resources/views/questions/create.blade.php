<!-- resources/views/questions/create.blade.php -->

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Add Question for {{ $quiz->title }}
        </h2>
    </x-slot>

    
    <div class="bg-gray-200 bg-opacity-25 p-6">
        <form action="{{ route('questions.store', ['quiz' => $quiz->id]) }}" method="POST">
            @csrf
            <div class="mb-4">
                <label for="question" class="block text-sm font-medium text-gray-700">Question</label>
                <input type="text" name="question" id="question" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" required>
            </div>
            <div class="mb-4">
                <label for="options" class="block text-sm font-medium text-gray-700">Options (comma-separated)</label>
                <input type="text" name="options" id="options" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" required>
            </div>
            <div class="mb-4">
                <label for="correct_answer" class="block text-sm font-medium text-gray-700">Correct Answer</label>
                <input type="text" name="correct_answer" id="correct_answer" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" required>
            </div>
            <div>
                <button type="submit" class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 active:bg-indigo-800 focus:outline-none focus:border-indigo-900 focus:ring ring-indigo-300 disabled:opacity-25 transition ease-in-out duration-150">
                    Add Question
                </button>
            </div>
        </form>
    </div>
</x-app-layout>
