@extends('student.layouts.master')

@section('content')
<div class="bg-gray-100 min-h-screen" x-data="{ showImage: false }">
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
                    <h1 class="text-2xl font-bold text-gray-800">My Profile</h1>
                </div>
            </header>

            <!-- Profile & Password Section -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 max-w-6xl mx-auto">

                <!-- Student Profile -->
                <div class="bg-white rounded-2xl shadow-md p-8 hover:shadow-lg transition-shadow">
                    <h3 class="text-xl font-semibold mb-6 text-gray-800 border-b pb-3">Student Profile</h3>

                    <!-- Profile Image & Basic Info -->
                    <div class="mb-6 flex flex-col items-center">
                        <div class="relative cursor-pointer" @click="showImage = true">
                            <img src="{{ $student->profileimage
                                        ? asset('storage/' . $student->profileimage)
                                        : asset('images/default-avatar.png') }}"
                                 alt="Profile Image"
                                 class="w-40 h-40 md:w-48 md:h-48 rounded-full object-cover border-4 border-blue-200 shadow-lg transition hover:scale-105">
                        </div>
                        <p class="mt-4 font-bold text-gray-900 text-xl text-center">
                            {{ $student->name ?? 'Not provided' }}
                        </p>
                        <p class="text-sm text-gray-500 text-center">{{ $student->student_id ?? '' }}</p>
                    </div>

                    <!-- Profile Details -->
                    <div class="space-y-4 text-gray-700">
                        <div class="grid grid-cols-3 gap-2">
                            <span class="font-medium text-gray-600">Phone:</span>
                            <span class="col-span-2 text-right">{{ $student->phoneNo ?? 'Not provided' }}</span>
                        </div>
                        <div class="grid grid-cols-3 gap-2">
                            <span class="font-medium text-gray-600">Address:</span>
                            <span class="col-span-2 text-right">{{ $student->address ?? 'Not provided' }}</span>
                        </div>
                        <div class="grid grid-cols-3 gap-2">
                            <span class="font-medium text-gray-600">IC:</span>
                            <span class="col-span-2 text-right">{{ $student->ic ?? 'Not provided' }}</span>
                        </div>
                        <div class="grid grid-cols-3 gap-2">
                            <span class="font-medium text-gray-600">Program:</span>
                            <span class="col-span-2 text-right">{{ $student->program ?? 'Not provided' }}</span>
                        </div>
                        <div class="grid grid-cols-3 gap-2">
                            <span class="font-medium text-gray-600">Status:</span>
                            <span class="col-span-2 text-right
                                {{ $student->status == 'active'
                                    ? 'text-green-600 font-semibold'
                                    : 'text-red-600 font-semibold' }}">
                                {{ ucfirst($student->status) }}
                            </span>
                        </div>
                    </div>
                </div>

                <!-- Change Password -->
                <div class="bg-white rounded-2xl shadow-md p-8 hover:shadow-lg transition-shadow">
                    <h3 class="text-xl font-semibold mb-6 text-gray-800 border-b pb-3">Change Password</h3>

                    <!-- Success / Error Messages -->
                    @if (session('status'))
                        <div class="bg-green-100 text-green-700 p-3 rounded mb-4">
                            {{ session('status') }}
                        </div>
                    @endif

                    @if ($errors->any())
                        <div class="bg-red-100 text-red-700 p-3 rounded mb-4">
                            <ul class="list-disc pl-5">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <!-- Change Password Form -->
                    <form action="{{ route('student.profile.password.update') }}" method="POST" class="space-y-5">
                        @csrf
                        @method('PUT')

                        <div>
                            <label class="block text-gray-700 font-medium mb-2">Current Password</label>
                            <input type="password" name="current_password"
                                   class="w-full border rounded-lg px-4 py-2 focus:outline-none
                                          focus:ring-2 focus:ring-blue-500 shadow-sm">
                        </div>

                        <div>
                            <label class="block text-gray-700 font-medium mb-2">New Password</label>
                            <input type="password" name="password"
                                   class="w-full border rounded-lg px-4 py-2 focus:outline-none
                                          focus:ring-2 focus:ring-blue-500 shadow-sm">
                        </div>

                        <div>
                            <label class="block text-gray-700 font-medium mb-2">Confirm Password</label>
                            <input type="password" name="password_confirmation"
                                   class="w-full border rounded-lg px-4 py-2 focus:outline-none
                                          focus:ring-2 focus:ring-blue-500 shadow-sm">
                        </div>

                        <button type="submit"
                                class="w-full bg-blue-600 text-white px-6 py-3 rounded-lg
                                       shadow hover:bg-blue-700 transition font-semibold">
                            Save Changes
                        </button>
                    </form>
                </div>
            </div>
        </main>
    </div>

    <!-- Image Modal -->
    <div x-show="showImage"
         x-transition
         class="fixed inset-0 bg-black bg-opacity-75 flex items-center justify-center z-50 p-4"
         @click.away="showImage = false"
         @keydown.escape.window="showImage = false">

        <img src="{{ $student->profileimage
                    ? asset('storage/' . $student->profileimage)
                    : asset('images/default-avatar.png') }}"
             alt="Enlarged Profile Image"
             class="max-h-[90vh] max-w-[90vw] rounded-xl shadow-2xl border-4 border-white">
    </div>
</div>
@endsection
