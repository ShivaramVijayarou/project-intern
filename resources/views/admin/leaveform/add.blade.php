@extends('admin.layouts.master')

@section('content')
<section class="section">
    <div class="section-header">
        <h1>Add Leave Form</h1>
    </div>

    <div class="card">
        <div class="card-body">
            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            {{-- Upload Form --}}
            <form action="{{ route('admin.leaveform.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                {{-- Upload File --}}
                <div class="form-group">
                    <label for="file_path">Upload Form (PDF/DOC/IMG) <span class="text-danger">*</span></label>
                    <input type="file" name="file_path" id="file_path"
                           class="form-control-file @error('file_path') is-invalid @enderror" required>
                    @error('file_path')
                        <div class="text-danger small">{{ $message }}</div>
                    @enderror
                </div>


                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-upload"></i> Upload Form
                </button>
                <a href="{{ route('admin.leaveform.index') }}" class="btn btn-secondary">
                    Cancel
                </a>
            </form>
        </div>
    </div>
</section>
@endsection
