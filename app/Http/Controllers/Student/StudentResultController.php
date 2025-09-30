<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Result;


class StudentResultController extends Controller
{
    //
    public function index(Request $request)
{
    $studentProgram = Auth::user()->program;// or however you store it
     $studentLevel   = Auth::user()->level;

    $query = Result::where('program', $studentProgram) ->where('level', $studentLevel);

    if ($request->filled('level')) {
        $query->where('level', $request->level);
    }

    $results = $query->latest()->paginate(10);

    return view('student.result.index', compact('results', 'studentProgram', 'studentLevel'));
}
}
