@extends('admin.layouts.master')

@section('content')
    <section class="section">

        <div class="section-body">
            <div class="card card-primary">
                <div class="card-header">
                    <h4>Add New Student</h4>
                </div>
                <div class="card-body">
                    {{-- {{ route('admin.student.store') }} --}}
                    <form action="{{ route('admin.students.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        {{-- Student Photo --}}
                        <div class="form-group">
                            <div id="image-preview" class="image-preview">
                                <label for="image-upload" id="image-label">Choose Photo</label>
                                <input type="file" name="photo" id="image-upload" />
                            </div>
                        </div>

                        {{-- Student ID --}}
                        <div class="form-group">
                            <label>Student ID</label>
                            <input type="text" class="form-control" name="student_id" value="{{ old('student_id') }}"
                                required>
                        </div>

                        {{-- Name --}}
                        <div class="form-group">
                            <label>Full Name</label>
                            <input type="text" class="form-control" name="name" value="{{ old('name') }}" required>
                        </div>

                        {{-- Email --}}
                        <div class="form-group">
                            <label>Email</label>
                            <input type="email" class="form-control" name="email" value="{{ old('email') }}" required>
                        </div>

                        {{-- Phone Number --}}
                        <div class="form-group">
                            <label>Phone Number</label>
                            <input type="text" class="form-control" name="phoneNo" value="{{ old('phoneNo') }}">
                        </div>

                        {{-- Address --}}
                        <div class="form-group">
                            <label>Address</label>
                            <textarea class="form-control" name="address" rows="3">{{ old('address') }}</textarea>
                        </div>

                        {{-- IC Number --}}
                        <div class="form-group">
                            <label>IC Number</label>
                            <input type="text" class="form-control" name="ic" value="{{ old('ic') }}" required>
                        </div>

                        {{-- Status --}}
                        <div class="form-group">
                            <label for="status">Status</label>
                            <select name="status" class="form-control" required>
                                <option value="active" {{ old('status') == 'active' ? 'selected' : '' }}>Active</option>
                                <option value="inactive" {{ old('status') == 'inactive' ? 'selected' : '' }}>Inactive
                                </option>
                            </select>

                        </div>


                        {{-- Program --}}
                        {{-- <div class="form-group">
                            <label for="program">Program</label>
                            <select name="program" class="form-control" required>
                                <option value="elektrik" {{ old('program') == 'kemahiran elektrik' ? 'selected' : '' }}>KEMAHIRAN ELEKTRIK</option>
                                <option value="mekatronik" {{ old('program') == 'kemahiran mekatronik' ? 'selected' : '' }}>KEMAHIRAN MEKATRONIK</option>
                            </select>
                            {{-- <input type="text" class="form-control" name="program" value="{{ old('program') }}" required>
                        </div> --}}

                        <div class="form-group">
    <label for="program">Program</label>
    <select name="program" class="form-control" required>
        <option value="">-- Select Program --</option>
        <option value="Kemahiran Elektrik" {{ old('program') == 'Kemahiran Elektrik' ? 'selected' : '' }}>KEMAHIRAN ELEKTRIK</option>
        <option value="Kemahiran Mekatronik" {{ old('program') == 'Kemahiran Mekatronik' ? 'selected' : '' }}>KEMAHIRAN MEKATRONIK</option>

    </select>
</div>

                        {{-- Default Password Note --}}
                        <div class="form-group">
                            <small class="text-muted">
                                Default password will be <b>student123</b> (student can change later).
                            </small>
                        </div>

                        <button class="btn btn-primary" type="submit">Add Student</button>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection
