@extends('admin.layouts.master')

@section('content')

<section class="section">
    <div class="section-header d-flex justify-content-between align-items-center">
        <h1>Examination Details| student's examination details</h1>
        {{-- {{ route('admin.add.student') }} --}}
        <a href="{{ route('admin.exams.create') }}" class="btn btn-primary">
           <i class="fas fa-table"></i> Add Examination Details
        </a>
    </div>

    {{-- Search Bar --}}
    <div class="row mb-3">
        <div class="col-12 d-flex justify-content-end">
            {{-- {{ route('admin.exams.store') }} --}}
            <form action="#" method="GET" class="form-inline">
                <div class="input-group">
                    <input type="text" name="search" class="form-control" placeholder="Search by Course Code ">
                    <div class="input-group-append">
                        <button class="btn btn-primary" type="submit">Search</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            {{-- @if($students->isEmpty())
                <div class="alert alert-info">
                    No students found. Click "Add New Student" to create one.
                </div>
            @else --}}
                <div class="table-responsive">
                    <table class="table table-hover table-bordered align-middle text-center">
                        <thead class="thead-dark">
                            <tr>
                                <th>Course Code</th>
                                <th>Course Name</th>
                                 <th>Program</th>
                                <th>Time</th>
                                <th>Date</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($exams as $exam)
                                <tr>
                                    <td>{{ $exam->course_code }}</td>
                                    <td>{{ $exam->course_name }}</td>
                                    <td>{{ $exam->program }}</td>
                                    <td>{{ \Carbon\Carbon::parse($exam->exam_date)->format('d M Y (l)') }}</td>
                                    <td>
                                        {{ \Carbon\Carbon::parse($exam->time_from)->format('h:i A') }}
                                        -
                                        {{ \Carbon\Carbon::parse($exam->time_to)->format('h:i A') }}
                                    </td>
                                    <td>
                                        <a href="{{ route('admin.exams.edit', $exam->id) }}" class="btn btn-warning btn-sm" title="Edit">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form action="{{ route('admin.exams.destroy', $exam->id) }}" method="POST" class="d-inline-block"
                                            onsubmit="return confirm('Are you sure you want to delete this exam?')">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-danger btn-sm" title="Delete">
                                                <i class="fas fa-trash-alt"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            {{-- @endif --}}
        </div>
    </div>
</section>
@endsection
