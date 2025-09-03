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
        $totalExams = Exam::count();   // total number of exam
        $upcomingExams = Exam::whereDate('exam_date', '>=', now())->count(); // future exams
        $todayExams = Exam::whereDate('exam_date', today())->count(); // exams today
        $programs = User::distinct('program')->count();

        // $programStats = User::select('program', DB::raw('COUNT(*) as total'))->groupBy('program')->pluck('total', 'program');
        // $programStats = DB::table('users')->select('program', DB::raw('count(*) as total'))->groupBy('program')->pluck('total', 'program');
        $programStats = User::whereNotNull('program')->where('program', '!=', '')->select('program', DB::raw('COUNT(*) as total'))->groupBy('program')->pluck('total', 'program');

        // only students
        // $ttlStudents = User::where('role', 'user')->count();


        // Total students across all programs
        $totalStudents = $programStats->sum();

        // Convert to percentages for pie/donut
        $programPercentages = $programStats->map(function ($count) use ($totalStudents) {
            return round(($count / $totalStudents) * 100, 2);
        });


        // return view('admin.dashboard.index', compact('totalUsers'));

        return view('admin.dashboard.index', compact('totalUsers', 'totalExams', 'upcomingExams', 'todayExams', 'programs', 'programStats',  'programPercentages', 'totalStudents'));
    }
}

//admin.profile.index
