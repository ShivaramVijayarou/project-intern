<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Kaunseling;

class StudentKaunselingController extends Controller
{
    //
    public function index()
{
    // If you want to restrict to logged-in student:
    // $files = Kaunseling::where('student_id', Auth::id())->paginate(10);
    $files = Kaunseling::latest()->paginate(10);

    return view('student.kaunseling.index', compact('files'));
}

}
