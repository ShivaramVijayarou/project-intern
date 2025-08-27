@extends('admin.layouts.master')

@section('content')
<section class="section">
    <div class="section-header d-flex justify-content-between align-items-center">
        <h1>Notes</h1>
        <a href="{{ route('admin.notes.create') }}" class="btn btn-primary">
            <i class="fas fa-plus"></i> Upload New Note
        </a>
    </div>

    {{-- Search Bar --}}
    <div class="row mb-3">
        <div class="col-12 d-flex justify-content-end">
            <form action="{{ route('admin.notes.index') }}" method="GET" class="form-inline">
                <div class="input-group">
                    <input type="text" name="search" class="form-control"
                           placeholder="Search notes by title or program" value="{{ request('search') }}">
                    <div class="input-group-append">
                        <button class="btn btn-primary" type="submit">Search</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    {{-- Notes Table --}}
    <div class="card">
        <div class="card-body">
            @if($notes->isEmpty())
                <div class="alert alert-info">
                    No notes found. Click "Upload New Note" to add one.
                </div>
            @else
                <div class="table-responsive">
                    <table class="table table-bordered table-hover text-center">
                        <thead class="thead-dark">
                            <tr>
                                <th>Title</th>
                                <th>Description</th>
                                <th>Program</th>
                                <th>Uploaded By</th>
                                <th>File</th>
                                <th>Uploaded At</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($notes as $note)
                                <tr>
                                    <td>{{ $note->title }}</td>
                                    <td>{{ \Illuminate\Support\Str::limit($note->description, 50) }}</td>
                                    <td>{{ $note->program }}</td>
                                    <td>{{ $note->uploaded_by }}</td>
                                    <td>
                                        <a href="{{ asset('storage/' . $note->file) }}"
                                           class="btn btn-sm btn-info" target="_blank">
                                           <i class="fas fa-download"></i> View
                                        </a>
                                    </td>
                                    <td>{{ $note->created_at->format('d M, Y') }}</td>
                                    <td>
                                        <a href="{{ route('admin.notes.edit', $note->id) }}"
                                           class="btn btn-warning btn-sm" title="Edit">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form action="{{ route('admin.notes.destroy', $note->id) }}" method="POST"
                                              class="d-inline-block"
                                              onsubmit="return confirm('Are you sure you want to delete this note?')">
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
                        {{ $notes->links() }}
                    </div>
                </div>
            @endif
        </div>
    </div>
</section>
@endsection
