<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Exam;
use Illuminate\Support\Facades\Auth;

class StudentExamController extends Controller
{
    public function index()
    {
        // Assuming your User model has a 'program' field (Elektrik / Mekatronik)
        $studentProgram = Auth::user()->program;

        // Get exams for that program only
        $exams = Exam::where('program', $studentProgram)
            ->orderBy('exam_date', 'asc')
            ->get();

        return view('student.examination.index', compact('exams', 'studentProgram'));
    }
}
