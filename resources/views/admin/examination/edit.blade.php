@extends('admin.layouts.master')

@section('content')
<section class="section">
    <div class="section-header">
        <h1>Edit Examination Details</h1>
    </div>

    <div class="section-body">
        <div class="card card-primary">
            <div class="card-header">
                <h4>Edit Exam</h4>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.exams.update', $exam->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    {{-- Program --}}
                    <div class="form-group">
                        <label for="program">Program</label>
                        <select name="program" class="form-control" required>
                            <option value="">-- Select Program --</option>
                            <option value="Kemahiran Elektrik" {{ old('program', $exam->program) == 'Kemahiran Elektrik' ? 'selected' : '' }}>
                                KEMAHIRAN ELEKTRIK
                            </option>
                            <option value="Kemahiran Mekatronik" {{ old('program', $exam->program) == 'Kemahiran Mekatronik' ? 'selected' : '' }}>
                                KEMAHIRAN MEKATRONIK
                            </option>
                        </select>
                        @error('program')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    {{-- Course Code --}}
                    <div class="form-group">
                        <label for="course_code">Course Code</label>
                        <input type="text" class="form-control" name="course_code"
                               value="{{ old('course_code', $exam->course_code) }}" required>
                        @error('course_code')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    {{-- Course Name --}}
                    <div class="form-group">
                        <label for="course_name">Course Name</label>
                        <input type="text" class="form-control" name="course_name"
                               value="{{ old('course_name', $exam->course_name) }}" required>
                        @error('course_name')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    {{-- Exam Date --}}
                    {{-- <div class="form-group">
                        <label for="exam_date">Exam Date</label>
                        <input type="date" class="form-control" name="exam_date"
                               value="{{ old('exam_date', $exam->exam_date) }}" required>
                        @error('exam_date')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div> --}}
                    
                    <div class="form-group">
                            <label for="exam_date">Exam Date</label>
                            <input type="date" class="form-control" name="exam_date"
                                value="{{ old('exam_date', $exam->exam_date) }}" min="{{ date('Y-m-d') }}" required>
                            @error('exam_date')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                    {{-- Exam Time From --}}
                    <div class="form-group">
                        <label for="time_from">Time From</label>
                        <input type="time" class="form-control" name="time_from"
                               value="{{ old('time_from', $exam->time_from) }}" required>
                        @error('time_from')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    {{-- Exam Time To --}}
                    <div class="form-group">
                        <label for="time_to">Time To</label>
                        <input type="time" class="form-control" name="time_to"
                               value="{{ old('time_to', $exam->time_to) }}" required>
                        @error('time_to')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    {{-- Action Buttons --}}
                    <div class="form-group d-flex justify-content-between">
                        <a href="{{ route('admin.exams.index') }}" class="btn btn-secondary">
                            <i class="fas fa-arrow-left"></i> Cancel
                        </a>
                        <button class="btn btn-primary" type="submit">
                            <i class="fas fa-save"></i> Update Exam
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
@endsection
