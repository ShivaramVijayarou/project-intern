    @extends('admin.layouts.master')

    @section('content')
        <section class="section">
            <div class="section-body">

                <!-- Header -->
                <div class="section-header d-flex justify-content-between align-items-center">
                    <h1>Staff Profile</h1>

                    <div>
                        <a href="{{ route('admin.staff.edit', $staff->id) }}" class="btn btn-warning">
                            <i class="fas fa-edit"></i> Edit
                        </a>

                        <a href="{{ route('admin.staff.index') }}" class="btn btn-secondary">
                            <i class="fas fa-arrow-left"></i> Back
                        </a>
                    </div>
                </div>

                <div class="row">

                    <!-- LEFT: Profile Summary -->
                    <div class="col-md-4">
                        <div class="card shadow-sm text-center">
                            <div class="card-body">

                                <!-- Avatar -->
                                <img src="{{ $staff->profileimage ? asset('storage/' . $staff->profileimage) : asset('uploads/profile.png') }}"
                                    class="rounded-circle" style="width: 80px; height: 80px; object-fit: cover;">

                                <h4>{{ ucwords(strtolower($staff->name)) }}</h4>
                                <p class="text-muted">{{ $staff->staff_id }}</p>

                                <!-- Status -->
                                @if ($staff->status === 'active')
                                    <span class="badge bg-success">Active</span>
                                @else
                                    <span class="badge bg-danger">Inactive</span>
                                @endif

                                <hr>

                                <p><strong>Department:</strong><br>{{ $staff->department ?? '-' }}</p>
                                <p><strong>Level:</strong><br>{{ $staff->level ?? '-' }}</p>

                            </div>
                        </div>
                    </div>

                    <!-- RIGHT: Details -->
                    <div class="col-md-8">

                        <div class="card shadow-sm mb-4">
                            <div class="card-header">
                                <h5>Staff Information</h5>
                            </div>

                            <div class="card-body">
                                <div class="row">

                                    <div class="col-md-6 mb-3">
                                        <strong>Email</strong><br>
                                        {{ $staff->email ?? '-' }}
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <strong>Phone</strong><br>
                                        {{ $staff->phone ?? '-' }}
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <strong>IC No</strong><br>
                                        {{ $staff->ic_no ?? '-' }}
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <strong>Start Date</strong><br>
                                        {{ optional($staff->start_date)->format('d M Y') ?? '-' }}
                                    </div>

                                </div>
                            </div>
                        </div>

                        <!-- FAMILY SECTION -->
                        <div class="card shadow-sm">
                            <div class="card-header">
                                <h5>Parents / Spouse Details</h5>
                            </div>

                            <div class="card-body">

                                @forelse($staff->families as $families)
                                    <div class="border rounded p-3 mb-3">

                                        <div class="row">

                                            <div class="col-md-6 mb-2">
                                                <strong>Name</strong><br>
                                                {{ $families->name }}
                                            </div>

                                            <div class="col-md-6 mb-2">
                                                <strong>Relationship</strong><br>
                                                {{ $families->relationship }}
                                            </div>

                                            <div class="col-md-6 mb-2">
                                                <strong>Phone</strong><br>
                                                {{ $families->phone ?? '-' }}
                                            </div>

                                            <div class="col-md-6 mb-2">
                                                <strong>Email</strong><br>
                                                {{ $families->email ?? '-' }}
                                            </div>

                                            <div class="col-md-6 mb-2">
                                                <strong>Occupation</strong><br>
                                                {{ $families->occupation ?? '-' }}
                                            </div>

                                            <div class="col-md-12 mb-2">
                                                <strong>Company Address</strong><br>
                                                {{ $families->company_address ?? '-' }}
                                            </div>

                                        </div>

                                    </div>
                                @empty
                                    <p class="text-muted text-center">No family information available.</p>
                                @endforelse

                            </div>
                        </div>

                    </div>
                </div>

            </div>
        </section>
    @endsection
