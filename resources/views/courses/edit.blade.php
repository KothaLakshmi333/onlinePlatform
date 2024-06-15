<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Course') }}
        </h2>
    </x-slot>
    @if(session('success'))
    <script>
        window.onload = function() {
            alert("{{ session('success') }}");
        };
    </script>
    @endif

    <div class="py-17">
        <div class="bg-gray-200 bg-opacity-25 grid grid-cols-1 md:grid-cols-2 gap-6 lg:gap-8 p-6 lg:p-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
                <form action="{{ route('courses.update', $course->id) }}"  method="POST">
                    @csrf
                    @method('PUT')

                    <div>
                        <label for="title" class="block font-medium text-sm text-gray-700">Title</label>
                        <input id="title" type="text" name="title" value="{{ old('title', $course->title) }}" class="mt-1 p-2 border border-gray-300 rounded-md w-full" required>
                    </div>

                    <div class="mt-4">
                        <label for="description" class="block font-medium text-sm text-gray-700">Description</label>
                        <textarea id="description" name="description" class="mt-1 p-2 border border-gray-300 rounded-md w-full" required>{{ old('description', $course->description) }}</textarea>
                    </div>

                    <div class="mt-4">
                        <label for="metadata" class="block font-medium text-sm text-gray-700">Metadata</label>
                        <textarea id="metadata" name="metadata" class="mt-1 p-2 border border-gray-300 rounded-md w-full">{{ old('metadata', $course->metadata) }}</textarea>
                    </div>

                    <div class="mt-4">
                        <label for="multimedia_links" class="block font-medium text-sm text-gray-700">Multimedia Links</label>
                        <input id="multimedia_links" type="text" name="multimedia_links" value="{{ old('multimedia_links', $course->multimedia_links) }}" class="mt-1 p-2 border border-gray-300 rounded-md w-full">
                    </div>

                    <div class="mt-4">
                        <button type="submit" class="px-4 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700">Update</button>
                        <a href="{{ route('courses.index') }}" class="px-4 py-3 bg-indigo-600 text-white rounded-md hover:bg-indigo-700">Discard</a>

                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
