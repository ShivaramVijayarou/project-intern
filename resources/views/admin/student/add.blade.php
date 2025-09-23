@extends('admin.layouts.master')

@section('content')
    <section class="section">
        <div class="section-body">
            <div class="card card-primary">
                <div class="card-header">
                    <h4>Add New Student</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.students.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        {{-- Student Photo --}}
                        <div class="form-group">


                            <div id="image-preview" class="image-preview text-center">
                                <img id="preview-img" src="{{ asset('uploads/profile.png') }}" alt="Preview"
                                    class="w-32 h-32 rounded-full object-cover border-4 border-gray-200 shadow mb-2 d-none">

                                <label for="image-upload" id="image-label">Choose Photo</label>
                                <input type="file" name="profileimage" id="image-upload" accept="image/*" />
                            </div>
                            @error('profileimage')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        {{-- Student ID --}}
                        <div class="form-group">
                            <label>Student ID</label>
                            <input type="text" class="form-control" name="student_id" value="{{ old('student_id') }}"
                                required>
                            @error('student_id')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        {{-- Name --}}
                        <div class="form-group">
                            <label>Full Name</label>
                            <input type="text" class="form-control" name="name" value="{{ old('name') }}" required>
                            @error('name')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        {{-- Email --}}
                        <div class="form-group">
                            <label>Email</label>
                            <input type="email" class="form-control" name="email" value="{{ old('email') }}" required>
                            @error('email')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        {{-- Phone Number --}}
                        <div class="form-group">
                            <label>Phone Number</label>
                            <input type="text" class="form-control" name="phoneNo" value="{{ old('phoneNo') }}"
                                pattern="[0-9+ ]{8,15}" title="Phone number should be 8-15 digits">
                            @error('phoneNo')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        {{-- Address --}}
                        <div class="form-group">
                            <label>Address</label>
                            <textarea class="form-control" name="address" rows="3">{{ old('address') }}</textarea>
                            @error('address')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        {{-- IC Number --}}
                        <div class="form-group">
                            <label>IC Number</label>
                            <input type="text" class="form-control" name="ic" value="{{ old('ic') }}" required
                                pattern="\d{6}-\d{2}-\d{4}" title="(e.g. 123456-78-9012)">
                            @error('ic')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        {{-- Status --}}
                        <div class="form-group">
                            <label for="status">Status</label>
                            <select name="status" class="form-control" required>
                                <option value="active" {{ old('status') == 'active' ? 'selected' : '' }}>Active</option>
                                <option value="inactive" {{ old('status') == 'inactive' ? 'selected' : '' }}>Inactive
                                </option>
                            </select>
                            @error('status')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        {{-- Program --}}
                        <div class="form-group">
                            <label for="program">Program</label>
                            <select name="program" class="form-control" required>
                                <option value="">-- Select Program --</option>
                                <option value="Kemahiran Elektrik">-- Kemahiran Elektrik --</option>
                                <option value="Kemahiran Mekatronik">-- Kemahiran Mekatronik --</option>
                                {{-- @foreach ($programs as $program)
                                    <option value="{{ $program }}"
                                        {{ old('program') == $program ? 'selected' : '' }}>
                                        {{ strtoupper($program) }}
                                    </option>
                                @endforeach --}}
                            </select>
                            @error('program')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>


                        {{-- Level --}}
                        <div class="form-group">
                            <label for="level">Level</label>
                            <select id="level" name="level" class="form-control" required>
                                <option value="">-- Select Level --</option>
                                <option value="Level 2"
                                    {{ old('level 2') == 'Level 2' ? 'selected' : '' }}>
                                    Level 2
                                </option>
                                <option value="Level 3"
                                    {{ old('level 3') == 'Level 3' ? 'selected' : '' }}>
                                    Level 3
                                </option>
                                <option value="Level 4"
                                    {{ old('level 4') == 'Level 4' ? 'selected' : '' }}>
                                    Level 4
                                </option>
                            </select>
                        </div>

                        {{-- Default Password Note --}}
                        <div class="form-group">
                            <small class="text-muted">
                                Default password will be
                                <b>{{ config('constants.default_student_password', 'student123') }}</b>
                                (student can change later).
                            </small>
                        </div>

                        <button class="btn btn-primary" type="submit">Add Student</button>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('scripts')
    <script>
        document.getElementById('image-upload').addEventListener('change', function(e) {
            const file = e.target.files[0];
            if (file) {
                document.getElementById('preview-img').src = URL.createObjectURL(file);
            }
        });
    </script>
@endpush
