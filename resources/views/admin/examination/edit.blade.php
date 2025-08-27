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
                            <option value="Kemahiran Elektrik" {{ $exam->program == 'Kemahiran Elektrik' ? 'selected' : '' }}>KEMAHIRAN ELEKTRIK</option>
                            <option value="Kemahiran Mekatronik" {{ $exam->program == 'Kemahiran Mekatronik' ? 'selected' : '' }}>KEMAHIRAN MEKATRONIK</option>
                        </select>
                    </div>

                    {{-- Course Code --}}
                    <div class="form-group">
                        <label for="course_code">Course Code</label>
                        <input type="text" class="form-control" name="course_code" value="{{ old('course_code', $exam->course_code) }}" required>
                    </div>

                    {{-- Subject --}}
                    <div class="form-group">
                        <label for="course_name">Course Name</label>
                        <input type="text" class="form-control" name="course_name" value="{{ old('course_name', $exam->course_name) }}" required>
                    </div>

                    {{-- Exam Date --}}
                    <div class="form-group">
                        <label for="exam_date">Exam Date</label>
                        <input type="date" class="form-control" name="exam_date" value="{{ old('exam_date', $exam->exam_date) }}" required>
                    </div>

                    {{-- Exam Time From --}}
                    <div class="form-group">
                        <label for="time_from">Time From</label>
                        <input type="time" class="form-control" name="time_from" value="{{ old('time_from', $exam->time_from) }}" required>
                    </div>

                    {{-- Exam Time To --}}
                    <div class="form-group">
                        <label for="time_to">Time To</label>
                        <input type="time" class="form-control" name="time_to" value="{{ old('time_to', $exam->time_to) }}" required>
                    </div>

                    <button class="btn btn-primary" type="submit">Update Exam</button>
                    <a href="{{ route('admin.exams.index') }}" class="btn btn-secondary">Cancel</a>
                </form>
            </div>
        </div>
    </div>
</section>
@endsection
