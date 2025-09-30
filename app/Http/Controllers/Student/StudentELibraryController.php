<?php

namespace App\Http\Controllers\Student;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Elibrary;

class StudentELibraryController extends Controller
{
    //
    public function index(Request $request)
{
    $studentProgram = Auth::user()->program;
    $query = Elibrary::where('program', $studentProgram);
  

    if ($request->has('program') && $request->program !== '') {
        $query->where('program', $request->program);
    }

    $programFiles = $query->paginate(10);

    // For the filter dropdown (distinct programs)
    $programs = Elibrary::select('program')->distinct()->pluck('program');

    return view('student.elibrary.index', compact('programFiles', 'programs'));
}
}
