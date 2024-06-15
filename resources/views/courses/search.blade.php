<!-- search.blade.php -->

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Course Overview
        </h2>
    </x-slot>
    <div class="bg-gray-200 bg-opacity-25 gap-6 lg:gap-8 p-1 lg:p-8">
    <div class="p-6 bg-white border-b border-gray-200">
        <h3 class="text-lg font-semibold">{{ $course->title }}</h3>
        <p class="text-gray-500">{{ $course->description }}</p>
        @if ($course->metadata)
            <a class="text-sm" style="color: #3b82f6 !important;" href="{{ $course->metadata }}">PDFs(notes)</p>
        @endif
        @if ($course->multimedia_links)
            <a class="text-sm" style="color: #3b82f6 !important;" href="{{ $course->multimedia_links }}">Watch turorial of course</a>
        @endif

        @auth
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                <a href="{{ route('quizzes.index', $course->id) }}" class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 active:bg-indigo-800 focus:outline-none focus:border-indigo-900 focus:ring ring-indigo-300 disabled:opacity-25 transition ease-in-out duration-150">
                    View Quizzes
                </a>
            </h2>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    <a href="{{ route('examinations.index',['course_id' => $course->id]) }}" class="inline-flex items-center px-4 py-2 bg-yellow-500 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-yellow-600 active:bg-yellow-700 focus:outline-none focus:border-yellow-900 focus:ring ring-yellow-300 disabled:opacity-25 transition ease-in-out duration-150">
                        View Examinations
                    </a>
            </h2>
        @endauth
    </div>
     
   
    </div>
    
</x-app-layout>
