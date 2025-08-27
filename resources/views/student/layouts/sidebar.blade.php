<aside class="sidebar w-64 bg-white shadow-xl p-4 flex flex-col justify-between h-screen">
    <div>
        {{-- Student Info --}}
        <div class="flex items-center mb-6">
            <img src="{{ asset('storage/' . (Auth::user()->profileimage ?? 'default.png')) }}"
                 class="w-12 h-12 rounded-full mr-3 object-cover"
                 alt="Profile">
            <div>
                <h3 class="font-semibold">{{ Auth::user()->name ?? 'Student' }}</h3>
                <p class="text-sm text-gray-500">{{ Auth::user()->program ?? 'Program' }}</p>
            </div>
        </div>

        {{-- Sidebar Links --}}
        <nav class="space-y-2">
            <a href="{{ route('student.dashboard') }}"
               class="tab-btn flex items-center w-full p-3 rounded-lg transition
               {{ request()->routeIs('student.dashboard') ? 'bg-blue-100 text-blue-600' : 'hover:bg-gray-200 text-gray-700' }}">
               <i class="fas fa-home w-5 h-5 mr-3"></i> Dashboard
            </a>

            <a href="{{ route('student.notes') }}"
               class="tab-btn flex items-center w-full p-3 rounded-lg transition
               {{ request()->routeIs('student.notes') ? 'bg-blue-100 text-blue-600' : 'hover:bg-gray-200 text-gray-700' }}">
               <i class="fas fa-sticky-note w-5 h-5 mr-3"></i> Notes
            </a>

            <a href="{{ route('student.exams') }}"
               class="tab-btn flex items-center w-full p-3 rounded-lg transition
               {{ request()->routeIs('student.exams') ? 'bg-blue-100 text-blue-600' : 'hover:bg-gray-200 text-gray-700' }}">
               <i class="fas fa-tasks w-5 h-5 mr-3"></i> Examination Schedule
            </a>

            <a href="{{ route('student.profile') }}"
               class="tab-btn flex items-center w-full p-3 rounded-lg transition
               {{ request()->routeIs('student.profile') ? 'bg-blue-100 text-blue-600' : 'hover:bg-gray-200 text-gray-700' }}">
               <i class="fas fa-user w-5 h-5 mr-3"></i> Profile
            </a>
        </nav>
    </div>

    {{-- Logout --}}
    <div class="mt-auto">
        <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
           class="flex items-center w-full p-3 rounded-lg transition hover:bg-red-500 hover:text-white text-gray-700">
           <i class="fas fa-sign-out-alt w-5 mr-3"></i> Logout
        </a>

        <form id="logout-form" method="POST" action="{{ route('logout') }}" style="display: none;">
            @csrf
        </form>
    </div>
</aside>
