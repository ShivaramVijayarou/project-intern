@extends('admin.layouts.master')

@section('content')
    <section class="section">
        <div class="section-header d-flex justify-content-between align-items-center">
            <h1>Edit Note</h1>
            <a href="{{ route('admin.notes.index') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left"></i> Back to Notes
            </a>
        </div>

        <div class="card">
            <div class="card-body">
                <form action="{{ route('admin.notes.update', $note->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    {{-- Title --}}
                    <div class="form-group">
                        <label for="title">Title</label>
                        <input type="text"
                               class="form-control @error('title') is-invalid @enderror"
                               name="title"
                               value="{{ old('title', $note->title) }}"
                               required>
                        @error('title')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Description --}}
                    <div class="form-group">
                        <label for="description">Description</label>
                        <textarea class="form-control @error('description') is-invalid @enderror"
                                  name="description"
                                  rows="4">{{ old('description', $note->description) }}</textarea>
                        @error('description')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Program --}}
                    <div class="form-group">
                        <label for="program">Program</label>
                        <select name="program" class="form-control @error('program') is-invalid @enderror" required>
                            <option value="">-- Select Program --</option>
                            <option value="Kemahiran Elektrik"
                                {{ old('program', $note->program) == 'Kemahiran Elektrik' ? 'selected' : '' }}>
                                KEMAHIRAN ELEKTRIK
                            </option>
                            <option value="Kemahiran Mekatronik"
                                {{ old('program', $note->program) == 'Kemahiran Mekatronik' ? 'selected' : '' }}>
                                KEMAHIRAN MEKATRONIK
                            </option>
                        </select>
                        @error('program')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- File --}}
                    <div class="form-group">
                        <label for="file">Upload New File (optional)</label>
                        <input type="file"
                               class="form-control-file @error('file') is-invalid @enderror"
                               name="file"
                               accept=".pdf,.doc,.docx,.ppt,.pptx,.txt">
                        @error('file')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror

                        @if ($note->file)
                            <p class="mt-2">
                                Current File:
                                <a href="{{ asset('storage/' . $note->file) }}" target="_blank" class="btn btn-info btn-sm">
                                    <i class="fas fa-download"></i> View Current File
                                </a>
                            </p>
                        @endif
                    </div>

                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save"></i> Update Note
                    </button>
                </form>
            </div>
        </div>
    </section>
@endsection
