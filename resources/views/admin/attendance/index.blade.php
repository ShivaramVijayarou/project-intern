@extends('admin.layouts.master')

@section('content')
<section class="section">
    <div class="section-header d-flex justify-content-between align-items-center">
        <h1>
            Attendance
            @if(request('date'))
                for {{ \Carbon\Carbon::parse(request('date'))->format('d M Y') }}
            @endif
        </h1>
        <a href="{{ route('admin.attendance.create') }}" class="btn btn-primary">
            <i class="fas fa-plus"></i> Add Attendance
        </a>
    </div>

    {{-- 🔎 Filters --}}
    <div class="row mb-3">
        <div class="col-12">
            <form action="{{ route('admin.attendance.index') }}" method="GET" class="form-inline d-flex flex-wrap gap-2 justify-content-end">

                {{-- Date Filter --}}
                <div class="input-group">
                    <input type="date" name="date" class="form-control"
                           value="{{ request('date') }}">
                </div>

                {{-- Search by Name --}}
                <div class="input-group">
                    <input type="text" name="search" class="form-control" placeholder="Search by student name"
                           value="{{ request('search') }}">
                </div>

                {{-- Student Dropdown (optional, if you want to filter by a specific student) --}}
                {{-- <div class="input-group">
                    <select name="student_id" class="form-control">
                        <option value="">-- All Students --</option>
                        @foreach($users as $user)
                            <option value="{{ $user->student_id }}" {{ request('student_id') == $user->student_id ? 'selected' : '' }}>
                                {{ $user->name }}
                            </option>
                        @endforeach
                    </select>
                </div> --}}


                <div class="input-group mr-2">
                        <select name="level" class="form-control">
                            <option value="">All Levels</option>
                            <option value="level 2" {{ request('level') == 'level 2' ? 'selected' : '' }}>Level 2</option>
                            <option value="level 3" {{ request('level') == 'level 3' ? 'selected' : '' }}>Level 3</option>
                            <option value="level 4" {{ request('level') == 'level 4' ? 'selected' : '' }}>Level 4</option>
                            {{-- Or dynamically load levels from DB --}}
                            {{-- @foreach ($levels as $level)
                            <option value="{{ $level }}" {{ request('level') == $level ? 'selected' : '' }}>{{ $level }}</option>
                             @endforeach --}}
                        </select>
                    </div>

                {{-- Submit --}}
                <div class="input-group-append">
                    <button class="btn btn-primary" type="submit">
                        <i class="fas fa-search"></i> Filter
                    </button>
                </div>
            </form>
        </div>
    </div>

    {{-- Attendance Table --}}
    <div class="card">
        <div class="card-body">
            @if($attendances->isEmpty())
                <div class="alert alert-info text-center">
                    No attendance records found.
                </div>
            @else
                <div class="table-responsive">
                    <table class="table table-hover table-bordered align-middle text-center">
                        <thead class="thead-dark">
                            <tr>
                                <th>Date</th>
                                <th>Student</th>
                                <th>Level</th>
                                <th>Program</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($attendances as $attendance)
                                <tr>
                                    <td>{{ \Carbon\Carbon::parse($attendance->date)->format('d M Y') }}</td>
                                    <td>{{ $attendance->student->name }}</td>
                                     <td>{{ $attendance->student->level }}</td>
                                      <td>{{ $attendance->student->program }}</td>
                                    <td>
                                        @if($attendance->status == 'present')
                                            <span class="badge badge-success">Present</span>
                                        @elseif($attendance->status == 'absent')
                                            <span class="badge badge-danger">Absent</span>
                                        @else
                                            <span class="badge badge-warning">Late</span>
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{ route('admin.attendance.edit', $attendance->id) }}"
                                           class="btn btn-warning btn-sm">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form action="{{ route('admin.attendance.destroy', $attendance->id) }}"
                                              method="POST" class="d-inline-block"
                                              onsubmit="return confirm('Are you sure?')">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-danger btn-sm">
                                                <i class="fas fa-trash-alt"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                {{-- Pagination --}}
                <div class="mt-3">
                    {{ $attendances->links() }}
                </div>
            @endif
        </div>
    </div>
</section>
@endsection
