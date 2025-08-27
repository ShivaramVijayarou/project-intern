@extends('admin.layouts.master')

@section('content')
    <section class="section">

        <div class="section-body">
            <div class="card card-primary">
                <div class="card-header">
                    <h4>Add Exam Details</h4>
                </div>
                <div class="card-body">
                    {{-- {{ route('admin.exams.store') }} --}}
                    <form action="{{ route('admin.exams.store') }}" method="POST">
                        @csrf

                        {{-- Program --}}
                        <div class="form-group">
                            <label for="program">Program</label>
                            <select name="program" class="form-control" required>
                                <option value="">-- Select Program --</option>
                                <option value="Kemahiran Elektrik"
                                    {{ old('program') == 'Kemahiran Elektrik' ? 'selected' : '' }}>KEMAHIRAN ELEKTRIK
                                </option>
                                <option value="Kemahiran Mekatronik"
                                    {{ old('program') == 'Kemahiran Mekatronik' ? 'selected' : '' }}>KEMAHIRAN MEKATRONIK
                                </option>
                            </select>
                        </div>

                        {{-- Course Code --}}
                        <div class="form-group">
                            <label for="course_code">Course Code</label>
                            <input type="text" class="form-control" name="course_code" value="{{ old('course_code') }}"
                                required>
                        </div>

                        {{-- Subject --}}
                        <div class="form-group">
                            <label for="course_name">course_name</label>
                            <input type="text" class="form-control" name="course_name" value="{{ old('course_name') }}" required>
                        </div>

                        {{-- Exam Date --}}
                        <div class="form-group">
                            <label for="exam_date">Exam Date</label>
                            <input type="date" class="form-control" name="exam_date" value="{{ old('exam_date') }}"
                                required>
                            <small class="text-muted">Day will be automatically shown from the date.</small>
                        </div>

                        {{-- Time --}}
                        {{-- <div class="form-group">
                            <label for="time">Time</label>
                            <input type="text" class="form-control" name="time" value="{{ old('time') }}" placeholder="e.g. 10:00 AM - 12:00 PM" required>
                        </div> --}}

                        {{-- Exam Time (From–To) --}}
                        <div class="form-group">
                            <label for="time_from">Exam Time</label>
                            <div class="d-flex gap-2">
                                <input type="time" name="time_from" id="time_from" class="form-control"
                                    value="{{ old('time_from') }}" required>
                                <span class="mx-2">to</span>
                                <input type="time" name="time_to" id="time_to" class="form-control"
                                    value="{{ old('time_to') }}" required>
                            </div>
                        </div>

                        <button class="btn btn-primary" type="submit">Add Exam</button>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection
