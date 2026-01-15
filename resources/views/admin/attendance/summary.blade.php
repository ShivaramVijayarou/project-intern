@extends('admin.layouts.master')

@section('content')
    <section class="section">

        <div class="section-header">
            <h1>
                Attendance Summary
                <small class="text-muted">— {{ $student->name }}</small>
            </h1>


        </div>



        <div class="section-header d-flex justify-content-between align-items-center">
            <a href="{{ route('admin.attendance.index') }}" class="btn btn-primary">
                <i class="fas fa-arrow-left"></i> Back
            </a>

            <div>
                {{-- <button onclick="window.print()" class="btn btn-primary">
               <i class="fas fa-print"></i> Print
               </button> --}}

                {{-- <button onclick="printAttendance()" class="btn btn-primary">
                    <i class="fas fa-print"></i> Print Report
                </button> --}}

                <a href="{{ route('admin.attendance.pdf', $student->id) }}"
   target="_blank"
   class="btn btn-primary">
    <i class="fas fa-print"></i> Print Attendance
</a>
            </div>
        </div>





        {{-- Student Info --}}
        <div class="card mb-4">
            <div class="card-body row">
                <div class="col-md-4"><strong>Level:</strong> {{ $student->level }}</div>
                <div class="col-md-4"><strong>Program:</strong> {{ $student->program }}</div>
                <div class="col-md-4">
                    <strong>Attendance:</strong>
                    <span class="badge badge-success">{{ $percentage }}%</span>
                </div>
            </div>
        </div>

        {{-- Statistics --}}
        <div class="row mb-4">
            <div class="col-md-3">
                <div class="card text-center">
                    <div class="card-body">
                        <h6>Total Classes</h6>
                        <h4>{{ $total }}</h4>
                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="card text-center bg-success text-white">
                    <div class="card-body">
                        <h6>Present</h6>
                        <h4>{{ $present }}</h4>
                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="card text-center bg-danger text-white">
                    <div class="card-body">
                        <h6>Absent</h6>
                        <h4>{{ $absent }}</h4>
                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="card text-center bg-warning text-white">
                    <div class="card-body">
                        <h6>Late</h6>
                        <h4>{{ $late }}</h4>
                    </div>
                </div>
            </div>
        </div>

        {{-- Attendance History --}}
        <div class="card">
            <div class="card-header">
                <h4>Attendance History</h4>
            </div>

            <div class="card-body table-responsive">
                <table class="table table-bordered text-center">
                    <thead>
                        <tr>
                            <th>Date</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($attendances as $attendance)
                            <tr>
                                <td>{{ \Carbon\Carbon::parse($attendance->date)->format('d M Y') }}</td>
                                <td>
                                    <span
                                        class="badge badge-{{ $attendance->status == 'present' ? 'success' : ($attendance->status == 'absent' ? 'danger' : 'warning') }}">
                                        {{ ucfirst($attendance->status) }}
                                    </span>
                                </td>
                                <td>
                                    <a href="{{ route('admin.attendance.edit', $attendance->id) }}"
                                        class="btn btn-warning btn-sm">
                                        <i class="fas fa-edit"></i>
                                    </a>

                                    <form action="{{ route('admin.attendance.destroy', $attendance->id) }}" method="POST"
                                        class="d-inline-block" onsubmit="return confirm('Are you sure?')">
                                        @csrf
                                        @method('DELETE')

                                        <button class="btn btn-danger btn-sm">
                                            <i class="fas fa-trash-alt"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="2">No records found</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>


        @push('styles')
            <style>
                @media print {

                    /* Hide unnecessary UI */
                    .main-sidebar,
                    .navbar-bg,
                    .main-footer,
                    .section-header button,
                    .section-header a {
                        display: none !important;
                    }

                    /* Remove margins */
                    body {
                        background: white !important;
                    }

                    .card {
                        border: 1px solid #000 !important;
                        box-shadow: none !important;
                    }

                    /* Make table clearer */
                    table {
                        width: 100% !important;
                        border-collapse: collapse !important;
                    }

                    table th,
                    table td {
                        border: 1px solid #000 !important;
                        padding: 8px !important;
                        color: #000 !important;
                    }

                    /* Ensure badges print nicely */
                    .badge {
                        border: 1px solid #000;
                        padding: 5px 10px;
                    }
                }
            </style>
        @endpush
    @endsection
