<h2 class="text-xl font-bold mb-4">My Attendance</h2>

<table class="table-auto w-full border">
    <thead>
        <tr>
            <th class="px-4 py-2">Date</th>
            <th class="px-4 py-2">Status</th>
        </tr>
    </thead>
    <tbody>
        @forelse($attendances as $attendance)
        <tr>
            <td class="border px-4 py-2">{{ $attendance->date }}</td>
            <td class="border px-4 py-2 capitalize">{{ $attendance->status }}</td>
        </tr>
        @empty
        <tr>
            <td colspan="2" class="text-center text-gray-500">No attendance records found.</td>
        </tr>
        @endforelse
    </tbody>
</table>
