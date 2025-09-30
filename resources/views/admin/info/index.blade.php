@extends('admin.layouts.master')

@section('content')
<section class="section">
    <div class="section-header d-flex justify-content-between align-items-center">
        <h1>Info KTM</h1>
        <a href="{{ route('admin.info.create') }}" class="btn btn-primary">
            <i class="fas fa-plus"></i> Upload File
        </a>
    </div>

    {{-- Search Bar --}}
    <div class="row mb-3">
        <div class="col-12 d-flex justify-content-end">
            <form action="{{ route('admin.info.index') }}" method="GET" class="form-inline">
                <div class="input-group">
                    <input type="text" name="search" class="form-control" placeholder="Search by file name"
                           value="{{ request('search') }}">
                    <div class="input-group-append">
                        <button class="btn btn-primary" type="submit">
                            <i class="fas fa-search"></i> Search
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    {{-- Table --}}
    <div class="card">
        <div class="card-body">
            @if($files->isEmpty())
                <div class="alert alert-info text-center">
                    No files found. Click <b>Upload File</b> to add one.
                </div>
            @else
                <div class="table-responsive">
                    <table class="table table-hover table-bordered align-middle text-center">
                        <thead class="thead-dark">
                            <tr>
                                <th>File Name</th>
                                <th>File</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($files as $file)
                                <tr>
                                    <td>{{ $file->file_name }}</td>
                                    <td>
                                        <a href="{{ asset('storage/'.$file->file_path) }}" target="_blank">
                                            View
                                        </a>
                                    </td>
                                    <td>
                                        <form action="{{ route('admin.info.destroy', $file->id) }}" method="POST" class="d-inline-block" onsubmit="return confirm('Are you sure you want to delete this file?')">
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
                    {{ $files->appends(request()->query())->links() }}
                </div>
            @endif
        </div>
    </div>
</section>
@endsection
