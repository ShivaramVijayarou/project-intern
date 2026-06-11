@extends('admin.layouts.master')

@section('content')
    <section class="section">
        <div class="section-body">
            <div class="card card-warning shadow-sm">
                <div class="card-header">
                    <h4>Edit Staff</h4>
                </div>

                <div class="card-body">
                    <form action="{{ route('admin.staff.update', $staff->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="form-group text-center">
                            <label class="d-block">Photo</label>
                            <div class="mb-3">
                                <img id="preview-img"
                                    src="{{ $staff->profileimage ? asset('storage/' . $staff->profileimage) : asset('uploads/profile.png') }}"
                                    class="rounded-circle border shadow-sm"
                                    style="width: 120px; height: 120px; object-fit: cover;">
                            </div>


<input type="file" name="profileimage">
                            <input type="file" name="profileimage" id="image-upload" class="form-control-file"
                                accept="image/*">
                            <small class="text-muted d-block mt-1">Leave empty if you don’t want to change the
                                photo.</small>
                        </div>

                        <div class="row">

                            <div class="form-group col-md-6">
                                <label>Staff ID</label>
                                <input type="text" class="form-control" name="staff_id"
                                    value="{{ old('staff_id', $staff->staff_id) }}" required>
                            </div>

                            <div class="form-group col-md-6">
                                <label>Full Name</label>
                                <input type="text" class="form-control" name="name"
                                    value="{{ old('name', $staff->name) }}" required>
                            </div>

                            <div class="form-group col-md-6">
                                <label>Email</label>
                                <input type="email" class="form-control" name="email"
                                    value="{{ old('email', $staff->email) }}">
                            </div>

                            <div class="form-group col-md-6">
                                <label>Phone</label>
                                <input type="text" class="form-control" name="phone"
                                    value="{{ old('phone', $staff->phone) }}">
                            </div>

                            <div class="form-group col-md-6">
                                <label>IC No</label>
                                <input type="text" class="form-control" name="ic_no"
                                    value="{{ old('ic_no', $staff->ic_no) }}">
                            </div>

                            <div class="form-group col-md-6">
                                <label>Department</label>
                                <input type="text" class="form-control" name="department"
                                    value="{{ old('department', $staff->department) }}">
                            </div>

                            <div class="form-group col-md-6">
                                <label>Level</label>
                                <input type="text" class="form-control" name="level"
                                    value="{{ old('level', $staff->level) }}">
                            </div>

                            <div class="form-group col-md-6">
                                <label>Start Date</label>
                                <input type="date" class="form-control" name="start_date"
                                    value="{{ old('start_date', optional($staff->start_date)->format('Y-m-d')) }}">
                            </div>

                            <div class="form-group col-md-6">
                                <label>Status</label>
                                <select name="status" class="form-control">
                                    <option value="active" {{ $staff->status == 'active' ? 'selected' : '' }}>Active
                                    </option>
                                    <option value="inactive" {{ $staff->status == 'inactive' ? 'selected' : '' }}>Inactive
                                    </option>
                                </select>
                            </div>

                        </div>

                        <!-- ===================== FAMILY DETAILS ===================== -->
                        <div class="my-4 text-center">
                            <hr>
                            <h4 class="text-muted">Parents / Spouse Details</h4>
                        </div>

                        <div id="family-wrapper">



                            @foreach ($staff->families ?? [] as $index => $family)
                                <div class="family-group border p-3 mb-3">

                                    <div class="row">
                                        <div class="col-md-6">
                                            <label>Name</label>
                                            <input type="text" name="family[{{ $index }}][name]"
                                                class="form-control" value="{{ $family->name }}">
                                        </div>

                                        <div class="col-md-6">
                                            <label>Relationship</label>
                                            <input type="text" name="family[{{ $index }}][relationship]"
                                                class="form-control" value="{{ $family->relationship }}">
                                        </div>

                                        <div class="col-md-6">
                                            <label>Phone</label>
                                            <input type="text" name="family[{{ $index }}][phone]"
                                                class="form-control" value="{{ $family->phone }}">
                                        </div>

                                        <div class="col-md-6">
                                            <label>Email</label>
                                            <input type="email" name="family[{{ $index }}][email]"
                                                class="form-control" value="{{ $family->email }}">
                                        </div>

                                        <div class="col-md-6">
                                            <label>Occupation</label>
                                            <input type="text" name="family[{{ $index }}][occupation]"
                                                class="form-control" value="{{ $family->occupation }}">
                                        </div>

                                        <div class="col-md-12">
                                            <label>Company Address</label>
                                            <textarea name="family[{{ $index }}][company_address]" class="form-control">{{ $family->company_address }}</textarea>
                                        </div>
                                    </div>

                                    <button type="button" class="btn btn-danger btn-sm mt-2 remove-family">
                                        Remove
                                    </button>

                                </div>
                            @endforeach

                        </div>

                        <!-- Add Family Button -->
                        <button type="button" class="btn btn-success mb-3" id="add-family">
                            + Add Family Member
                        </button>

                        <!-- Submit -->
                        <div class="card-footer text-right">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save"></i> Update Staff
                            </button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </section>

    <!-- JS for dynamic family -->
    <script>
        let index = {{ count($staff->families ?? []) }};

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
    </script>
@endsection
