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
    $studentProgram = $student->program;

    // Notes
    $notes = Note::where('program', $studentProgram)->latest()->get();
    $notesCount = $notes->count();
    $recentNotes = $notes->take(3);

    // Upcoming exams
    $exams = Exam::where('program', $studentProgram)
        ->whereDate('exam_date', '>=', now())
        ->orderBy('exam_date', 'asc')
        ->take(3)
        ->get();

    $upcomingExamsCount = $exams->count(); // ✅ count exams

    return view('student.dashboard.index', compact(
        'student',
        'studentProgram',
        'notes',
        'notesCount',
        'recentNotes',
        'exams',
        'upcomingExamsCount' // ✅ pass count to blade
    ));

}
}

// student.layouts.master
