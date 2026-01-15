@extends('admin.layouts.master')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Mark Attendance</h1>
        </div>

        <div class="card">
            <div class="card-body">
                <form action="{{ route('admin.attendance.store') }}" method="POST" enctype="multipart/form-data">

                    @csrf

                    {{-- Date --}}
                    <div class="form-group mb-3">
                        <label for="date">Attendance Date</label>
                        <input type="date" name="date" id="date" class="form-control"
                            value="{{ now()->toDateString() }}" required>
                    </div>

                    {{-- Filters --}}
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label>Program</label>
                            <select id="programFilter" class="form-control">
                                <option value="">All Programs</option>
                                @foreach ($programs as $program)
                                    <option value="{{ $program }}">{{ $program }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-6">
                            <label>Level</label>
                            <select id="levelFilter" class="form-control">
                                <option value="">All Levels</option>
                                @foreach ($levels as $level)
                                    <option value="{{ $level }}">{{ $level }}</option>
                                @endforeach
                            </select>
                        </div>


                        <div class="col-md-6">
                            <label>Batch Code</label>
                            <select id="batchFilter" class="form-control">
                                <option value="">All Batch Code</option>
                                @foreach ($batchCodes as $batchCode)
                                    <option value="{{ $batchCode }}">{{ $batchCode }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    {{-- Attendance Table --}}
                    <div class="table-responsive">
                        <table class="table table-bordered text-center">
                            <thead class="bg-light">
                                <tr>
                                    <th>Student Name</th>
                                    <th>Present</th>
                                    <th>Absent</th>
                                    <th>Late</th>
                                    <th>Excused</th>
                                    <th>Evidence (for Excused)</th>
                                </tr>
                            </thead>
                            <tbody>


                                @foreach ($students as $student)
                                    <tr data-program="{{ $student->program }}" data-level="{{ $student->level }}"
                                        data-batch-code="{{ $student->batch_code }}">

                                        <td class="text-left">
                                            {{ $student->name }}<br>
                                            <small class="text-muted">
                                                {{ $student->program }} | {{ $student->level }}
                                            </small>
                                        </td>

                                        @foreach (['present', 'absent', 'late', 'excused'] as $status)
                                            <td>
                                                <input type="radio" name="attendance[{{ $student->id }}]"
                                                    value="{{ $status }}"
                                                    {{ $status === 'present' ? 'checked' : '' }}
                                                    onchange="toggleEvidence({{ $student->id }}, '{{ $status }}')">
                                            </td>
                                        @endforeach

                                        {{-- Evidence Upload --}}
                                        <td>
                                            <input type="file" name="evidence[{{ $student->id }}]"
                                                class="form-control evidence-input" id="evidence-{{ $student->id }}"
                                                accept="image/*,application/pdf" style="display:none" disabled>
                                        </td>
                                    </tr>
                                @endforeach

                            </tbody>
                        </table>
                    </div>

                    {{-- Submit --}}
                    <div class="text-right mt-3">
                        <button type="submit" class="btn btn-primary">
                            Save Attendance
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </section>

    <script>
        const programFilter = document.getElementById('programFilter');
        const levelFilter = document.getElementById('levelFilter');
        const batchFilter = document.getElementById('batchFilter');

        function filterStudents() {
            const program = programFilter.value;
            const level = levelFilter.value;
            const batchCode = batchFilter.value;

            document.querySelectorAll('tbody tr').forEach(row => {
                const rowProgram = row.dataset.program;
                const rowLevel = row.dataset.level;
                const rowBatch = row.dataset.batchCode;

                const showProgram = !program || rowProgram === program;
                const showLevel = !level || rowLevel === level;
                const showBatch = !batchCode || rowBatch === batchCode;

                const shouldShow = showProgram && showLevel && showBatch;

                // Show / hide row
                row.style.display = shouldShow ? '' : 'none';

                // Enable / disable inputs
                row.querySelectorAll('input[type="radio"], input[type="file"]').forEach(input => {
                    input.disabled = !shouldShow;
                });
            });
        }



        // Add event listeners for filters
        programFilter.addEventListener('change', filterStudents);
        levelFilter.addEventListener('change', filterStudents);
        batchFilter.addEventListener('change', filterStudents);

        // Add event listeners for radio buttons to toggle evidence
        document.querySelectorAll('input[type="radio"]').forEach(radio => {
            // radio.addEventListener('change', toggleEvidence);
        });
    </script>

    <script>
        function toggleEvidence(studentId, status) {
            const evidenceInput = document.getElementById('evidence-' + studentId);

            if (!evidenceInput) return;

            if (status === 'excused') {
                evidenceInput.style.display = 'block';
                evidenceInput.disabled = false;
                evidenceInput.required = true;
            } else {
                evidenceInput.style.display = 'none';
                evidenceInput.disabled = true;
                evidenceInput.required = false;
                evidenceInput.value = '';
            }
        }
    </script>
@endsection
