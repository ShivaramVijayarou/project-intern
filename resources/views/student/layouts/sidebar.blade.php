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

        {{-- <a href="{{ route('student.elibrary') }}"
           class="flex items-center w-full p-3 rounded-lg transition
           {{ request()->routeIs('student.elibrary') ? 'bg-blue-100 text-blue-600' : 'hover:bg-gray-200 text-gray-700' }}">
            <i class="fas fa-book-open w-5 h-5 mr-3"></i>E-Library
        </a>

<a href="{{ route('student.kaunseling') }}"
       class="flex items-center w-full p-3 rounded-lg transition
       {{ request()->routeIs('student.kaunseling') ? 'bg-blue-100 text-blue-600' : 'hover:bg-gray-200 text-gray-700' }}">
        <i class="fas fa-comments w-5 h-5 mr-3"></i> Kaunseling
    </a> --}}


    {{-- ✅ Services Dropdown for Student (Tailwind version) --}}
<div x-data="{ open: false }" class="space-y-1">
    <!-- Button -->
    <button @click="open = !open"
        class="flex items-center w-full p-3 rounded-lg transition
               hover:bg-gray-200 text-gray-700 focus:outline-none">
        <i class="fas fa-wrench w-5 h-5 mr-3"></i>
        <span class="flex-1 text-left">Services</span>
        <i :class="open ? 'fas fa-chevron-up' : 'fas fa-chevron-down'" class="w-4 ml-auto"></i>
    </button>

    <!-- Dropdown items -->
    <div x-show="open" x-collapse class="pl-8 space-y-1">
        <a href="{{ route('student.elibrary') }}"
           class="flex items-center w-full p-2 rounded-lg transition
           {{ request()->routeIs('student.elibrary') ? 'bg-blue-100 text-blue-600' : 'hover:bg-gray-200 text-gray-700' }}">
            <i class="fas fa-book-open w-5 h-5 mr-3"></i>E-Library
        </a>

        <a href="{{ route('student.kaunseling') }}"
           class="flex items-center w-full p-2 rounded-lg transition
           {{ request()->routeIs('student.kaunseling') ? 'bg-blue-100 text-blue-600' : 'hover:bg-gray-200 text-gray-700' }}">
            <i class="fas fa-user-friends w-5 h-5 mr-3"></i>Kaunseling
        </a>

         <a href="{{ route('student.info') }}"
           class="flex items-center w-full p-2 rounded-lg transition
           {{ request()->routeIs('student.info') ? 'bg-blue-100 text-blue-600' : 'hover:bg-gray-200 text-gray-700' }}">
            <i class="fa-solid fa-book w-5 h-5 mr-3"></i>Info KTM
        </a>
    </div>
</div>

        <a href="{{ route('student.result') }}"
           class="flex items-center w-full p-3 rounded-lg transition
           {{ request()->routeIs('student.result') ? 'bg-blue-100 text-blue-600' : 'hover:bg-gray-200 text-gray-700' }}">
            <i class="fas fa-pencil-ruler w-5 h-5 mr-3"></i> Exam Result
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
