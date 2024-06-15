<x-app-layout>
    <x-slot name="header">
    <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Courses') }}
            </h2>
            @auth
            @if(auth()->user()->role != 'student')
                    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                        <a href="{{ route('courses.add') }}" class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 active:bg-indigo-800 focus:outline-none focus:border-indigo-900 focus:ring ring-indigo-300 disabled:opacity-25 transition ease-in-out duration-150">
                            Add Course
                        </a>
                    </h2>
                @endif
            @endauth
            
    </div>
    <div class="p-6 bg-white border-b border-gray-200">
       <input type="text" id="searchInput" class="border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm mt-2 mb-4 block w-full" placeholder="Search for courses...">
    </div>

    </x-slot>

    @if(session('success'))
    <script>
        window.onload = function() {
            alert("{{ session('success') }}");
        };
    </script>
    @endif
<div class="bg-gray-200 bg-opacity-25 grid grid-cols-1 md:grid-cols-2 gap-6 lg:gap-8 p-6 lg:p-8" id="courseList" style="display: none;">
    <ul class="mt-4 space-y-4" id="courseItems">
        @foreach ($courses as $course)
        <a href="{{ route('courses.search', $course->id) }}" class="course-link">

        <li class="course-item mt-8 bg-white overflow-hidden shadow-xl sm:rounded-lg w-1/2" style="border: 1px solid green;">
            <div class="p-6 bg-white border-b border-gray-200">
                <h3 class="text-lg font-semibold course-title">{{ $course->title }}</h3>
                <p class="text-gray-500">{{ $course->description }}</p>
                @if ($course->metadata)
                <p class="text-gray-500 text-sm">Metadata: {{$course->metadata }}</p>
                @endif
                @if ($course->multimedia_links)
                <p class="text-gray-500 text-sm">Multimedia Links: {{ $course->multimedia_links }}</p>
                @endif
            </div>
        </li>
    </a>
        @endforeach
    </ul>    
</div>
<div class="bg-gray-200 bg-opacity-25 grid grid-cols-1 md:grid-cols-2 gap-6 lg:gap-8 p-6 lg:p-8" id="noCoursesFound"   style="display: none;">
<div class="mt-8 bg-white overflow-hidden shadow-xl sm:rounded-lg  w-1/2">

    <p  class="p-6 bg-white border-b border-gray-200">No courses found.</p>
</div>
</div>
<div class="bg-gray-200 bg-opacity-25 grid grid-cols-2 md:grid-cols-2 gap-6 lg:gap-8 p-1 lg:p-8">
        @if ($courses->isEmpty())
                <p class="mt-4 text-gray-500">No courses available.</p>
        @else
            
               <ul class="mt-4 space-y-4">
                    @foreach ($courses as $course)
                    <a href="{{ route('courses.search', $course->id) }}" class="course-link">

                    <div class="mt-8 bg-white overflow-hidden shadow-xl sm:rounded-lg" style="border: 1px solid black;">

                         <div class="p-6 bg-white border-b border-gray-200">
                           <li class="border-b border-gray-200 pb-4">
                            <h3 class="text-lg font-semibold">{{ $course->title }}</h3>
                            <p class="text-gray-500">{{ $course->description }}</p>
                            @if ($course->metadata)
                                <p class="text-gray-500 text-sm">Metadata</p>
                            @endif
                            @if ($course->multimedia_links)
                                <p class="text-gray-500 text-sm">Watch tutorials</p>
                            @endif
                            @auth
                                    @if(auth()->user()->id == $course->user_id)
                                        <div class="mt-4 flex space-x-4">
                                            <a href="{{ route('courses.edit', $course->id) }}" class="inline-flex items-center px-4 py-2 bg-indigo-500 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 active:bg-indigo-800 focus:outline-none focus:border-indigo-900 focus:ring ring-indigo-300 disabled:opacity-20 transition ease-in-out duration-150">
                                                Edit
                                            </a>
                                            <form action="{{ route('courses.destroy', $course->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this course?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="inline-flex items-center px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-700 active:bg-red-800 focus:outline-none focus:border-red-900 focus:ring ring-red-300 disabled:opacity-20 transition ease-in-out duration-150">
                                                    Delete
                                                </button>
                                            </form>
                                        </div>
                                    @endif
                            @endauth
                           </li>
                    
                       </div>
                    </div>  
                    </a>
                    @endforeach
                </ul>     
    @endif
</div>

            </div>
        </div>
    </div>
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        const searchInput = document.getElementById('searchInput');
        const courseList = document.getElementById('courseList');
        const courseItems = document.getElementById('courseItems');
        const noCoursesFound = document.getElementById('noCoursesFound');

        searchInput.addEventListener('input', function() {
            const searchText = searchInput.value.trim().toLowerCase();
            let hasMatch = false;

             if (searchText.length === 0) {
                courseList.style.display = 'none';
                noCoursesFound.style.display = 'none';
                return;
            }

            let visibleItemCount = 0; // Counter for visible courses

            courseItems.querySelectorAll('.course-item').forEach(function(item) {
                const courseTitle = item.querySelector('.course-title').textContent.trim().toLowerCase();
                if (courseTitle.includes(searchText)) {
                    item.style.display = 'block';
                    hasMatch = true;
                    visibleItemCount++; // Increment the counter
                } else {
                    item.style.display = 'none';
                }
            });

            // Show or hide the "No courses found" message based on the visibility of courses
            if (visibleItemCount > 0) {
                    courseList.style.display = 'block';
            } else {
                courseList.style.display = 'none';
                noCoursesFound.style.display = 'block';
            }
            
        });
    });
</script>
</x-app-layout>