<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Info;

class StudentInfoController extends Controller
{
    //

      public function index()
{
    // If you want to restrict to logged-in student:
    // $files = Kaunseling::where('student_id', Auth::id())->paginate(10);
    $files = Info::latest()->paginate(10);

    return view('student.info.index', compact('files'));
}
}
