@extends('admin.layouts.master')

@section('content')
<section class="section">
    <div class="section-body">
        <div class="card card-primary">
            <div class="card-header">
                <h4>Add Exam Details</h4>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.exams.store') }}" method="POST">
                    @csrf

                    {{-- Program --}}
                    <div class="form-group">
                        <label for="program">Program</label>
                        <select name="program" class="form-control" required>
                            <option value="">-- Select Program --</option>
                            <option value="Kemahiran Elektrik" {{ old('program') == 'Kemahiran Elektrik' ? 'selected' : '' }}>
                                KEMAHIRAN ELEKTRIK
                            </option>
                            <option value="Kemahiran Mekatronik" {{ old('program') == 'Kemahiran Mekatronik' ? 'selected' : '' }}>
                                KEMAHIRAN MEKATRONIK
                            </option>
                        </select>
                    </div>

                    {{-- Course Code --}}
                    <div class="form-group">
                        <label for="course_code">Course Code</label>
                        <input type="text" class="form-control" name="course_code"
                               value="{{ old('course_code') }}" required>
                    </div>

                    {{-- Course Name --}}
                    <div class="form-group">
                        <label for="course_name">Course Name</label>
                        <input type="text" class="form-control" name="course_name"
                               value="{{ old('course_name') }}" required>
                    </div>

                    {{-- Exam Date --}}
                    <div class="form-group">
                        <label for="exam_date">Exam Date</label>
                        <input type="date" class="form-control" name="exam_date"
                               value="{{ old('exam_date') }}"
                               min="{{ date('Y-m-d') }}" required>
                        <small class="text-muted">Only today and future dates can be selected.</small>
                    </div>

                    {{-- Exam Time (From–To) --}}
                    <div class="form-group">
                        <label for="time_from">Exam Time</label>
                        <div class="d-flex align-items-center">
                            <input type="time" name="time_from" id="time_from" class="form-control"
                                   value="{{ old('time_from') }}" required>
                            <span class="mx-2">to</span>
                            <input type="time" name="time_to" id="time_to" class="form-control"
                                   value="{{ old('time_to') }}" required>
                        </div>
                    </div>

                    <div class="form-group d-flex justify-content-between">
                       <a href="{{ route('admin.exams.index') }}" class="btn btn-secondary">
                            <i class="fas fa-arrow-left"></i> Cancel
                        </a>


                        <button class="btn btn-primary" type="submit">
                            <i class="fas fa-save"></i> Add Exam
                        </button>

                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
@endsection
