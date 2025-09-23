@extends('student.layouts.master')

@section('content')
<div class="bg-gray-100 min-h-screen">
    <div class="flex">
        <!-- Main Content -->
        <main class="flex-1 p-4 md:p-6 overflow-y-auto">

            <!-- Header -->
            <header class="flex justify-between items-center mb-6">
                <div class="flex items-center">
                    <button id="sidebar-toggle" class="hamburger mr-4 text-gray-600">
                        <i class="fas fa-bars text-xl"></i>
                    </button>
                    <h1 class="text-2xl font-bold text-gray-800">Notes</h1>
                </div>
            </header>

            <!-- Filter Bar -->
            <form action="{{ route('student.notes') }}" method="GET" class="flex flex-wrap gap-3 mb-6">
                <div>
                    <select name="level"
                        class="px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400">
                        <option value="">All Levels</option>
                        <option value="level 1" {{ request('level') == 'level 1' ? 'selected' : '' }}>Level 1</option>
                        <option value="level 2" {{ request('level') == 'level 2' ? 'selected' : '' }}>Level 2</option>
                        <option value="level 3" {{ request('level') == 'level 3' ? 'selected' : '' }}>Level 3</option>
                        {{-- or dynamically load distinct levels from DB --}}
                    </select>
                </div>
                <div>
                    <button type="submit"
                        class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition">
                        <i class="fas fa-search"></i> Filter
                    </button>
                </div>
            </form>

            <!-- Notes Section -->
            <div class="bg-white rounded-2xl shadow-md p-6 hover:shadow-lg transition-shadow">
                <h2 class="text-xl font-semibold text-gray-800 border-b pb-3 mb-6">
                    📝 Notes ({{ ucfirst($studentProgram) }})
                </h2>

                @if($notes->isEmpty())
                    <!-- No Notes Message -->
                    <div class="bg-yellow-100 text-yellow-700 p-4 rounded-lg text-center font-medium">
                        No notes available yet for your program.
                    </div>
                @else
                    <!-- Notes Table -->
                    <div class="overflow-x-auto max-h-[500px] border rounded-lg">
                        <table class="w-full border-collapse">
                            <thead class="bg-blue-600 text-white sticky top-0 z-10">
                                <tr>
                                    <th class="px-6 py-3 text-left">Title</th>
                                    <th class="px-6 py-3 text-left">Description</th>
                                    <th class="px-6 py-3 text-left">Level</th>
                                    <th class="px-6 py-3 text-left">File</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @foreach($notes as $note)
                                    <tr class="hover:bg-gray-50 transition">
                                        <td class="px-6 py-4 font-medium text-gray-800 whitespace-nowrap">
                                            {{ $note->title }}
                                        </td>
                                        <td class="px-6 py-4">
                                            {{ $note->description }}
                                        </td>
                                        <td class="px-6 py-4">
                                            {{ $note->level }}
                                        </td>
                                        <td class="px-6 py-4">
                                            @if($note->file)
                                                <a href="{{ asset('storage/' . $note->file) }}"
                                                   target="_blank"
                                                   class="text-green-600 font-medium hover:underline mr-4">
                                                    👁 Preview
                                                </a>
                                                <a href="{{ asset('storage/' . $note->file) }}"
                                                   download="{{ basename($note->file) }}"
                                                   class="text-blue-600 font-medium hover:underline">
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

                    <!-- Pagination (if needed) -->
                    <div class="mt-4">
                        {{ $notes->appends(request()->query())->links() }}
                    </div>
                @endif
            </div>
        </main>
    </div>
</div>
@endsection
