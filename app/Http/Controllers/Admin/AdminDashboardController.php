<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;
use App\Models\User;
use App\Models\Exam;
use Illuminate\Support\Facades\DB;


class AdminDashboardController extends Controller
{
    // function index() : View
    // {
    //     return view ('');

    // }

    public function index()
    {


        $totalUsers = User::count();   // count all users
        $totalExams = Exam::count();
        $upcomingExams = Exam::whereDate('exam_date', '>=', now())->count(); // future exams
        $todayExams = Exam::whereDate('exam_date', today())->count(); // exams today
        $programs = Exam::distinct('program')->count();
        $programStats = Exam::select('program', DB::raw('COUNT(*) as total'))
            ->groupBy('program')
            ->pluck('total', 'program');


        // return view('admin.dashboard.index', compact('totalUsers'));

        return view('admin.dashboard.index', compact('totalUsers', 'totalExams', 'upcomingExams', 'todayExams', 'programs', 'programStats'));
    }
}

//admin.profile.index
