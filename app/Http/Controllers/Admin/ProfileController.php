<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ProfilePasswordUpdateRequest;
use App\Http\Requests\Admin\ProfileUpdateRequest;
use App\Models\User;
use App\Traits\FileUploadTrait;
use Illuminate\Support\Facades\Auth;
use Illuminate\Contracts\View\View;

use Illuminate\Http\RedirectResponse;

class ProfileController extends Controller
{
    use FileUploadTrait;


    function index(): View
    {
        return view('admin.profile.index');
    }



    public function updateProfile(ProfileUpdateRequest $request): RedirectResponse
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();

        // Update basic info
        $user->name  = $request->name;
        $user->email = $request->email;
        $user->phoneNo = $request->phoneNo;

        // Handle profile image upload
        if ($request->hasFile('avatar')) {
            $file = $request->file('avatar');

            // Generate unique filename
            $filename = time() . '_' . $file->getClientOriginalName();

            // Move file to public/uploads
            $file->move(public_path('uploads'), $filename);

            // Save relative path in DB
            $user->profileimage = 'uploads/' . $filename;
        }

        $user->save();

        toastr()->success('Profile updated successfully!');
        return redirect()->back();
    }


    // password update
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
