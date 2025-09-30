@extends('admin.layouts.master')

@section('content')
<section class="section">
    <div class="section-header">
        <h1>Edit File</h1>
    </div>

    <div class="card">
        <div class="card-body">
            {{-- Update form --}}
            <form action="{{ route('admin.elibrary.update', $file->id) }}"
                  method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

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


                <div class="form-group mb-3">
                    <label>Current File:</label>
                    <p>
                        <a href="{{ asset('storage/'.$file->file_path) }}" target="_blank">
                            {{ $file->file_name }}
                        </a>
                    </p>
                </div>

                <div class="form-group mb-3">
                    <label for="file">Replace File (optional)</label>
                    <input type="file" name="file" id="file"
                           class="form-control @error('file') is-invalid @enderror">
                    @error('file')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                    <small class="text-muted">
                        Leave blank to keep the current file.
                    </small>
                </div>

                <button class="btn btn-primary" type="submit">
                    <i class="fas fa-save"></i> Update
                </button>
                <a href="{{ route('admin.elibrary.index') }}" class="btn btn-secondary">
                    <i class="fas fa-arrow-left"></i> Back
                </a>
            </form>
        </div>
    </div>
</section>
@endsection
