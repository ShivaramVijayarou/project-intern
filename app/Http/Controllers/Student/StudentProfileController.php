<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;

class StudentProfileController extends Controller
{
    //


    //  function index(): View
    // {
    //     return view('student.dashboard.index');
    // }

    public function index(): View
{
    $student = Auth::user(); // logged-in student
    return view('student.profile.index', compact('student'));
}

}
