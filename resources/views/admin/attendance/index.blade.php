@extends('admin.layouts.master')

@section('content')
    <section class="section">

        {{-- Header --}}
        <div class="section-header d-flex justify-content-between align-items-center">
            <h1>Attendance</h1>

            <a href="{{ route('admin.attendance.create') }}" class="btn btn-primary">
                <i class="fas fa-plus"></i> Add Attendance
            </a>
        </div>

        {{-- Filters --}}
        <div class="card mb-4">
            <div class="card-body">
                <form method="GET" action="{{ route('admin.attendance.index') }}" class="row g-3 align-items-end">

                    <div class="col-md-2">
                        <label>Date</label>
                        <input type="date" name="date" class="form-control" value="{{ request('date') }}">
                    </div>

                    <div class="col-md-2">
                        <label>Month</label>
                        <input type="month" name="month" class="form-control" value="{{ request('month') }}">
                    </div>

                    <div class="col-md-3">
                        <label>Student Name</label>
                        <input type="text" name="search" class="form-control" value="{{ request('search') }}">
                    </div>

                    <div class="col-md-2">
                        <label>Batch Code</label>
                        <input type="text" name="batch_code" class="form-control" value="{{ request('batch_code') }}">
                    </div>

                    <div class="col-md-3">
                        <label>Program</label>
                        <select name="program" class="form-control">
                            <option value="">All Programs</option>
                            <option value="Kemahiran Elektrik"
                                {{ request('program') == 'Kemahiran Elektrik' ? 'selected' : '' }}>
                                Kemahiran Elektrik
                            </option>
                            <option value="Kemahiran Mekatronik"
                                {{ request('program') == 'Kemahiran Mekatronik' ? 'selected' : '' }}>
                                Kemahiran Mekatronik
                            </option>
                        </select>
                    </div>

                    {{-- Level --}}
                    <div class="col-md-2">
                        <label class="form-label">Level</label>
                        <select name="level" class="form-control">
                            <option value="">All Levels</option>
                            @foreach (['level 2', 'level 3', 'level 4'] as $lvl)
                                <option value="{{ $lvl }}" {{ request('level') == $lvl ? 'selected' : '' }}>
                                    {{ ucfirst($lvl) }}
                                </option>
                            @endforeach
                        </select>
                    </div>


                    


                    <div class="col-md-4 d-flex gap-2 mt-3">
                        <button class="btn btn-primary w-100">
                            <i class="fas fa-filter"></i> Apply
                        </button>

                        <a href="{{ route('admin.attendance.batchpdf', request()->query()) }}" class="btn btn-danger w-100"
                            target="_blank">
                            <i class="fas fa-file-pdf"></i> Print PDF
                        </a>
                    </div>

                </form>
            </div>
        </div>

        {{-- Attendance Table --}}
        <div class="card">
            <div class="card-body">

                @if ($attendances->isEmpty())
                    <div class="alert alert-info text-center mb-0">
                        No attendance records found.
                    </div>
                @else
                    {{-- Legend --}}
                    <div class="mb-3">
                        <span class="badge badge-success mr-2"><i class="fas fa-check"></i> Present</span>
                        <span class="badge badge-warning mr-2"><i class="fas fa-clock"></i> Late</span>
                        <span class="badge badge-danger mr-2"><i class="fas fa-times"></i> Absent</span>
                        <span class="badge badge-info mr-2"><i class="fas fa-file"></i> Excused</span>
                    </div>

                    <div class="table-responsive">
                        <table class="table table-bordered table-hover text-center align-middle">
                            <thead class="thead-dark">
                                <tr>
                                    <th>Date</th>
                                    <th>Batch</th>
                                    <th>Student</th>
                                    <th>Level</th>
                                    <th>Program</th>
                                    <th>Status</th>
                                    <th>Evidence</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach ($attendances as $attendance)
                                    <tr>
                                        <td>{{ \Carbon\Carbon::parse($attendance->date)->format('d M Y') }}</td>

                                        <td>{{ $attendance->student->batch_code }}</td>

                                        <td>
                                            <a href="{{ route('admin.attendance.summary', $attendance->student->id) }}"
                                                class="text-primary font-weight-bold">
                                                {{ $attendance->student->name }}
                                            </a>
                                        </td>

                                        <td>
                                            <span class="badge badge-light">
                                                {{ $attendance->student->level }}
                                            </span>
                                        </td>

                                        <td>{{ $attendance->student->program }}</td>

                                        {{-- Status --}}
                                        <td>
                                            @php
                                                $colors = [
                                                    'present' => 'success',
                                                    'absent' => 'danger',
                                                    'late' => 'warning',
                                                    'excused' => 'info',
                                                ];
                                                $icons = [
                                                    'present' => 'fa-check-circle',
                                                    'absent' => 'fa-times-circle',
                                                    'late' => 'fa-clock',
                                                    'excused' => 'fa-file-alt',
                                                ];
                                            @endphp

                                            <span class="badge badge-{{ $colors[$attendance->status] }}">
                                                <i class="fas {{ $icons[$attendance->status] }}"></i>
                                                {{ ucfirst($attendance->status) }}
                                            </span>
                                        </td>

                                        {{-- Evidence Button --}}
                                        <td>
                                            @if ($attendance->status === 'excused' && $attendance->evidence)
                                                <button class="btn btn-info btn-sm" data-toggle="modal"
                                                    data-target="#evidenceModal{{ $attendance->id }}">
                                                    <i class="fas fa-eye"></i> View
                                                </button>
                                            @else
                                                <span class="text-muted">—</span>
                                            @endif
                                        </td>

                                        {{-- Actions --}}
                                        <td>
                                            <div class="d-flex justify-content-center align-items-center gap-2">

                                                {{-- Edit --}}
                                                <a href="{{ route('admin.attendance.edit', $attendance->id) }}"
                                                    class="btn btn-warning btn-sm mr-2">
                                                    <i class="fas fa-edit"></i>
                                                </a>

                                                {{-- Delete --}}
                                                <form action="{{ route('admin.attendance.destroy', $attendance->id) }}"
                                                    method="POST" onsubmit="return confirm('Delete this record?')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button class="btn btn-danger btn-sm">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </form>

                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    {{-- Pagination --}}
                    <div class="d-flex justify-content-center mt-4">
                        {{ $attendances->links('pagination::bootstrap-4') }}
                    </div>
                @endif

            </div>
        </div>

    </section>

    {{-- ===================== MODALS OUTSIDE TABLE ===================== --}}
    @foreach ($attendances as $attendance)
        @if ($attendance->status === 'excused' && $attendance->evidence)
            <div class="modal fade" id="evidenceModal{{ $attendance->id }}" tabindex="-1">
                <div class="modal-dialog modal-lg modal-dialog-centered">
                    <div class="modal-content">

                        <div class="modal-header">
                            <h5 class="modal-title">
                                Excused Evidence — {{ $attendance->student->name }}
                            </h5>
                            <button type="button" class="close" data-dismiss="modal">
                                <span>&times;</span>
                            </button>
                        </div>

                        <div class="modal-body text-center">
                            @if (Str::endsWith($attendance->evidence, ['jpg', 'jpeg', 'png']))
                                <img src="{{ asset('storage/' . $attendance->evidence) }}" class="img-fluid rounded">
                            @else
                                <iframe src="{{ asset('storage/' . $attendance->evidence) }}" width="100%"
                                    height="500" style="border:none;"></iframe>
                            @endif
                        </div>

                    </div>
                </div>
            </div>
        @endif
    @endforeach

@endsection

@push('scripts')
    <script>
        // Safety: prevent stuck backdrop
        $(document).on('hidden.bs.modal', function() {
            $('body').removeClass('modal-open');
            $('.modal-backdrop').remove();
        });
    </script>
@endpush
