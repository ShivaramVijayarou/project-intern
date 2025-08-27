<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Exam;
use App\Models\Note;

class StudentDashboardController extends Controller
{
    // public function index()
    // {
    //     return view('student.dashboard.index');
    // }

public function index()
{
    $student = Auth::user();

    $upcomingExams = Exam::where('program', $student->program)
                         ->whereDate('exam_date', '>=', now())
                         ->orderBy('exam_date')
                         ->take(3)
                         ->get();

    $recentNotes = Note::where('program', $student->program)
                       ->latest()
                       ->take(3)
                       ->get();



    return view('student.dashboard.index', compact('student', 'upcomingExams', 'recentNotes',));
}




}

// student.layouts.master
