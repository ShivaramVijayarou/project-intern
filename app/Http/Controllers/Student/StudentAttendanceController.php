<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Attendance;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class StudentAttendanceController extends Controller
{
    //
    // public function index()
    //     {
    //         $students = User::where('role', 'student')->get();
    //         return view('admin.attendance.index', compact('students'));
    //     }



    public function myAttendance()
    {
    $user = Auth::user();
    $attendances = Attendance::where('student_id', $user->id)
    ->orderBy('date', 'desc')
    ->get();


    $total = $attendances->count();
    $present = $attendances->whereIn('status', ['present', 'late'])->count();

    $percentage = $total > 0
        ? round(($present / $total) * 100, 1)
        : 0;

    return view('student.attendance.attendance', compact('attendances', 'user', 'percentage'));

}
}

