@extends('student.layouts.master')

@section('content')
<body class="bg-gray-100 min-h-screen">
    <div class="flex">
        <!-- Overlay for mobile sidebar -->
        <div class="overlay" id="overlay"></div>

        <!-- Main Content -->
        <main class="flex-1 p-4 md:p-6 overflow-y-auto">
            <!-- Header -->
            <header class="flex justify-between items-center mb-8">
                <div class="flex items-center">
                    <button class="hamburger mr-4 text-gray-600" id="sidebar-toggle">
                        <i class="fas fa-bars text-xl"></i>
                    </button>
                    <h1 class="text-2xl font-bold text-gray-800">Exam Schedule</h1>
                </div>

                <div class="flex items-center space-x-4">
                    <div class="flex items-center">
                        <img alt="image" src="{{ Auth::user()->profileimage ? asset('storage/' . Auth::user()->profileimage) : asset('images/default-avatar.png') }}"
                             class="w-10 h-10 rounded-full object-cover">
                        <div class="ml-3 hidden md:block">
                            <p class="font-medium">Welcome, {{ Auth::user()->name }}</p>
                            <p class="text-sm text-gray-500">{{ Auth::user()->student_id }}</p>
                        </div>
                    </div>
                </div>
            </header>

            <!-- Exam Schedule Content -->
            <div class="bg-white rounded-2xl shadow-md p-6 hover:shadow-lg transition-shadow">
                <h2 class="text-xl font-semibold mb-6 text-gray-800 border-b pb-3">
                    📚 Exam Schedule ({{ ucfirst($studentProgram) }})
                </h2>

                @if($exams->isEmpty())
                    <div class="bg-yellow-100 text-yellow-700 p-4 rounded-lg">
                        No exams scheduled yet for your program.
                    </div>
                @else
                    <div class="overflow-x-auto">
                        <table class="w-full border-collapse rounded-lg shadow-md overflow-hidden">
                            <thead class="bg-blue-600 text-white">
                                <tr>
                                    <th class="px-6 py-3 text-left">Course Code</th>
                                    <th class="px-6 py-3 text-left">Course Name</th>
                                    <th class="px-6 py-3 text-left">Exam Date</th>
                                    <th class="px-6 py-3 text-left">Time</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @foreach($exams as $exam)
                                    <tr class="hover:bg-gray-50">
                                        <td class="px-6 py-4 font-medium text-gray-800">{{ $exam->course_code }}</td>
                                        <td class="px-6 py-4">{{ $exam->course_name }}</td>
                                        <td class="px-6 py-4">{{ \Carbon\Carbon::parse($exam->exam_date)->format('d M Y') }}</td>
                                        <td class="px-6 py-4">{{ $exam->time_from }} - {{ $exam->time_to }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif
            </div>
        </main>
    </div>
</body>
@endsection
