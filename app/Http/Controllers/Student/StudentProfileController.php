<?php

namespace App\Http\Controllers\Student;

use App\Http\Requests\Admin\ProfilePasswordUpdateRequest;
use Illuminate\Http\RedirectResponse;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

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


function updatePassword(ProfilePasswordUpdateRequest $request): RedirectResponse
    {

        // dd($request->all());
        /** @var \App\Models\User $user */

        $user = Auth::user();
        $user->password = Bcrypt($request->password);
        $user->save();

        toastr()->success('Password Updated Successfully');

        return redirect()->back();
    }
}
