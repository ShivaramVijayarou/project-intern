@extends('admin.layouts.master')

@section('content')
<section class="section">

    <!-- Section Header -->
    <div class="section-header d-flex justify-content-between align-items-center">
        <h1>Staff</h1>
        <a href="{{ route('admin.staff.create') }}" class="btn btn-primary">
            <i class="fas fa-user-plus"></i> Add New Staff
        </a>
    </div>

    <!-- Filters -->
    <div class="row mb-3">
        <div class="col-12 d-flex justify-content-end">

            <form action="{{ route('admin.staff.index') }}" method="GET" class="d-flex">
                <div class="input-group">

                    <!-- Search -->
                    <input type="text" name="search" class="form-control"
                        placeholder="Search by Name / IC / Staff ID"
                        value="{{ request('search') }}">

                    <!-- Department -->
                    <select name="department" class="form-control">
                        <option value="">All Departments</option>
                        @foreach ($departments as $dept)
                            <option value="{{ $dept }}" {{ request('department') == $dept ? 'selected' : '' }}>
                                {{ $dept }}
                            </option>
                        @endforeach
                    </select>

                    <!-- Status -->
                    <select name="status" class="form-control">
                        <option value="">All Status</option>
                        <option value="active" {{ request('status') == 'active' ? 'selected' : '' }}>Active</option>
                        <option value="inactive" {{ request('status') == 'inactive' ? 'selected' : '' }}>Inactive</option>
                    </select>

                    <!-- Button -->
                    <button class="btn btn-primary" type="submit">
                        <i class="fas fa-search"></i> Search
                    </button>

                </div>
            </form>

        </div>
    </div>

    <!-- Table -->
    <div class="card">
        <div class="card-body">

            <div class="table-responsive">
                <table class="table table-hover table-bordered align-middle text-center">

                    <thead class="thead-dark">
                        <tr>
                            <th>Staff ID</th>
                            <th>Picture</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>IC No</th>
                            <th>Department</th>
                            <th>Level</th>
                            <th>Start Date</th>
                            <th>Family</th> <!-- NEW -->
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse ($staffs as $staff)
                            <tr>

                                <td>{{ $staff->staff_id }}</td>

                                <!-- Profile -->
                                <td>
                                    <img src="{{ $staff->profileimage ? asset('storage/' . $staff->profileimage) : asset('uploads/profile.png') }}"
                                        class="rounded-circle shadow"
                                        style="width: 70px; height: 70px; object-fit: cover;">
                                </td>

                                <!-- Name -->
                                <td>
                                    <a href="{{ route('admin.staff.show', $staff->id) }}">
                                        {{ ucwords(strtolower($staff->name)) }}
                                    </a>
                                </td>

                                <td>{{ $staff->email ?? '-' }}</td>
                                <td>{{ $staff->phone ?? '-' }}</td>
                                <td>{{ $staff->ic_no ?? '-' }}</td>
                                <td>{{ $staff->department ?? '-' }}</td>
                                <td>{{ $staff->level ?? '-' }}</td>
                                <td>{{ optional($staff->start_date)->format('d M Y') ?? '-' }}</td>

                                <!-- FAMILY COLUMN -->
                                <td>
                                    @if($staff->families->count() > 0)

                                        <!-- Count Badge -->
                                        <span class="badge bg-info">
                                            {{ $staff->families->count() }} Members
                                        </span>

                                        <!-- Small List Preview -->
                                        <div class="mt-1 text-start" style="font-size: 12px;">
                                            @foreach($staff->families->take(2) as $family)
                                                <div>• {{ $family->name }} ({{ $family->relationship }})</div>
                                            @endforeach

                                            @if($staff->families->count() > 2)
                                                <div class="text-muted">+ more...</div>
                                            @endif
                                        </div>

                                    @else
                                        <span class="text-muted">No Data</span>
                                    @endif
                                </td>

                                <!-- Status -->
                                <td>
                                    @if ($staff->status === 'active')
                                        <span class="badge bg-success">Active</span>
                                    @else
                                        <span class="badge bg-danger">Inactive</span>
                                    @endif
                                </td>

                                <!-- Actions -->
                                <td>
                                    <a href="{{ route('admin.staff.show', $staff->id) }}"
                                        class="btn btn-info btn-sm" title="View">
                                        <i class="fas fa-eye"></i>
                                    </a>

                                    <a href="{{ route('admin.staff.edit', $staff->id) }}"
                                        class="btn btn-warning btn-sm" title="Edit">
                                        <i class="fas fa-edit"></i>
                                    </a>

                                    <form action="{{ route('admin.staff.destroy', $staff->id) }}"
                                        method="POST"
                                        class="d-inline-block"
                                        onsubmit="return confirm('Are you sure you want to delete this staff?')">
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
                                <td colspan="20" class="text-center text-muted">
                                    No staff found.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>

                </table>
            </div>

            <!-- Pagination -->
            <div class="d-flex justify-content-center mt-3">
                {{ $staffs->appends(request()->query())->links() }}
            </div>

        </div>
    </div>

</section>
@endsection
