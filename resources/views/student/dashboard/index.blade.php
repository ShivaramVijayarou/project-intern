@extends('student.layouts.master')

@section('content')
<div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
    <div class="bg-white p-6 rounded-xl shadow">
        <h2 class="text-lg font-semibold mb-4">Welcome, {{ Auth::user()->name ?? 'Student' }} 🎉</h2>
        <p class="text-gray-600">Here you can see your quick updates.</p>
    </div>

    <div class="bg-white p-6 rounded-xl shadow">
        <h2 class="text-lg font-semibold mb-4">Upcoming Exams</h2>
        <p class="text-gray-600">Check your <a href="{{ route('student.exams') }}" class="text-blue-600">exam schedule</a>.</p>
    </div>
</div>
@endsection
