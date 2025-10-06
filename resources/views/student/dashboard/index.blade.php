@extends('student.layouts.master')

@section('content')
    <main class="flex-1 p-4 md:p-6 main-content">

        <!-- Header -->
        <header class="flex justify-between items-center mb-8 bg-white p-4 rounded-xl shadow">
            <div class="flex items-center">
                <button class="hamburger mr-4 text-gray-600" id="sidebar-toggle">
                    <i class="fas fa-bars text-xl"></i>
                </button>
                <h1 class="text-2xl font-bold text-gray-800">Student Dashboard</h1>
            </div>
        </header>

        <!-- Dashboard Content -->
        <div class="tab-content active" id="dashboard-tab">

            <!-- Stats Overview -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-5 mb-6">

                <!-- Notes -->
                <div class="stats-card bg-white rounded-xl shadow-md p-5 flex items-center animate-fade-in">
                    <div class="p-3 rounded-full bg-blue-100 text-blue-600 mr-4">
                        <i class="fas fa-book text-xl"></i>
                    </div>
                    <div>
                        <h3 class="text-2xl font-bold">{{ $notesCount ?? 0 }}</h3>
                        <p class="text-gray-500">Notes</p>
                    </div>
                </div>

                <!-- Assignments -->
                {{-- <div class="stats-card bg-white rounded-xl shadow-md p-5 flex items-center animate-fade-in delay-100">
                <div class="p-3 rounded-full bg-green-100 text-green-600 mr-4">
                    <i class="fas fa-check-circle text-xl"></i>
                </div>
                <div>
                    <h3 class="text-2xl font-bold">12</h3>
                    <p class="text-gray-500">Assignments Done</p>
                </div>
            </div> --}}

                <!-- Upcoming Exams -->
                <div class="stats-card bg-white rounded-xl shadow-md p-5 flex items-center animate-fade-in delay-200">
                    <div class="p-3 rounded-full bg-yellow-100 text-yellow-600 mr-4">
                        <i class="fas fa-clock text-xl"></i>
                    </div>
                    <div>
                        <h3 class="text-2xl font-bold">{{ $upcomingExamsCount ?? 0 }}</h3>
                        <p class="text-gray-500">Upcoming Exams</p>
                    </div>
                </div>

            </div>

            <!-- Examination Schedule -->
            <div class="card bg-white rounded-xl shadow-md p-6">
                <div class="flex justify-between items-center mb-4">
                    <h3 class="text-lg font-semibold">Examination Schedule</h3>
                    <a href="{{ route('student.exams') }}" class="text-blue-600 text-sm">View All</a>
                </div>

                <div class="space-y-4">
                    @forelse($exams ?? [] as $exam)
                        <div class="deadline-item p-3 rounded-lg bg-gray-50 flex justify-between">
                            <span class="text-blue-700">
                                {{ \Carbon\Carbon::parse($exam->exam_date)->format('d M Y') }}
                            </span>
                            <span class="text-green-700">
                                {{ $exam->course_name }}
                            </span>
                            <span class="text-red-700">
                                {{ \Carbon\Carbon::parse($exam->time_from)->format('h:i A') }}
                            </span>
                        </div>
                    @empty
                        <p class="text-gray-500">No upcoming exams scheduled.</p>
                    @endforelse
                </div>

            </div>


        </div>
    </main>
@endsection
