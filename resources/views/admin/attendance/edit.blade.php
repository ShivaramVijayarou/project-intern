@extends('admin.layouts.master')

@section('content')
<section class="section">
    <div class="section-header">
        <h1>Edit Attendance</h1>
    </div>

    <div class="card">
        <div class="card-body">
            <form action="{{ route('admin.attendance.update', $attendance->id) }}" method="POST">
                @csrf
                @method('PUT')

                <!-- Student Info (read-only) -->
                <div class="form-group mb-3">
                    <label>Student:</label>
                    <input type="text" class="form-control" value="{{ $attendance->student->name }}" disabled>
                </div>

                <!-- Date -->
                <div class="form-group mb-3">
                    <label for="date">Date:</label>
                    <input type="date" name="date" id="date" class="form-control"
                           value="{{ $attendance->date }}" required>
                </div>

                <!-- Status -->
                <div class="form-group mb-3">
                    <label for="status">Status:</label>
                    <select name="status" id="status" class="form-control" required>
                        <option value="present" {{ $attendance->status == 'present' ? 'selected' : '' }}>Present</option>
                        <option value="absent" {{ $attendance->status == 'absent' ? 'selected' : '' }}>Absent</option>
                        <option value="late" {{ $attendance->status == 'late' ? 'selected' : '' }}>Late</option>
                    </select>
                </div>

                <button type="submit" class="btn btn-primary">Update Attendance</button>
                <a href="{{ route('admin.attendance.index') }}" class="btn btn-secondary">Cancel</a>
            </form>
        </div>
    </div>
</section>
@endsection
