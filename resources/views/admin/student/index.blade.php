@extends('admin.layouts.master')

@section('content')
    <section class="section">
        <div class="section-header d-flex justify-content-between align-items-center">
            <h1>Students</h1>

            <a href="{{ route('admin.students.create') }}" class="btn btn-primary">
                <i class="fas fa-user-plus"></i> Add New Student
            </a>
        </div>

        {{-- Search Bar --}}
        <div class="row mb-3">
            <div class="col-12 d-flex justify-content-end">
                {{-- {{ route('admin.view.students') }} --}}
               <form action="{{ route('admin.students.index') }}" method="GET" class="form-inline">
    <div class="input-group">
        <input type="text" name="search" class="form-control"
            placeholder="Search student ID" value="{{ request('search') }}">
        <div class="input-group-append">
            <button class="btn btn-primary" type="submit">Search</button>
        </div>
    </div>
</form>
            </div>
        </div>

        <div class="card">
            <div class="card-body">
                {{-- @if ($students->isEmpty())
                <div class="alert alert-info">
                    No students found. Click "Add New Student" to create one.
                </div>
            @else --}}
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
                                <th>IC No</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>

                            @foreach ($students as $student)
                                <tr>
                                    <td>
                                        <img src="{{ asset($student->profileimage) }}" class="img-thumbnail"
                                            style="width: 80px; height: 80px; object-fit: cover;">
                                    </td>
                                    <td>{{ $student->student_id }}</td>
                                    <td>{{ $student->name }}</td>
                                    <td>{{ $student->email }}</td>
                                    <td>{{ $student->phoneNo }}</td>
                                    <td>{{ $student->address }}</td>
                                    <td>{{ $student->program }}</td>
                                    <td>{{ $student->ic }}</td>
                                    <td>
                                        @if ($student->status == 'active')
                                            <span class="badge bg-success">Active</span>
                                        @else
                                            <span class="badge bg-danger">Inactive</span>
                                        @endif
                                    </td>


                                    <td>
                                        {{-- {{ route('admin.view.student', $student->id) }} --}}
                                        {{-- <a href="#" class="btn btn-info btn-sm" title="View">
                                            <i class="fas fa-eye"></i>
                                        </a> --}}

                                        {{-- {{ route('admin.edit.student', $student->id) }} --}}
                                        <a href="{{ route('admin.students.edit', $student->id) }}" class="btn btn-warning btn-sm" title="Edit">
                                            <i class="fas fa-edit"></i>
                                        </a>

                                        {{-- {{ route('admin.delete.student', $student->id) }} --}}
                                        <form action="{{ route('admin.students.destroy', $student->id) }}" method="POST" class="d-inline-block"
                                            onsubmit="return confirm('Are you sure you want to delete this student?')">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-danger btn-sm" title="Delete">
                                                <i class="fas fa-trash-alt"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                            {{-- @foreach ($students as $student)
                                <tr>






                                    <td>{{ \Illuminate\Support\Str::limit($student->address, 40) }}</td>
                                    <td>
                                        <a href="{{ route('admin.view.student', $student->id) }}" class="btn btn-info btn-sm" title="View">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <a href="{{ route('admin.edit.student', $student->id) }}" class="btn btn-warning btn-sm" title="Edit">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form action="{{ route('admin.delete.student', $student->id) }}" method="POST"
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
                            @endforeach --}}
                        </tbody>


<div class="d-flex justify-content-center mt-3">
    {{ $students->appends(request()->query())->links() }}
</div>


                    </table>


                </div>
                {{-- @endif --}}
            </div>
        </div>
    </section>
@endsection
