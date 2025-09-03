<aside class="sidebar w-64 bg-white shadow-xl p-4 flex flex-col h-screen">
    @php
        // If you use a separate guard for students, switch to: auth('student')->user()
        $user = auth()->user();
        $imgPath = $user && $user->profileimage
            ? asset('storage/' . ltrim($user->profileimage, '/'))
            : asset('uploads/profile.png');
    @endphp

    <!-- Profile Section -->
    <div class="flex flex-col items-center text-center mb-8">
        <img src="{{ $imgPath }}"
             alt="Profile Image"
             class="w-28 h-28 rounded-full object-cover border-4 border-gray-300 shadow-md" />
        <p class="mt-3 font-semibold text-gray-800">
            {{ $user->name ?? 'Not provided' }}
        </p>
        <p class="text-sm text-gray-500">
            {{ $user->student_id ?? '' }}
        </p>
    </div>

    <!-- Navigation -->
    <nav class="space-y-2 flex-1">
        <a href="{{ route('dashboard') }}"
           class="flex items-center w-full p-3 rounded-lg transition
           {{ request()->routeIs('student.dashboard') ? 'bg-blue-100 text-blue-600' : 'hover:bg-gray-200 text-gray-700' }}">
            <i class="fas fa-home w-5 h-5 mr-3"></i> Dashboard
        </a>

        <a href="{{ route('student.notes') }}"
           class="flex items-center w-full p-3 rounded-lg transition
           {{ request()->routeIs('student.notes') ? 'bg-blue-100 text-blue-600' : 'hover:bg-gray-200 text-gray-700' }}">
            <i class="fas fa-sticky-note w-5 h-5 mr-3"></i> Notes
        </a>

        <a href="{{ route('student.exams') }}"
           class="flex items-center w-full p-3 rounded-lg transition
           {{ request()->routeIs('student.exams') ? 'bg-blue-100 text-blue-600' : 'hover:bg-gray-200 text-gray-700' }}">
            <i class="fas fa-tasks w-5 h-5 mr-3"></i> Examination Schedule
        </a>

        <a href="{{ route('student.profile') }}"
           class="flex items-center w-full p-3 rounded-lg transition
           {{ request()->routeIs('student.profile') ? 'bg-blue-100 text-blue-600' : 'hover:bg-gray-200 text-gray-700' }}">
            <i class="fas fa-user w-5 h-5 mr-3"></i> Profile
        </a>
    </nav>

    <!-- Logout Button -->
    <div class="mt-6">
        <a href="#"
           onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
           class="flex items-center w-full p-3 rounded-lg transition hover:bg-red-500 hover:text-white text-gray-700">
            <i class="fas fa-sign-out-alt w-5 mr-3"></i> Logout
        </a>

        <form id="logout-form" method="POST" action="{{ route('logout') }}" class="hidden">
            @csrf
        </form>
    </div>
</aside>
  