@extends('admin.layouts.master')

@section('content')
<section class="section">
    <div class="section-header">
        <h1>Mark Attendance</h1>
    </div>

    <div class="card">
        <div class="card-body">
            <form action="{{ route('admin.attendance.store') }}" method="POST">
                @csrf

                <!-- Select Date -->
                <div class="form-group mb-3">
                    <label for="date">Select Date:</label>
                    <input type="date" name="date" id="date" class="form-control" value="{{ now()->toDateString() }}" required>
                </div>

                <!-- Student Attendance Table -->
                <div class="table-responsive">
                    <table class="table table-bordered text-center">
                        <thead>
                            <tr>
                                <th>Student</th>
                                <th>Present</th>
                                <th>Absent</th>
                                <th>Late</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($students as $student)
                            <tr>
                                <td>{{ $student->name }}</td>
                                <td><input type="radio" name="attendance[{{ $student->id }}]" value="present" checked></td>
                                <td><input type="radio" name="attendance[{{ $student->id }}]" value="absent"></td>
                                <td><input type="radio" name="attendance[{{ $student->id }}]" value="late"></td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <button type="submit" class="btn btn-primary mt-3">Save Attendance</button>
            </form>
        </div>
    </div>
</section>
@endsection
