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
    $attendances = Attendance::where('student_id', $user);
    return view('student.attendance.index', compact('attendances'));
}
}
