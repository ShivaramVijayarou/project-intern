@extends('admin.layouts.master')

@section('content')
    <section class="section">

        <div class="section-body">
            <div class="card card-primary">
                <div class="card-header">
                    <h4>Upload New Note</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.notes.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        {{-- Title --}}
                        <div class="form-group">
                            <label>Note Title</label>
                            <input type="text" class="form-control" name="title" value="{{ old('title') }}" required>
                        </div>

                        {{-- Description --}}
                        <div class="form-group">
                            <label>Description</label>
                            <textarea class="form-control" name="description" rows="3" required>{{ old('description') }}</textarea>
                        </div>

                        {{-- File Upload --}}
                        <div class="form-group">
                            <label for="file">Upload File</label>
                            <input type="file" name="file" class="form-control" required>
                            <small class="text-muted">Allowed formats: PDF, DOCX, PPTX, etc.</small>
                        </div>

                        {{-- Program --}}
                        {{-- <div class="form-group">
                            <label for="program">Program</label>
                            <input type="text" class="form-control" name="program" value="{{ old('program') }}" required>
                        </div> --}}


                        <div class="form-group">
    <label for="program">Program</label>
    <select name="program" class="form-control" required>
        <option value="">-- Select Program --</option>
        <option value="Kemahiran Elektrik" {{ old('program') == 'Kemahiran Elektrik' ? 'selected' : '' }}>KEMAHIRAN ELEKTRIK</option>
        <option value="Kemahiran Mekatronik" {{ old('program') == 'Kemahiran Mekatronik' ? 'selected' : '' }}>KEMAHIRAN MEKATRONIK</option>

    </select>
</div>

                        {{-- Uploaded By (hidden, logged-in admin) --}}
                        <input type="hidden" name="uploaded_by" value="{{ auth()->user()->name }}">

                        <button class="btn btn-primary" type="submit">Upload Note</button>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection
