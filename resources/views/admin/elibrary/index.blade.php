@extends('admin.layouts.master')

@section('content')
<section class="section">
    <div class="section-header d-flex justify-content-between align-items-center">
        <h1>E-Library</h1>
        <a href="{{ route('admin.elibrary.create') }}" class="btn btn-primary">
            <i class="fas fa-plus"></i> Add File
        </a>
    </div>

    {{-- Search by Program --}}
    <div class="row mb-3">
        <div class="col-12 d-flex justify-content-end">
            <form action="{{ route('admin.elibrary.index') }}" method="GET" class="form-inline">
                <div class="input-group">
                    <input type="text" name="search" class="form-control" placeholder="Search by Program" value="{{ request('search') }}">
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
                    No files found. Click <b>Add File</b> to upload one.
                </div>
            @else
                <div class="table-responsive">
                    <table class="table table-hover table-bordered align-middle text-center">
                        <thead class="thead-dark">
                            <tr>
                                <th>Program</th>
                                <th>File</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($files as $file)
                                <tr>
                                    <td>{{ $file->program }}</td>
                                    <td>
                                        <a href="{{ asset('storage/'.$file->file_path) }}" target="_blank">
                                            {{ $file->file_name }}
                                        </a>
                                    </td>
                                    <td>
                                        {{-- Edit/Delete if you want --}}
                                        <form action="{{ route('admin.elibrary.destroy', $file->id) }}" method="POST" class="d-inline-block" onsubmit="return confirm('Are you sure?')">
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
            @endif
        </div>
    </div>
</section>
@endsection
