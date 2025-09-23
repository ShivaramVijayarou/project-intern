<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Note;

class StudentNotesController extends Controller
{
    //

//     public function index()
// {
//     $studentProgram = Auth::user()->program;
//     $notes = Note::where('program', $studentProgram)->get();

//     return view('student.notes.index', compact('notes', 'studentProgram'));
// }

public function index(Request $request)
{
    // get the logged-in student's program
    $studentProgram = Auth::user()->program;

    // base query: only notes for this program
    $query = Note::where('program', $studentProgram);

    // optional search by title
    if ($request->filled('search')) {
        $query->where('title', 'like', '%'.$request->input('search').'%');
    }

    // optional filter by level
    if ($request->filled('level')) {
        $query->where('level', $request->input('level'));
    }

    // newest first + paginate
    $notes = $query->latest()->paginate(10);

    return view('student.notes.index', compact('notes', 'studentProgram'));
}




















}

