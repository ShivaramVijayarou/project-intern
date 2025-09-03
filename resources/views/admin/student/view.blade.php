@extends('admin.layouts.master')

@section('content')
<section class="section">
    <div class="section-header d-flex justify-content-between align-items-center">
        <h1>Menu Items</h1>
        <a href="{{ route('admin.add.menu') }}" class="btn btn-primary">
            <i class="fas fa-plus"></i> Add New Item
        </a>
    </div>

 {{-- Search Bar --}}
<div class="row mb-3">
    <div class="col-12 d-flex justify-content-end">
        <form action="{{ route('admin.view.menu') }}" method="GET" class="form-inline">
            <div class="input-group">
                <input type="text" name="search" class="form-control" placeholder="Search menu by name">
                <div class="input-group-append">
                    <button class="btn btn-primary" type="submit">Search</button>
                </div>

            </div>
        </form>
    </div>
</div>


    {{-- Student Table --}}
    <div class="card">
        <div class="card-body">
            @if($students->isEmpty())
                <div class="alert alert-info">
                    Student Not Found
                </div>
            @else
                <div class="table-responsive">
                    <table class="table table-bordered table-hover text-center">
                        <thead class="thead-dark">
                            <tr>
                                <th>Image</th>
                                <th>StudentID</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>Address</th>
                                <th>Program</th>
                                <th>IC No</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($students as $student)
                                <tr>
                                    <td>
                                      <img src="{{ $student->profileimage ? asset('storage/' . $student->profileimage) : asset('uploads/profile.png') }}"
                                            alt="Profile Image"
                                            class="w-32 h-32 rounded-full object-cover border-4 border-gray-200 shadow" style="width: 80px; height: 80px; object-fit: cover;">
                                    </td>

                                    <td>{{ $student->name }}</td>
                                    <td>RM {{ number_format($student->price, 2) }}</td>
                                    <td>{{ $student->category }}</td>
                                    <td>{{ $student->quantity }}</td>
                                    <td>{{ \Illuminate\Support\Str::limit($student->description, 50) }}</td>
                                    <td>
                                        {{-- {{ route('admin.view.menu', $student->id) }} --}}
                                        <a href="{{ route('admin.view.student', $student->id) }}" class="btn btn-info btn-sm" title="View">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        {{-- {{ route('admin.edit.menu', $student->id) }} --}}
                                        <a href="#" class="btn btn-warning btn-sm" title="Edit">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        {{-- {{ route('admin.delete.menu', $student->id) }} --}}
                                        <form action="#" method="POST" class="d-inline-block" onsubmit="return confirm('Are you sure?')">
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
                    {{-- Pagination --}}
                    <div class="d-flex justify-content-end">
                        {{ $student->links() }}
                    </div>
                </div>
            @endif
        </div>
    </div>
</section>
@endsection
