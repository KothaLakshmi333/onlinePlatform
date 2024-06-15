<x-app-layout>
    <x-slot name="header">
    <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __(' Add Course') }}
            </h2>
        </div>
    </x-slot>
<div class="py-15">
        <div class="w-1/2 mx-auto bg-gray-200 bg-opacity-25 gap-6 lg:gap-8 p-6 lg:p-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                <form method="POST" action="{{ route('courses.store') }}">
    @csrf
    <div class="mb-4">
        <label for="title" class="block text-gray-700 text-sm font-bold mb-2">Title:</label>
        <input type="text" name="title" id="title" class="appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
    </div>
    <div class="mb-4">
        <label for="description" class="block text-gray-700 text-sm font-bold mb-2">Description:</label>
        <textarea name="description" id="description" rows="4" class="form-textarea mt-1 block w-full rounded-md border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" required></textarea>
    </div>
    <div class="mb-4">
        <label for="metadata" class="block text-gray-700 text-sm font-bold mb-2">Metadata:</label>
        <input type="text" name="metadata" id="metadata" class="appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
    </div>
    <div class="mb-4">
        <label for="multimedia_links" class="block text-gray-700 text-sm font-bold mb-2">Multimedia Links:</label>
        <input type="text" name="multimedia_links" id="multimedia_links" class="appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
    </div>
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
                <x-button class="ms-1">
                    {{ __('Add Course') }}
                </x-button>
            
            </h2>
        </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

