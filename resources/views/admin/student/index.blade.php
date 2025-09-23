@extends('admin.layouts.master')

@section('content')
    <section class="section">
        <!-- Section Header -->
        <div class="section-header d-flex justify-content-between align-items-center">
            <h1>Students</h1>
            <a href="{{ route('admin.students.create') }}" class="btn btn-primary">
                <i class="fas fa-user-plus"></i> Add New Student
            </a>
        </div>

        <!-- Search Bar -->
        <div class="row mb-3">
            <div class="col-12 d-flex justify-content-end">
                <form action="{{ route('admin.students.index') }}" method="GET" class="form-inline">
                    <div class="input-group">
                        <input
                            type="text"
                            name="search"
                            class="form-control"
                            placeholder="Search by name or student ID"
                            value="{{ request('search') }}"
                        >
<select name="program" class="form-control">
            <option value="">All Programs</option>
            @foreach($programs as $prog)
                <option value="{{ $prog }}" {{ request('program') == $prog ? 'selected' : '' }}>
                    {{ $prog }}
                </option>
            @endforeach
        </select>

                        <div class="input-group-append">
                            <button class="btn btn-primary" type="submit">Search</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <!-- Students Table -->
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover table-bordered align-middle text-center">
                        <thead class="thead-dark">
                            <tr>
                                <th>Photo</th>
                                <th>Student ID</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>Address</th>
                                <th>Program</th>
                                <th>Level</th>
                                <th>IC No</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>

                        <tbody>
                            @forelse ($students as $student)
                                <tr>
                                    <td>
                                        <img
                                            src="{{ $student->profileimage
                                                ? asset('storage/' . $student->profileimage)
                                                : asset('uploads/profile.png') }}"
                                            alt="Profile Image"
                                            class="rounded-circle shadow"
                                            style="width: 80px; height: 80px; object-fit: cover;"
                                        >
                                    </td>
                                    <td>{{ $student->student_id }}</td>
                                    <td>{{ ucwords(strtolower($student->name)) }}</td>
                                    <td>{{ $student->email }}</td>
                                    <td>{{ $student->phoneNo }}</td>
                                    <td>{{ $student->address }}</td>
                                    <td>{{ $student->program }}</td>
                                    <td>{{ $student->level }}</td>
                                    <td>{{ $student->ic }}</td>
                                    <td>
                                        @if ($student->status === 'active')
                                            <span class="badge bg-success">Active</span>
                                        @else
                                            <span class="badge bg-danger">Inactive</span>
                                        @endif
                                    </td>
                                    <td>
                                        {{-- <a href="{{ route('admin.students.show', $student->id) }}" class="btn btn-info btn-sm" title="View"> <i class="fas fa-eye"></i> </a> --}}
                                        <a href="{{ route('admin.students.edit', $student->id) }}"
                                           class="btn btn-warning btn-sm" title="Edit">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form action="{{ route('admin.students.destroy', $student->id) }}"
                                              method="POST"
                                              class="d-inline-block"
                                              onsubmit="return confirm('Are you sure you want to delete this student?')">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-danger btn-sm" title="Delete">
                                                <i class="fas fa-trash-alt"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="10" class="text-center text-muted">
                                        No students found. Click "Add New Student" to create one.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                <div class="d-flex justify-content-center mt-3">
                    {{ $students->appends(request()->query())->links() }}
                </div>
            </div>
        </div>
    </section>
@endsection
