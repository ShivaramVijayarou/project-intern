@extends('admin.layouts.master')

@section('content')
<section class="section">
    <div class="section-body">
        <div class="card card-warning shadow-sm">
            <div class="card-header">
                <h4>Edit Student</h4>
            </div>

            <div class="card-body">
                <form action="{{ route('admin.students.update', $student->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    {{-- Student Photo --}}
                    <div class="form-group text-center">
                        <label class="d-block">Photo</label>
                        <div class="mb-3">
                            <img id="preview-img"
                                src="{{ $student->profileimage ? asset('storage/' . $student->profileimage) : asset('uploads/profile.png') }}"
                                class="rounded-circle border shadow-sm"
                                style="width: 120px; height: 120px; object-fit: cover;">
                        </div>
                        <input type="file" name="profileimage" id="image-upload" class="form-control-file" accept="image/*">
                        <small class="text-muted d-block mt-1">Leave empty if you don’t want to change the photo.</small>
                    </div>

                    <hr>

                    <div class="row">
                        {{-- Student ID --}}
                        <div class="form-group col-md-6">
                            <label>Student ID</label>
                            <input type="text" class="form-control" name="student_id"
                                value="{{ old('student_id', $student->student_id) }}" required>
                        </div>

                         {{-- Batch Code --}}
                        <div class="form-group col-md-6">
                            <label>Batch Code</label>
                            <input type="text" class="form-control" name="batch_code"
                                value="{{ old('batch_code', $student->batch_code) }}" required>
                        </div>

                        {{-- Full Name --}}
                        <div class="form-group col-md-6">
                            <label>Full Name</label>
                            <input type="text" class="form-control" name="name"
                                value="{{ old('name', $student->name) }}" required>
                        </div>
                    </div>

                    <div class="row">
                        {{-- Email --}}
                        <div class="form-group col-md-6">
                            <label>Email</label>
                            <input type="email" class="form-control" name="email"
                                value="{{ old('email', $student->email) }}" required>
                        </div>

                        {{-- Phone Number --}}
                        <div class="form-group col-md-6">
                            <label>Phone Number</label>
                            <input type="text" class="form-control" name="phoneNo"
                                value="{{ old('phoneNo', $student->phoneNo) }}">
                        </div>
                    </div>

                    {{-- Address --}}
                    <div class="form-group">
                        <label>Address</label>
                        <textarea class="form-control" name="address" rows="3">{{ old('address', $student->address) }}</textarea>
                    </div>

                    <div class="row">
                        {{-- IC Number --}}
                        <div class="form-group col-md-6">
                            <label>IC Number</label>
                            <input type="text" class="form-control" name="ic"
                                value="{{ old('ic', $student->ic) }}" required>
                        </div>

                        {{-- Status --}}
                        <div class="form-group col-md-6">
                            <label>Status</label>
                            <select name="status" class="form-control" required>
                                <option value="active" {{ old('status', $student->status) == 'active' ? 'selected' : '' }}>Active</option>
                                <option value="inactive" {{ old('status', $student->status) == 'inactive' ? 'selected' : '' }}>Inactive</option>
                            </select>
                        </div>
                    </div>

                    {{-- Program --}}
                    <div class="form-group">
                        <label>Program</label>
                        <select name="program" class="form-control" required>
                            <option value="">-- Select Program --</option>
                            <option value="Kemahiran Elektrik" {{ old('program', $student->program) == 'Kemahiran Elektrik' ? 'selected' : '' }}>
                                Kemahiran Elektrik
                            </option>
                            <option value="Kemahiran Mekatronik" {{ old('program', $student->program) == 'Kemahiran Mekatronik' ? 'selected' : '' }}>
                                Kemahiran Mekatronik
                            </option>
                        </select>
                    </div>


                     {{-- Level --}}
                    <div class="form-group">
                        <label for="level">Level</label>
                        <select name="level" class="form-control @error('level') is-invalid @enderror" required>
                            <option value="">-- Select Level --</option>
                            <option value="Level 2"
                                {{ old('level 2', $student->level) == 'Level 2' ? 'selected' : '' }}>
                               Level 2
                            </option>
                            <option value="Level 3"
                                {{ old('level 3', $student->level) == 'Level 3' ? 'selected' : '' }}>
                                Level 3
                            </option>
                            <option value="Level 4"
                                {{ old('level 4', $student->level) == 'Level 4' ? 'selected' : '' }}>
                                Level 4
                            </option>
                        </select>
                        @error('level')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Submit Button --}}
                    <div class="text-right">
                        <button class="btn btn-warning px-4" type="submit">
                            <i class="fas fa-save"></i> Update Student
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
@endsection
