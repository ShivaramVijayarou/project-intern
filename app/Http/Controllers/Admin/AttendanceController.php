<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Attendance;
use App\Models\User;

class AttendanceController extends Controller
{
    //
    //  public function index(Request $request)
    // {
    //     $query = Attendance::with('student')->orderBy('date', 'desc');

    //     // Filter by date (yyyy-mm-dd)
    //     if ($request->filled('date')) {
    //         $query->where('date', $request->date);
    //     }

    //     if ($request->filled('search')) {
    //         $search = $request->search;
    //         $query->whereHas('student', function ($q) use ($search) {
    //             $q->where('name', 'like', "%{$search}%");
    //         });
    //     }

    //     $students = User::where('role', 'student')->get();
    //       $attendances = $query->paginate(15)->withQueryString();

    //     return view('admin.attendance.index', compact('students', 'attendances'));
    // }


    public function index(Request $request)
{
    $query = Attendance::with('student')
        ->orderBy('date', 'desc')
        ->when($request->filled('date'), function ($q) use ($request) {
            $q->whereDate('date', $request->date);
        })
        ->when($request->filled('search'), function ($q) use ($request) {
            $q->whereHas('student', function ($q2) use ($request) {
                $q2->where('name', 'like', "%{$request->search}%");
            });
        })
        ->when($request->filled('level'), function ($q) use ($request) {
            $q->whereHas('student', function ($q2) use ($request) {
                $q2->where('level', $request->level);
            });
        })
        ->when($request->filled('program'), function ($q) use ($request) {
            $q->whereHas('student', function ($q2) use ($request) {
                $q2->where('program', $request->program);
            });
        });

    $attendances = $query->paginate(15)->withQueryString();

    // Only needed if you plan a student dropdown filter
    $users = User::where('role', 'user')->get();

     $levels = User::where('role', 'user')->select('level')->distinct()->pluck('level');
    $programs = User::where('role', 'user')->select('program')->distinct()->pluck('program');


    return view('admin.attendance.index', compact('users', 'attendances', 'levels', 'programs'));
}


// public function create()
// {
//     // Fetch all students (only those with role = student, if you use roles)
//     $users = User::where('role', 'user')->get();

//     return view('admin.attendance.create', compact('users'));
// }

  public function create()
    {
        // Fetch only students using the scope
        $students = User::students()->get();

        // Build dynamic lists for filters
        $levels = $students->pluck('level')->unique()->sort()->values();
        $programs = $students->pluck('program')->unique()->sort()->values();

        return view('admin.attendance.create', compact('students', 'levels', 'programs'));
    }














//      public function store(Request $request)
// {
//     $request->validate([
//         'date' => 'required|date',
//         'attendance' => 'required|array',
//     ]);

//     foreach ($request->attendance as $studentId => $status) {
//         Attendance::updateOrCreate(
//             [
//                 'student_id' => $studentId,
//                 'date'       => $request->date,
//             ],
//             [
//                 'status' => $status,
//             ]
//         );
// return redirect()->back()->with('success', "Attendance for {$request->date} recorded successfully.");
//     }


public function store(Request $request)
    {
        $request->validate([
            'date' => 'required|date',
            'attendance' => 'required|array',
        ]);

        foreach ($request->attendance as $studentId => $status) {
            Attendance::updateOrCreate(
                [
                    'student_id' => $studentId,
                    'date'       => $request->date,
                ],
                [
                    'status' => $status,
                ]
            );
        }

        return redirect()->route('admin.attendance.create')->with('success', 'Attendance saved successfully!');
    }







    public function edit($id)
{
    $attendance = Attendance::with('student')->findOrFail($id);

    return view('admin.attendance.edit', compact('attendance'));
}

public function update(Request $request, $id)
{
    $request->validate([
        'status' => 'required|in:present,absent,late',
        'date' => 'required|date',
    ]);

    $attendance = Attendance::findOrFail($id);
    $attendance->update([
        'status' => $request->status,
        'date' => $request->date,
    ]);

    return redirect()->route('admin.attendance.index')
                     ->with('success', 'Attendance updated successfully.');
}





public function destroy(Attendance $attendance)
    {
        //
         $attendance->delete();
        return redirect()->back()->with('success', 'Attendance deleted successfully!');

    }


}
