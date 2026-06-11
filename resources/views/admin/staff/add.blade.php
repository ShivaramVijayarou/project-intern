@extends('admin.layouts.master')

@section('content')
    <section class="section">
        <div class="section-body">
            <div class="card card-primary">
                <div class="card-header">
                    <h4>Add New Staff</h4>
                </div>

                <div class="card-body">
                    <form action="{{ route('admin.staff.store') }}" method="POST">
                        @csrf

                        <!-- ================= STAFF INFORMATION ================= -->

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

                        <div class="form-group">
                            <label>Staff ID</label>
                            <input type="text" class="form-control" name="staff_id" value="{{ old('staff_id') }}"
                                required>
                        </div>

                        <div class="form-group">
                            <label>Full Name</label>
                            <input type="text" class="form-control" name="name" value="{{ old('name') }}" required>
                        </div>

                        <div class="form-group">
                            <label>Email</label>
                            <input type="email" class="form-control" name="email" value="{{ old('email') }}">
                        </div>

                        <div class="form-group">
                            <label>Phone</label>
                            <input type="text" class="form-control" name="phone" value="{{ old('phone') }}">
                        </div>

                        <div class="form-group">
                            <label>IC No</label>
                            <input type="text" class="form-control" name="ic_no" value="{{ old('ic_no') }}">
                        </div>

                        <div class="form-group">
                            <label>Department</label>
                            <input type="text" class="form-control" name="department" value="{{ old('department') }}">
                        </div>

                        <div class="form-group">
                            <label>Level</label>
                            <input type="text" class="form-control" name="level" value="{{ old('level') }}">
                        </div>

                        <div class="form-group">
                            <label>Start Date</label>
                            <input type="date" class="form-control" name="start_date" value="{{ old('start_date') }}">
                        </div>

                        <div class="form-group">
                            <label>Status</label>
                            <select name="status" class="form-control">
                                <option value="active" {{ old('status') == 'active' ? 'selected' : '' }}>Active</option>
                                <option value="inactive" {{ old('status') == 'inactive' ? 'selected' : '' }}>Inactive
                                </option>
                            </select>
                        </div>

                        <!-- ================= FAMILY DETAILS ================= -->

                        <div class="my-4 text-center">
                            <hr style="border-top: 2px solid #ddd;">
                            <h3 class="text-muted">Parents / Spouse Details</h3>
                        </div>

                        <div id="family-wrapper">

                            <!-- Default one row -->
                            <div class="family-group border p-3 mb-3">
                                <div class="row">

                                    <div class="col-md-6">
                                        <label>Name</label>
                                        <input type="text" name="family[0][name]" class="form-control">
                                    </div>

                                    <div class="col-md-6">
                                        <label>Relationship</label>
                                        <input type="text" name="family[0][relationship]" class="form-control">
                                    </div>

                                    <div class="col-md-6">
                                        <label>Phone</label>
                                        <input type="text" name="family[0][phone]" class="form-control">
                                    </div>

                                    <div class="col-md-6">
                                        <label>Email</label>
                                        <input type="email" name="family[0][email]" class="form-control">
                                    </div>

                                    <div class="col-md-6">
                                        <label>Occupation</label>
                                        <input type="text" name="family[0][occupation]" class="form-control">
                                    </div>

                                    <div class="col-md-12">
                                        <label>Company Address</label>
                                        <textarea name="family[0][company_address]" class="form-control"></textarea>
                                    </div>

                                </div>
                            </div>

                        </div>

                        <!-- Add More -->
                        <button type="button" class="btn btn-success mb-3" id="add-family">
                            + Add Family Member
                        </button>

                        <!-- Submit -->
                        <div class="card-footer text-right">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save"></i> Save Staff
                            </button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </section>

    <!-- ================= JS ================= -->
    <script>
        let index = 1;

        document.getElementById('add-family').addEventListener('click', function() {
            let html = `
    <div class="family-group border p-3 mb-3">
        <div class="row">

            <div class="col-md-6">
                <label>Name</label>
                <input type="text" name="family[${index}][name]" class="form-control">
            </div>

            <div class="col-md-6">
                <label>Relationship</label>
                <input type="text" name="family[${index}][relationship]" class="form-control">
            </div>

            <div class="col-md-6">
                <label>Phone</label>
                <input type="text" name="family[${index}][phone]" class="form-control">
            </div>

            <div class="col-md-6">
                <label>Email</label>
                <input type="email" name="family[${index}][email]" class="form-control">
            </div>

            <div class="col-md-6">
                <label>Occupation</label>
                <input type="text" name="family[${index}][occupation]" class="form-control">
            </div>

            <div class="col-md-12">
                <label>Company Address</label>
                <textarea name="family[${index}][company_address]" class="form-control"></textarea>
            </div>

        </div>

        <button type="button" class="btn btn-danger btn-sm mt-2 remove-family">Remove</button>
    </div>
    `;

            document.getElementById('family-wrapper').insertAdjacentHTML('beforeend', html);
            index++;
        });

        document.addEventListener('click', function(e) {
            if (e.target.classList.contains('remove-family')) {
                e.target.closest('.family-group').remove();
            }
        });

        document.getElementById('image-upload').addEventListener('change', function(e) {
            const file = e.target.files[0];
            if (file) {
                document.getElementById('preview-img').src = URL.createObjectURL(file);
            }
        });
    </script>
@endsection

