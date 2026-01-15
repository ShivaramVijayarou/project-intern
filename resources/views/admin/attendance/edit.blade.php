{{-- @extends('admin.layouts.master')

@section('content')
<section class="section">
    <div class="section-header">
        <h1>Edit Attendance</h1>
    </div>

    <div class="card">
        <div class="card-body">
            <form action="{{ route('admin.attendance.update', $attendance->id) }}" method="POST">
                @csrf
                @method('PUT')

                <!-- Student Info (read-only) -->
                <div class="form-group mb-3">
                    <label>Student:</label>
                    <input type="text" class="form-control" value="{{ $attendance->student->name }}" disabled>
                </div>

                <!-- Date -->
                <div class="form-group mb-3">
                    <label for="date">Date:</label>
                    <input type="date" name="date" id="date" class="form-control"
                           value="{{ $attendance->date }}" required>
                </div>

                <!-- Status -->
                <div class="form-group mb-3">
                    <label for="status">Status:</label>
                    <select name="status" id="status" class="form-control" required>
                        <option value="present" {{ $attendance->status == 'present' ? 'selected' : '' }}>Present</option>
                        <option value="absent" {{ $attendance->status == 'absent' ? 'selected' : '' }}>Absent</option>
                        <option value="late" {{ $attendance->status == 'late' ? 'selected' : '' }}>Late</option>
                    </select>
                </div>

                <button type="submit" class="btn btn-primary">Update Attendance</button>
                <a href="{{ route('admin.attendance.index') }}" class="btn btn-secondary">Cancel</a>
            </form>
        </div>
    </div>
</section>
@endsection


 --}}


 @extends('admin.layouts.master')

@section('content')
<section class="section">
    <div class="section-header">
        <h1>Edit Attendance</h1>
    </div>

    <div class="card">
        <div class="card-body">
            <form action="{{ route('admin.attendance.update', $attendance->id) }}"
                  method="POST" enctype="multipart/form-data">

                @csrf
                @method('PUT')

                {{-- Student Info --}}
                <div class="form-group mb-3">
                    <label>Student</label>
                    <input type="text" class="form-control"
                           value="{{ $attendance->student->name }}" disabled>
                </div>

                {{-- Date --}}
                <div class="form-group mb-3">
                    <label for="date">Date</label>
                    <input type="date" name="date" id="date" class="form-control"
                           value="{{ $attendance->date }}" required>
                </div>

                {{-- Status --}}
                <div class="form-group mb-3">
                    <label for="status">Status</label>
                    <select name="status" id="status" class="form-control"
                            onchange="toggleEvidence()" required>
                        <option value="present" {{ $attendance->status === 'present' ? 'selected' : '' }}>Present</option>
                        <option value="absent" {{ $attendance->status === 'absent' ? 'selected' : '' }}>Absent</option>
                        <option value="late" {{ $attendance->status === 'late' ? 'selected' : '' }}>Late</option>
                        <option value="excused" {{ $attendance->status === 'excused' ? 'selected' : '' }}>Excused</option>
                    </select>
                </div>

                {{-- Existing Evidence --}}
                @if ($attendance->evidence)
                    <div class="mb-2">
                        <a href="{{ asset('storage/'.$attendance->evidence) }}"
                           target="_blank" class="btn btn-sm btn-info">
                            View Existing Evidence
                        </a>
                    </div>
                @endif

                {{-- Evidence Upload --}}
                <div class="form-group mb-3" id="evidenceWrapper"
                     style="{{ $attendance->status === 'excused' ? '' : 'display:none' }}">
                    <label>Upload Evidence (Optional)</label>
                    <input type="file" name="evidence"
                           class="form-control"
                           accept="image/*,application/pdf">
                    <small class="text-muted">
                        Leave empty to keep existing evidence.
                    </small>
                </div>

                {{-- Actions --}}
                <button type="submit" class="btn btn-primary">Update Attendance</button>
                <a href="{{ route('admin.attendance.index') }}" class="btn btn-secondary">Cancel</a>
            </form>
        </div>
    </div>
</section>

{{-- Toggle Evidence --}}
<script>
function toggleEvidence() {
    const status = document.getElementById('status').value;
    const wrapper = document.getElementById('evidenceWrapper');

    if (status === 'excused') {
        wrapper.style.display = 'block';
    } else {
        wrapper.style.display = 'none';
    }
}
</script>
@endsection
