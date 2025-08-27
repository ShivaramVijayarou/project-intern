@extends('admin.layouts.master')

@section('content')
    <section class="section">

        <div class="section-body">
            <div class="card card-warning">
                <div class="card-header">
                    <h4>Edit Student</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.students.update', $student->id) }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        {{-- Student Photo --}}
                        <div class="form-group">
                            <label>Photo</label>
                            <div class="mb-2">
                                <img src="{{ asset($student->profileimage ?? 'uploads/profile.png') }}"
                                    class="img-thumbnail" style="width: 100px; height: 100px; object-fit: cover;">
                            </div>
                            <input type="file" name="photo" class="form-control">
                            <small class="text-muted">Leave empty if you don't want to change the photo.</small>
                        </div>

                        {{-- Student ID --}}
                        <div class="form-group">
                            <label>Student ID</label>
                            <input type="text" class="form-control" name="student_id"
                                value="{{ old('student_id', $student->student_id) }}" required>
                        </div>

                        {{-- Name --}}
                        <div class="form-group">
                            <label>Full Name</label>
                            <input type="text" class="form-control" name="name"
                                value="{{ old('name', $student->name) }}" required>
                        </div>

                        {{-- Email --}}
                        <div class="form-group">
                            <label>Email</label>
                            <input type="email" class="form-control" name="email"
                                value="{{ old('email', $student->email) }}" required>
                        </div>

                        {{-- Phone Number --}}
                        <div class="form-group">
                            <label>Phone Number</label>
                            <input type="text" class="form-control" name="phoneNo"
                                value="{{ old('phoneNo', $student->phoneNo) }}">
                        </div>

                        {{-- Address --}}
                        <div class="form-group">
                            <label>Address</label>
                            <textarea class="form-control" name="address" rows="3">{{ old('address', $student->address) }}</textarea>
                        </div>

                        {{-- IC Number --}}
                        <div class="form-group">
                            <label>IC Number</label>
                            <input type="text" class="form-control" name="ic" value="{{ old('ic', $student->ic) }}"
                                required>
                        </div>

                        {{-- Status --}}
                        <div class="form-group">
                            <label for="status">Status</label>
                            <select name="status" class="form-control" required>
                                <option value="active" {{ old('status', $student->status) == 'active' ? 'selected' : '' }}>
                                    Active</option>
                                <option value="inactive"
                                    {{ old('status', $student->status) == 'inactive' ? 'selected' : '' }}>Inactive</option>
                            </select>
                        </div>

                        {{-- Program --}}
                        {{-- <div class="form-group">
                            <label>Program</label>
                            <input type="text" class="form-control" name="program"
                                   value="{{ old('program', $student->program) }}" required>
                        </div> --}}

                        <div class="form-group">
                            <label for="program">Program</label>
                            <select name="program" class="form-control" required>
                                <option value="">-- Select Program --</option>
                                <option value="Kemahiran Elektrik"
                                    {{ old('program', $student->program) == 'Kemahiran Elektrik' ? 'selected' : '' }}>KEMAHIRAN ELEKTRIK
                                </option>
                                <option value="Kemahiran Mekatronik"
                                    {{ old('program', $student->program) == 'Kemahiran Mekatronik' ? 'selected' : '' }}>KEMAHIRAN MEKATRONIK
                                </option>

                            </select>
                        </div>

                        <button class="btn btn-warning" type="submit">Update Student</button>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection
