<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Exam Responses
        </h2>
    </x-slot>

    <div class="p-6 ">
        <h3 class="font-semibold text-lg mb-4">Exam Responses Details</h3>
        
        @foreach ($examResponses as $response)
            <div class="mb-4 p-4 bg-white-100 rounded shadow">
                <p><strong>Question:</strong> {{ $response->question }}</p>
                
                @php
                    // First decode
                    $firstDecode = json_decode($response->options);
                    // Second decode
                    $options = json_decode($firstDecode);
                @endphp

                @if (is_array($options))
                    <p><strong>Options:</strong></p>
                    <ul>
                        @foreach ($options as $option)
                            <li>{{ $option }}</li>
                        @endforeach
                    </ul>
                @else
                    <p><strong>Options:</strong> No options available or error decoding JSON</p>
                @endif

                <p><strong>Selected Option:</strong> {{ $response->selected_option }}</p>
                <p><strong>Correct Answer Index:</strong> {{ $response->correct_answer_index }}</p>
            </div>
        @endforeach
    </div>
</x-app-layout>
