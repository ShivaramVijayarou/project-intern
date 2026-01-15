<?php

namespace App\Http\Controllers\Student;
use App\Models\LeaveForm;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

class StudentLeaveController extends Controller
{
    //
    public function index()
{
    // If you want to restrict to logged-in student:
    // $files = Kaunseling::where('student_id', Auth::id())->paginate(10);
    $files = LeaveForm::latest()->paginate(10);

    return view('student.leaveform.index', compact('files'));
}
}
