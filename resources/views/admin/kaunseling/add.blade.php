@extends('admin.layouts.master')

@section('content')
<section class="section">
    <div class="section-header">
        <h1>Add Kaunseling Form</h1>
    </div>

    <div class="card">
        <div class="card-body">
            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            {{-- Upload Form --}}
            <form action="{{ route('admin.kaunseling.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                {{-- Student Name or ID --}}
                {{-- <div class="form-group">
                    <label for="student_name">Student Name / ID <span class="text-danger">*</span></label>
                    <input type="text" name="student_name" id="student_name"
                           class="form-control @error('student_name') is-invalid @enderror"
                           value="{{ old('student_name') }}" required>
                    @error('student_name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div> --}}

                {{-- Program --}}
                {{-- <div class="form-group">
                    <label for="program">Program <span class="text-danger">*</span></label>
                    <input type="text" name="program" id="program"
                           class="form-control @error('program') is-invalid @enderror"
                           value="{{ old('program') }}" required>
                    @error('program')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div> --}}

                {{-- Reason --}}
                {{-- <div class="form-group">
                    <label for="reason">Reason for Counselling <span class="text-danger">*</span></label>
                    <input type="text" name="reason" id="reason"
                           class="form-control @error('reason') is-invalid @enderror"
                           value="{{ old('reason') }}" required>
                    @error('reason')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div> --}}

                {{-- Upload File --}}
                <div class="form-group">
                    <label for="file_path">Upload Form (PDF/DOC/IMG) <span class="text-danger">*</span></label>
                    <input type="file" name="file_path" id="file_path"
                           class="form-control-file @error('file_path') is-invalid @enderror" required>
                    @error('file_path')
                        <div class="text-danger small">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Additional Notes --}}
                {{-- <div class="form-group">
                    <label for="additional_notes">Additional Notes</label>
                    <textarea name="additional_notes" id="additional_notes" rows="3"
                              class="form-control @error('additional_notes') is-invalid @enderror">{{ old('additional_notes') }}</textarea>
                    @error('additional_notes')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div> --}}

                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-upload"></i> Upload Form
                </button>
                <a href="{{ route('admin.kaunseling.index') }}" class="btn btn-secondary">
                    Cancel
                </a>
            </form>
        </div>
    </div>
</section>
@endsection
