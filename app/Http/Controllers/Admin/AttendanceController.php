<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Attendance;
use App\Models\User;
use Carbon\Carbon;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Storage;

class AttendanceController extends Controller
{


    public function index(Request $request)
    {

        $query = Attendance::query()
            ->join('students', 'attendances.student_id', '=', 'students.id')
            ->select('attendances.*');

        $attendances = $this->applyFilters(
            Attendance::with('student')->orderBy('date', 'desc'),
            $request
        )->paginate(15)->withQueryString();

        $groupedAttendances = $attendances->getCollection()->groupBy('date');

        $levels = User::where('role', 'student')->distinct()->pluck('level');
        $programs = User::where('role', 'student')->distinct()->pluck('program');
        $startdates = User::where('role', 'student')->distinct()->pluck('start_date');
        $enddates = User::where('role', 'student')->distinct()->pluck('end_date');

        return view('admin.attendance.index', compact(
            'attendances',
            'groupedAttendances',
            'levels',
            'startdates',
            'enddates',
            'programs'
        ));
    }


    /* =========================
       PDF DOWNLOAD
    ==========================*/
    public function attendanceReport($studentId)
    {
        $student = User::findOrFail($studentId);

        $attendances = Attendance::where('student_id', $studentId)
            ->orderBy('date')
            ->get();

        $total = $attendances->count();
        $present = $attendances->where('status', 'present')->count();
        $absent = $attendances->where('status', 'absent')->count();
        $late = $attendances->where('status', 'late')->count();

        $percentage = $total > 0 ? round(($present / $total) * 100, 1) : 0;

        $pdf = Pdf::loadView(
            'admin.attendance.pdf',
            compact(
                'student',
                'attendances',
                'total',
                'present',
                'absent',
                'late',
                'percentage'
            )
        );

        return $pdf->stream('attendance-report-' . $student->student_id . '.pdf');
    }


    /* =========================
       PDF DOWNLOAD BASED BATCH CODE
    ==========================*/

    public function print(Request $request)
    {
        $attendances = $this->applyFilters(
            Attendance::with('student')->orderBy('date'),
            $request
        )->get();

        $summary = $attendances->groupBy('student_id')->map(function ($records) {

            $present = $records->where('status', 'present')->count();
            $total   = $records->count();

            $percentage = $total > 0
                ? round(($present / $total) * 100, 2)
                : 0;

            return [
                'name'       => $records->first()->student->name ?? '-',
                'batch'      => $records->first()->student->batch_code ?? '-',
                'program'    => $records->first()->student->program ?? '-',
                'start_date'    => $records->first()->student->start_date ?? '-',
                'end_date'    => $records->first()->student->end_date ?? '-',
                'level'    => $records->first()->student->level ?? '-',
                'present'    => $present,
                'absent'     => $records->where('status', 'absent')->count(),
                'total'      => $total,
                'percentage' => $percentage,
            ];
        });

        $batchAverage = round($summary->avg('percentage'), 2);

        return Pdf::loadView(
            'admin.attendance.pdf',
            compact('attendances', 'summary', 'batchAverage')
        )
            ->setPaper('A4', 'portrait')
            ->download('attendance-report.pdf');
    }


    private function applyFilters($query, Request $request)
    {
        return $query
            ->when(
                $request->filled('date'),
                fn($q) =>
                $q->whereDate('date', $request->date)
            )

            ->when($request->filled('month'), function ($q) use ($request) {
                $date = Carbon::parse($request->month);
                $q->whereMonth('date', $date->month)
                    ->whereYear('date', $date->year);
            })

            ->when(
                $request->filled('search'),
                fn($q) =>
                $q->whereHas(
                    'student',
                    fn($s) =>
                    $s->where('name', 'like', "%{$request->search}%")
                )
            )

            ->when(
                $request->filled('level'),
                fn($q) =>
                $q->whereHas(
                    'student',
                    fn($s) =>
                    $s->where('level', $request->level)
                )
            )

            ->when(
                $request->filled('program'),
                fn($q) =>
                $q->whereHas(
                    'student',
                    fn($s) =>
                    $s->where('program', $request->program)
                )
            )

            ->when(
                $request->filled('batch_code'),
                fn($q) =>
                $q->whereHas(
                    'student',
                    fn($s) =>
                    $s->where('batch_code', 'like', "%{$request->batch_code}%")
                )
            )

            ->when(
                $request->filled('from_date') && $request->filled('to_date'),
                fn($q) =>
                $q->whereBetween('date', [$request->from_date, $request->to_date])
            );
    }



    /* =========================
       CREATE ATTENDANCE
    ==========================*/
    public function create(Request $request)
    {

        $students = User::where('role', 'user')->get();

        $levels = $students->pluck('level')->unique()->sort()->values();
        $programs = $students->pluck('program')->unique()->sort()->values();
        $batchCodes = $students->pluck('batch_code')->unique()->sort()->values();
        $evidences = $students->pluck('evidence')->unique()->sort()->values();

        return view('admin.attendance.create', compact(
            'students',
            'batchCodes',
            'levels',
            'evidences',
            'programs'
        ));
    }



    public function batchPdf(Request $request)
    {
        $query = Attendance::with('student');

        // Date range (from_date & to_date)
        if ($request->filled('from_date')) {
            $query->whereDate('date', '>=', $request->from_date);
        }

        if ($request->filled('to_date')) {
            $query->whereDate('date', '<=', $request->to_date);
        }

        // Month filter (YYYY-MM)
        if ($request->filled('month')) {
            $query->whereMonth('date', Carbon::parse($request->month)->month)
                ->whereYear('date', Carbon::parse($request->month)->year);
        }

        // Batch code
        if ($request->filled('batch_code')) {
            $query->whereHas('student', function ($q) use ($request) {
                $q->where('batch_code', $request->batch_code);
            });
        }

        // Program
        if ($request->filled('program')) {
            $query->whereHas('student', function ($q) use ($request) {
                $q->where('program', $request->program);
            });
        }

        // Level
        if ($request->filled('level')) {
            $query->whereHas('student', function ($q) use ($request) {
                $q->where('level', $request->level);
            });
        }

        $attendances = $query->get();

        /**
         * ============================
         * BUILD STUDENT SUMMARY
         * ============================
         */
        $summary = [];
        $grouped = $attendances->groupBy('student_id');

        foreach ($grouped as $studentAttendances) {
            $student = $studentAttendances->first()->student;

            $total = $studentAttendances->count();
            $present = $studentAttendances->where('status', 'present')->count();
            $absent = $studentAttendances->where('status', 'absent')->count();

            $percentage = $total > 0
                ? round(($present / $total) * 100, 2)
                : 0;

            $summary[] = [
                'name' => $student->name,
                'batch' => $student->batch_code,
                'program' => $student->program,
                'present' => $present,
                'absent' => $absent,
                'total' => $total,
                'percentage' => $percentage,
                'start_date' => $student->start_date ?? '-',
                'end_date'   => $student->end_date ?? '-',

            ];
        }

        /**
         * ============================
         * CALCULATE BATCH AVERAGE
         * ============================
         */
        $batchAverage = count($summary) > 0
            ? round(collect($summary)->avg('percentage'), 2)
            : 0;

        /**
         * ============================
         * GENERATE PDF
         * ============================
         */
        $pdf = Pdf::loadView('admin.attendance.batchpdf', [
            'summary' => $summary,
            'batchAverage' => $batchAverage,
        ])->setPaper('a4', 'portrait');

        return $pdf->stream('attendance-report.pdf');
    }





    /* =========================
       STORE ATTENDANCE
    ==========================*/
    public function store(Request $request)
    {
        $request->validate([
            'date' => 'required|date',
            'attendance' => 'required|array',
            'attendance.*' => 'required|in:present,absent,late,excused',
            'evidence.*' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
        ]);

        $exists = Attendance::where('date', $request->date)->exists();

        foreach ($request->attendance as $studentId => $status) {

            $evidencePath = null;

            if ($status === 'excused' && $request->hasFile("evidence.$studentId")) {
                $evidencePath = $request
                    ->file("evidence.$studentId")
                    ->store('attendance_evidence', 'public');
            }

            Attendance::updateOrCreate(
                [
                    'student_id' => $studentId,
                    'date' => $request->date,
                ],
                [
                    'status' => $status,
                    'evidence' => $evidencePath, // ✅ THIS WAS MISSING
                ]
            );
        }

        return redirect()
            ->route('admin.attendance.create')
            ->with(
                $exists ? 'warning' : 'success',
                $exists ? 'Attendance already existed. Updated instead.' : 'Attendance saved successfully!'
            );
    }



    /* =========================
       EDIT SINGLE ATTENDANCE
    ==========================*/
    public function edit($id)
    {
        $attendance = Attendance::with('student')->findOrFail($id);
        return view('admin.attendance.edit', compact('attendance'));
    }

    /* =========================
       UPDATE ATTENDANCE
    ==========================*/
    // public function update(Request $request, $id)
    // {
    //     $request->validate([
    //         'date' => 'required|date',
    //         'status' => 'required|in:present,absent,late,excused',
    //     ]);

    //     Attendance::findOrFail($id)->update([
    //         'date' => $request->date,
    //         'status' => $request->status,
    //     ]);

    //     return redirect()
    //         ->route('admin.attendance.index')
    //         ->with('success', 'Attendance updated successfully.');
    // }

   public function update(Request $request, $id)
{
    $attendance = Attendance::findOrFail($id);

    $request->validate([
        'date' => 'required|date',
        'status' => 'required|in:present,absent,late,excused',
        'evidence' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
    ]);

    // Update basic fields
    $attendance->date = $request->date;
    $attendance->status = $request->status;

    // ✅ Handle evidence upload
    if ($request->hasFile('evidence')) {

        // 🔥 DELETE OLD FILE (THIS IS THE OPTIONAL PART)
        if ($attendance->evidence && Storage::disk('public')->exists($attendance->evidence)) {
            Storage::disk('public')->delete($attendance->evidence);
        }

        // Store new file
        $attendance->evidence = $request->file('evidence')
            ->store('attendance_evidence', 'public');
    }

    // ✅ If status is no longer excused, remove evidence
    if ($request->status !== 'excused') {

        // Delete old file if exists
        if ($attendance->evidence && Storage::disk('public')->exists($attendance->evidence)) {
            Storage::disk('public')->delete($attendance->evidence);
        }

        $attendance->evidence = null;
    }

    $attendance->save();

    return redirect()
        ->route('admin.attendance.index')
        ->with('success', 'Attendance updated successfully.');
}


    //$studentId
    public function studentSummary(User $student)
    {

        $attendances = Attendance::where('student_id', $student->id)
            ->orderBy('date', 'desc')
            ->get();

        $total = $attendances->count();

        $present = $attendances->where('status', 'present')->count();
        $absent  = $attendances->where('status', 'absent')->count();
        $late    = $attendances->where('status', 'late')->count();

        $percentage = $total > 0
            ? round(($present / $total) * 100, 1)
            : 0;

        return view('admin.attendance.summary', compact(
            'student',
            'attendances',
            'total',
            'present',
            'absent',
            'late',
            'percentage'
        ));
    }



    /* =========================
       DELETE ATTENDANCE
    ==========================*/
    public function destroy(Attendance $attendance)
    {

        $attendance->delete();
        return redirect()->back()->with('success', 'Attendance deleted successfully!');
    }
}
