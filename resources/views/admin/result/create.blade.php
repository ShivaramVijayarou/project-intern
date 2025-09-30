@extends('admin.layouts.master')

@section('content')
<section class="section">
    <div class="section-body">
        <div class="card card-primary">
            <div class="card-header">
                <h4>Upload New Result</h4>
            </div>

            <div class="card-body">
                <form action="{{ route('admin.result.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

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

                    {{-- Level --}}
                    <div class="form-group">
                        <label for="level">Level</label>
                        <select id="level" name="level" class="form-control" required>
                            <option value="">-- Select Level --</option>
                            <option value="Level 2" {{ old('level') == 'Level 2' ? 'selected' : '' }}>Level 2</option>
                            <option value="Level 3" {{ old('level') == 'Level 3' ? 'selected' : '' }}>Level 3</option>
                            <option value="Level 4" {{ old('level') == 'Level 4' ? 'selected' : '' }}>Level 4</option>
                        </select>
                    </div>

                    {{-- File Name --}}
                    <div class="form-group">
                        <label for="file_name">File Name</label>
                        <input type="text" id="file_name" name="file_name"
                               class="form-control"
                               value="{{ old('file_name') }}" required>
                        <small class="text-muted">Enter a descriptive name for the file.</small>
                    </div>

                    {{-- File Upload --}}
                    <div class="form-group">
                        <label for="file_path">Upload File</label>
                        <input type="file" id="file_path" name="file_path"
                               class="form-control" required>
                        <small class="text-muted">Allowed formats: PDF, DOCX, XLSX, etc.</small>
                    </div>

                    {{-- Submit Button --}}
                    <div class="form-group text-right">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-upload"></i> Upload Result
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
@endsection
