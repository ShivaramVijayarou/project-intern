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

    <!-- Filters -->
    <div class="row mb-3">
        <div class="col-12 d-flex justify-content-end">

            <form action="{{ route('admin.students.index') }}" method="GET" class="d-flex">

                <div class="input-group">

                    <!-- Search by Name / IC -->
                    <input type="text" name="search" class="form-control"
                           placeholder="Search by Name or IC"
                           value="{{ request('search') }}">

                    <!-- Search by Batch Code -->
                    <input type="text" name="batch_code" class="form-control"
                           placeholder="Search by Batch Code"
                           value="{{ request('batch_code') }}">

                    <!-- Program Filter -->
                    <select name="program" class="form-control">
                        <option value="">All Programs</option>
                        @foreach ($programs as $prog)
                            <option value="{{ $prog }}" {{ request('program') == $prog ? 'selected' : '' }}>
                                {{ $prog }}
                            </option>
                        @endforeach
                    </select>

                    <!-- Search Button -->
                    <button class="btn btn-primary" type="submit">
                        <i class="fas fa-search"></i> Search
                    </button>

                </div>
            </form>

            <!-- PDF Button (Same Size as Search Button) -->
            <form action="{{ route('admin.students.pdf') }}" method="GET" class="ms-2">

                <input type="hidden" name="search" value="{{ request('search') }}">
                <input type="hidden" name="program" value="{{ request('program') }}">
                <input type="hidden" name="batch_code" value="{{ request('batch_code') }}">

                <button class="btn btn-danger">
                    <i class="fas fa-file-pdf"></i> PDF
                </button>

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
                            <th>Batch Code</th>
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
                                    <img src="{{ $student->profileimage ? asset('storage/' . $student->profileimage) : asset('uploads/profile.png') }}"
                                         class="rounded-circle shadow"
                                         style="width: 80px; height: 80px; object-fit: cover;">
                                </td>

                                <td>{{ $student->student_id }}</td>
                                <td>{{ $student->batch_code }}</td>
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
                                    <a href="{{ route('admin.students.edit', $student->id) }}"
                                       class="btn btn-warning btn-sm" title="Edit">
                                        <i class="fas fa-edit"></i>
                                    </a>

                                    <form action="{{ route('admin.students.destroy', $student->id) }}"
                                          method="POST" class="d-inline-block"
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
                                <td colspan="50" class="text-center text-muted">
                                    No students found.
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
