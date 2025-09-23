@extends('admin.layouts.master')

@section('content')
    <section class="section">

        {{-- Section Header --}}
        <div class="section-header d-flex justify-content-between align-items-center">
            <h1>Notes</h1>
            <a href="{{ route('admin.notes.create') }}" class="btn btn-primary">
                <i class="fas fa-file-upload"></i> Upload New Note
            </a>
        </div>

        <div class="row mb-3">
            <div class="col-12 d-flex justify-content-end">
                <form action="{{ route('admin.notes.index') }}" method="GET" class="form-inline">
                    <div class="input-group mr-2">
                        <input type="text" name="search" class="form-control"
                            placeholder="Search notes by title or program" value="{{ request('search') }}">
                    </div>

                    <div class="input-group mr-2">
                        <select name="level" class="form-control">
                            <option value="">All Levels</option>
                            <option value="level 1" {{ request('level') == 'level 1' ? 'selected' : '' }}>Level 1</option>
                            <option value="level 2" {{ request('level') == 'level 2' ? 'selected' : '' }}>Level 2</option>
                            <option value="level 3" {{ request('level') == 'level 3' ? 'selected' : '' }}>Level 3</option>
                            {{-- Or dynamically load levels from DB --}}
                            {{-- @foreach ($levels as $level)
                        <option value="{{ $level }}" {{ request('level') == $level ? 'selected' : '' }}>{{ $level }}</option>
                    @endforeach --}}
                        </select>
                    </div>

                    <div class="input-group-append">
                        <button class="btn btn-primary" type="submit">
                            <i class="fas fa-search"></i> Search
                        </button>
                    </div>
                </form>
            </div>
        </div>


        {{-- Notes Table --}}
        <div class="card">
            <div class="card-body">
                @if ($notes->isEmpty())
                    <div class="alert alert-info text-center mb-0">
                        No notes found. Click <strong>"Upload New Note"</strong> to add one.
                    </div>
                @else
                    <div class="table-responsive">
                        <table class="table table-hover table-bordered align-middle text-center">
                            <thead class="thead-dark">
                                <tr>
                                    <th>Title</th>
                                    <th>Description</th>
                                    <th>Program</th>
                                    <th>Uploaded By</th>
                                    <th>File</th>
                                    <th>Level</th>
                                    <th>Uploaded At</th>
                                    <th width="120">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($notes as $note)
                                    <tr>
                                        <td>{{ $note->title }}</td>
                                        <td>{{ \Illuminate\Support\Str::limit($note->description, 50) }}</td>
                                        <td>{{ $note->program }}</td>

                                        <td>{{ $note->uploader->name ?? 'Unknown' }}</td>
                                        <td>
                                            @php
                                                $filePath = asset('storage/' . $note->file);
                                                $extension = pathinfo($note->file, PATHINFO_EXTENSION);
                                            @endphp

                                            {{-- Preview Button --}}
                                            <a href="{{ $filePath }}" class="btn btn-info btn-sm" target="_blank"
                                                title="Preview File">
                                                <i class="fas fa-eye"></i>
                                            </a>

                                            {{-- Download Button --}}
                                            <a href="{{ $filePath }}" class="btn btn-success btn-sm" download>
                                                <i class="fas fa-download"></i> Download
                                            </a>

                                        </td>
                                        <td>{{ $note->level }}</td>
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
                    </div>

                    {{-- Pagination --}}
                    <div class="d-flex justify-content-center mt-3">
                        {{ $notes->appends(request()->query())->links() }}
                    </div>
                @endif
            </div>
        </div>
    </section>
@endsection
