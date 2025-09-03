@extends('student.layouts.master')

@section('content')
<div class="bg-gray-100 min-h-screen">
    <div class="flex">
        <!-- Main Content -->
        <main class="flex-1 p-4 md:p-6 overflow-y-auto">

            <!-- Header -->
            <header class="flex justify-between items-center mb-8">
                <div class="flex items-center">
                    <button id="sidebar-toggle" class="hamburger mr-4 text-gray-600">
                        <i class="fas fa-bars text-xl"></i>
                    </button>
                    <h1 class="text-2xl font-bold text-gray-800">Exam Schedule</h1>
                </div>
            </header>

            <!-- Exam Schedule Section -->
            <div class="bg-white rounded-2xl shadow-md p-6 hover:shadow-lg transition-shadow">
                <h2 class="text-xl font-semibold text-gray-800 border-b pb-3 mb-6">
                    📚 Exam Schedule ({{ ucfirst($studentProgram) }})
                </h2>

                @if($exams->isEmpty())
                    <!-- No Exam Message -->
                    <div class="bg-yellow-100 text-yellow-700 p-4 rounded-lg text-center font-medium">
                        No exams scheduled yet for your program.
                    </div>
                @else
                    <!-- Responsive Table -->
                    <div class="overflow-x-auto max-h-[500px] border rounded-lg">
                        <table class="w-full border-collapse">
                            <thead class="bg-blue-600 text-white sticky top-0 z-10">
                                <tr>
                                    <th class="px-6 py-3 text-left">Course Code</th>
                                    <th class="px-6 py-3 text-left">Course Name</th>
                                    <th class="px-6 py-3 text-left">Exam Date</th>
                                    <th class="px-6 py-3 text-left">Time</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @foreach($exams as $exam)
                                    <tr class="hover:bg-gray-50 transition">
                                        <td class="px-6 py-4 font-medium text-gray-800 whitespace-nowrap">
                                            {{ $exam->course_code }}
                                        </td>
                                        <td class="px-6 py-4">
                                            {{ $exam->course_name }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            {{ \Carbon\Carbon::parse($exam->exam_date)->format('d M Y') }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            {{ $exam->time_from }} - {{ $exam->time_to }}
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif
            </div>
        </main>
    </div>
</div>
@endsection
