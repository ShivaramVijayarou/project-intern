@extends('admin.layouts.master')

@section('content')
<section class="section">

    <div class="section-header d-flex justify-content-between align-items-center">
        <h1>Student Details</h1>
        <a href="{{ route('admin.students.index') }}" class="btn btn-secondary">
            Back to List
        </a>
    </div>

    <div class="row">

        <!-- STUDENT DETAILS -->
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h4>Student Information</h4>
                </div>
                <div class="card-body">

                    <div class="text-center mb-3">
                        <img src="{{ asset('storage/'.$student->profileimage) }}"
                             class="rounded-circle shadow"
                             style="width:120px; height:120px; object-fit:cover;">
                    </div>

                    <p><strong>Student ID:</strong> {{ $student->student_id }}</p>
                    <p><strong>Name:</strong> {{ $student->name }}</p>
                    <p><strong>Email:</strong> {{ $student->email }}</p>
                    <p><strong>Phone:</strong> {{ $student->phoneNo }}</p>
                    <p><strong>IC No:</strong> {{ $student->ic }}</p>
                    <p><strong>Program:</strong> {{ $student->program }}</p>
                    <p><strong>Level:</strong> {{ $student->level }}</p>
                    <p><strong>Batch Code:</strong> {{ $student->batch_code }}</p>
                    <p><strong>Start Date:</strong> {{ optional($student->start_date)->format('d M Y') }}</p>
                    <p><strong>End Date:</strong> {{ optional($student->end_date)->format('d M Y') }}</p>
                    <p><strong>Status:</strong>
                        @if($student->status === 'active')
                            <span class="badge bg-success">Active</span>
                        @else
                            <span class="badge bg-danger">Inactive</span>
                        @endif
                    </p>

                </div>
            </div>
        </div>

        <!-- PARENT DETAILS (SAME TABLE, JUST DISPLAYED SEPARATELY) -->
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h4>Parent / Guardian Details</h4>
                </div>
                <div class="card-body">

                    <p><strong>Name:</strong> {{ $student->parent_name ?? '-' }}</p>
                    <p><strong>Relationship:</strong> {{ $student->parent_relationship ?? '-' }}</p>
                    <p><strong>Phone:</strong> {{ $student->parent_phone ?? '-' }}</p>
                    <p><strong>Email:</strong> {{ $student->parent_email ?? '-' }}</p>
                    <p><strong>Occupation:</strong> {{ $student->parent_occupation ?? '-' }}</p>
                    {{-- <p><strong>Salary (RM):</strong> {{ $student->salary ?? '-' }}</p> --}}
                    <p><strong>Salary (RM):</strong>
    {{ $student->salary ? number_format($student->salary, 2) : '-' }}
</p>
                    <p><strong>Address:</strong> {{ $student->parent_address ?? '-' }}</p>

                </div>
            </div>
        </div>

    </div>

</section>
@endsection
