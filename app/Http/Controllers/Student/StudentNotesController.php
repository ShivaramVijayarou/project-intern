<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Note;

class StudentNotesController extends Controller
{
    //

    public function index()
{
    $studentProgram = Auth::user()->program;
    $notes = Note::where('program', $studentProgram)->get();

    return view('student.notes.index', compact('notes', 'studentProgram'));
}
}
