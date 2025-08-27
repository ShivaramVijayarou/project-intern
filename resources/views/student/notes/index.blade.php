@extends('student.layouts.master')

@section('content')
<div class="ml-64 p-6"> {{-- Adjust for sidebar if you’re using it --}}
    <h2 class="text-2xl font-bold mb-6">📝 Notes ({{ ucfirst($studentProgram) }})</h2>

    @if($notes->isEmpty())
        <div class="bg-yellow-100 text-yellow-700 p-4 rounded-lg">
            No notes available yet for your program.
        </div>
    @else
        <div class="overflow-x-auto">
            <table class="w-full border-collapse rounded-lg shadow-md overflow-hidden">
                <thead class="bg-blue-600 text-white">
                    <tr>
                        <th class="px-6 py-3 text-left">Title</th>
                        <th class="px-6 py-3 text-left">Description</th>
                        {{-- <th class="px-6 py-3 text-left">Uploaded By</th> --}}
                        <th class="px-6 py-3 text-left">File</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach($notes as $note)
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4 font-medium text-gray-800">{{ $note->title }}</td>
                            <td class="px-6 py-4">{{ $note->description }}</td>
                            {{-- <td class="px-6 py-4">{{ $note->uploaded_by }}</td> --}}
                            <td class="px-6 py-4">
                                @if($note->file)
                                    <a href="{{ asset('storage/' . $note->file) }}"
                                       target="_blank"
                                       class="text-blue-600 hover:underline">
                                        📂 Download
                                    </a>
                                @else
                                    <span class="text-gray-400">No file</span>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif
</div>
@endsection
