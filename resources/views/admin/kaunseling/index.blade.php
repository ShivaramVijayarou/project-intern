@extends('admin.layouts.master')

@section('content')
<section class="section">
    <div class="section-header d-flex justify-content-between align-items-center">
        <h1>Kaunseling Files</h1>
        <a href="{{ route('admin.kaunseling.create') }}" class="btn btn-primary">
            <i class="fas fa-plus"></i> Upload File
        </a>
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
                                        <form action="{{ route('admin.kaunseling.destroy', $file->id) }}" method="POST" class="d-inline-block" onsubmit="return confirm('Are you sure you want to delete this file?')">
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

                {{-- Pagination if needed --}}
                <div class="mt-3">
                    {{ $files->links() }}
                </div>
            @endif
        </div>
    </div>
</section>
@endsection
