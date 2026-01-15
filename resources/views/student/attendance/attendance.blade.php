@extends('student.layouts.master')

@section('content')
<div class="bg-gray-100 min-h-screen">
    <div class="flex">
        <main class="flex-1 p-4 md:p-6 overflow-y-auto">

            <div class="bg-white rounded-2xl shadow-md p-6 hover:shadow-lg transition-shadow">

                <h2 class="text-xl font-semibold text-gray-800 border-b pb-3 mb-6">
                    📊 My Attendance
                </h2>

                <!-- Student Info -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6 text-sm text-gray-700">
                    <p><strong>Batch:</strong> {{ $user->batch_code }}</p>
                    <p><strong>Program:</strong> {{ $user->program }}</p>
                    <p><strong>Attendance:</strong> {{ $percentage }}%</p>
                </div>

                <!-- Progress Bar -->
                <div class="w-full bg-gray-200 rounded-full h-3 mb-6">
                    <div class="bg-blue-600 h-3 rounded-full"
                         style="width: {{ $percentage }}%">
                    </div>
                </div>

                <!-- Attendance Table -->
                @if($attendances->isEmpty())
                    <div class="bg-yellow-100 text-yellow-700 p-4 rounded-lg text-center font-medium">
                        No attendance records found.
                    </div>
                @else
                    <div class="overflow-x-auto max-h-[450px] border rounded-lg">
                        <table class="w-full border-collapse">
                            <thead class="bg-blue-600 text-white sticky top-0 z-10">
                                <tr>
                                    <th class="px-6 py-3 text-left">Date</th>
                                    <th class="px-6 py-3 text-left">Status</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @foreach($attendances as $attendance)
                                    <tr class="hover:bg-gray-50 transition">
                                        <td class="px-6 py-4">
                                            {{ \Carbon\Carbon::parse($attendance->date)->format('d M Y') }}
                                        </td>
                                        <td class="px-6 py-4">
                                            <span class="
                                                px-3 py-1 rounded-full text-xs font-semibold
                                                @if($attendance->status === 'present') bg-green-100 text-green-700
                                                @elseif($attendance->status === 'late') bg-yellow-100 text-yellow-700
                                                @else bg-red-100 text-red-700
                                                @endif
                                            ">
                                                {{ ucfirst($attendance->status) }}
                                            </span>
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
