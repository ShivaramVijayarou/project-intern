<?php

namespace App\Http\Controllers\Staff;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;

class StaffDashboardController extends Controller
{
    //

    function index() : View
    {
        return view ('staff.dashboard.index');
    }
}
