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

                        {{-- Note Title --}}
                        <div class="form-group">
                            <label for="title">Note Title</label>
                            <input type="text" id="title" name="title"
                                   class="form-control"
                                   value="{{ old('title') }}"
                                   required>
                        </div>

                        {{-- Description --}}
                        <div class="form-group">
                            <label for="description">Description</label>
                            <textarea id="description" name="description"
                                      class="form-control" rows="3" required>{{ old('description') }}</textarea>
                        </div>

                        {{-- File Upload --}}
                        <div class="form-group">
                            <label for="file">Upload File</label>
                            <input type="file" id="file" name="file"
                                   class="form-control" required>
                            <small class="text-muted">
                                Allowed formats: PDF, DOCX, PPTX, XLSX, etc.
                            </small>
                        </div>

                        {{-- Program --}}
                        <div class="form-group">
                            <label for="program">Program</label>
                            <select id="program" name="program" class="form-control" required>
                                <option value="">-- Select Program --</option>
                                <option value="Kemahiran Elektrik"
                                    {{ old('program') == 'Kemahiran Elektrik' ? 'selected' : '' }}>
                                    KEMAHIRAN ELEKTRIK
                                </option>
                                <option value="Kemahiran Mekatronik"
                                    {{ old('program') == 'Kemahiran Mekatronik' ? 'selected' : '' }}>
                                    KEMAHIRAN MEKATRONIK
                                </option>
                            </select>
                        </div>

                        {{-- Uploaded By (Hidden) --}}
                        <input type="hidden" name="uploaded_by" value="{{ auth()->id() }}">

                        {{-- Submit Button --}}
                        <div class="form-group text-right">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-upload"></i> Upload Note
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection
