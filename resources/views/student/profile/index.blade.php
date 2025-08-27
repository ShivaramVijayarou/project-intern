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
                        <h1 class="text-2xl font-bold text-gray-800">Student Profile</h1>
                    </div>

                    <div class="flex items-center space-x-4">


                        <div class="flex items-center">
                            <img alt="image" src="/uploads/profile.png" class="w-10 h-10 rounded-full object-cover">
                            <div class="ml-3 hidden md:block">
                                <p class="font-medium">Welcome,{{ Auth::user()->name }}</p>
                                <p class="text-sm text-gray-500">{{ Auth::user()->student_id }}</p>
                            </div>
                        </div>
                    </div>
                </header>

                <!-- Dashboard Tab Content -->
                <div class="tab-content active" id="dashboard-tab">
                    <!-- Stats Overview -->
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-5 mb-6">
                        <div
                            class="card bg-white rounded-xl shadow-md p-5 flex items-center hover:shadow-lg transition-shadow">
                            <div class="p-3 rounded-full bg-blue-100 text-blue-600 mr-4">
                                <i class="fas fa-book text-xl"></i>
                            </div>
                            <div>
                                <h3 class="text-2xl font-bold" id="active-courses-count">5</h3>
                                <p class="text-gray-500">Active Courses</p>
                            </div>
                        </div>

                        <div
                            class="card bg-white rounded-xl shadow-md p-5 flex items-center hover:shadow-lg transition-shadow">
                            <div class="p-3 rounded-full bg-green-100 text-green-600 mr-4">
                                <i class="fas fa-check-circle text-xl"></i>
                            </div>
                            <div>
                                <h3 class="text-2xl font-bold" id="assignments-done-count">12</h3>
                                <p class="text-gray-500">Assignments Done</p>
                            </div>
                        </div>

                        <div
                            class="card bg-white rounded-xl shadow-md p-5 flex items-center hover:shadow-lg transition-shadow">
                            <div class="p-3 rounded-full bg-yellow-100 text-yellow-600 mr-4">
                                <i class="fas fa-clock text-xl"></i>
                            </div>
                            <div>
                                <h3 class="text-2xl font-bold" id="pending-tasks-count">3</h3>
                                <p class="text-gray-500">Pending Tasks</p>
                            </div>
                        </div>

                        <div
                            class="card bg-white rounded-xl shadow-md p-5 flex items-center hover:shadow-lg transition-shadow">
                            <div class="p-3 rounded-full bg-red-100 text-red-600 mr-4">
                                <i class="fas fa-chart-line text-xl"></i>
                            </div>
                            <div>
                                <h3 class="text-2xl font-bold" id="attendance-percent">87%</h3>
                                <p class="text-gray-500">Attendance</p>
                            </div>
                        </div>
                    </div>

                    <!-- Courses Progress -->
                <div class="max-w-2xl mx-auto">
    <div class="bg-white rounded-2xl shadow-md p-8 hover:shadow-lg transition-shadow">
        <h3 class="text-xl font-semibold mb-6 text-gray-800 border-b pb-3">Student Profile</h3>



        {{-- Profile Image --}}
        <div class="mb-6">
            <img src="{{ $student->profileimage ? asset('storage/' . $student->profileimage) : asset('images/default-avatar.png') }}"
                 alt="Profile Image"
                 class="w-32 h-32 rounded-full mx-auto object-cover border-4 border-gray-200 shadow">
        </div>





        <div class="space-y-4 text-gray-700">


            <div class="flex justify-between">
                <span class="font-medium text-gray-600">Name:</span>
                <span>{{ $student->name ?? 'Not provided' }}</span>
            </div>

             <div class="flex justify-between">
                <span class="font-medium text-gray-600">Student ID:</span>
                <span>{{ $student->student_id ?? 'Not provided' }}</span>
            </div>

            <div class="flex justify-between">
                <span class="font-medium text-gray-600">Phone:</span>
                <span>{{ $student->phoneNo ?? 'Not provided' }}</span>
            </div>

            <div class="flex justify-between">
                <span class="font-medium text-gray-600">Address:</span>
                <span class="text-right">{{ $student->address ?? 'Not provided' }}</span>
            </div>

            <div class="flex justify-between">
                <span class="font-medium text-gray-600">IC:</span>
                <span>{{ $student->ic }}</span>
            </div>

            <div class="flex justify-between">
                <span class="font-medium text-gray-600">Program:</span>
                <span>{{ $student->program }}</span>
            </div>

            <div class="flex justify-between">
                <span class="font-medium text-gray-600">Status:</span>
                <span class="{{ $student->status == 'active' ? 'text-green-600 font-semibold' : 'text-red-600 font-semibold' }}">
                    {{ ucfirst($student->status) }}
                </span>
            </div>
        </div>
    </div>
</div>


                    <!-- Performance Chart -->
                    {{-- <div class="card bg-white rounded-xl shadow-md p-6 mb-6 hover:shadow-lg transition-shadow">
                        <h3 class="text-lg font-semibold mb-4">Performance Overview</h3>
                        <div class="h-64">
                            <canvas id="performance-chart"></canvas>
                        </div>
                    </div> --}}
                </div>

                <!-- Courses Tab Content -->
                {{-- <div class="tab-content" id="courses-tab">
                    <div class="card bg-white rounded-xl shadow-md p-6 mb-6">
                        <div class="flex justify-between items-center mb-6">
                            <h2 class="text-xl font-semibold">Your Courses</h2>
                            <div class="flex space-x-2">
                                <div class="relative">
                                    <input type="text" placeholder="Search courses..."
                                        class="border rounded-lg pl-10 pr-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                                    <i class="fas fa-search absolute left-3 top-3 text-gray-400"></i>
                                </div>
                                <button class="bg-blue-600 text-white px-4 py-2 rounded-lg flex items-center">
                                    <i class="fas fa-plus mr-2"></i> Enroll New
                                </button>
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-5">
                            <div
                                class="course-card bg-blue-50 border-l-4 border-blue-500 rounded-lg p-4 hover:shadow-md transition">
                                <div class="flex justify-between items-start mb-3">
                                    <h3 class="font-semibold">Mathematics</h3>
                                    <span class="bg-blue-100 text-blue-800 text-xs px-2 py-1 rounded">Ongoing</span>
                                </div>
                                <p class="text-sm text-gray-600 mb-3">Prof. Robert Smith</p>
                                <div class="flex justify-between items-center">
                                    <div class="w-full bg-gray-200 rounded-full h-2.5">
                                        <div class="bg-blue-600 h-2.5 rounded-full" style="width: 75%"></div>
                                    </div>
                                    <span class="text-xs font-medium ml-2">75%</span>
                                </div>
                            </div>

                            <div
                                class="course-card bg-green-50 border-l-4 border-green-500 rounded-lg p-4 hover:shadow-md transition">
                                <div class="flex justify-between items-start mb-3">
                                    <h3 class="font-semibold">Physics</h3>
                                    <span class="bg-green-100 text-green-800 text-xs px-2 py-1 rounded">Ongoing</span>
                                </div>
                                <p class="text-sm text-gray-600 mb-3">Dr. Emily Johnson</p>
                                <div class="flex justify-between items-center">
                                    <div class="w-full bg-gray-200 rounded-full h-2.5">
                                        <div class="bg-green-600 h-2.5 rounded-full" style="width: 63%"></div>
                                    </div>
                                    <span class="text-xs font-medium ml-2">63%</span>
                                </div>
                            </div>

                            <div
                                class="course-card bg-purple-50 border-l-4 border-purple-500 rounded-lg p-4 hover:shadow-md transition">
                                <div class="flex justify-between items-start mb-3">
                                    <h3 class="font-semibold">Computer Science</h3>
                                    <span class="bg-purple-100 text-purple-800 text-xs px-2 py-1 rounded">Ongoing</span>
                                </div>
                                <p class="text-sm text-gray-600 mb-3">Prof. Alan Turing</p>
                                <div class="flex justify-between items-center">
                                    <div class="w-full bg-gray-200 rounded-full h-2.5">
                                        <div class="bg-purple-600 h-2.5 rounded-full" style="width: 10%"></div>
                                    </div>
                                    <span class="text-xs font-medium ml-2">10%</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> --}}
            </main>
        </div>


    </body>

    </html>
@endsection
