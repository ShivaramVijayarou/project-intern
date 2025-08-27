<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class StudentController extends Controller
{


    //Show student list
    // public function index()
    // {
    //     $students = User::where('role', 'user')->get();
    //     return view('admin.student.index', compact('students'));
    // }


    public function index(Request $request)
{
    $search = $request->input('search');

    $students = User::query()
        ->when($search, function ($query, $search) {
            $query->where('name', 'like', "%{$search}%")
                  ->orWhere('student_id', 'like', "%{$search}%");
        })
        ->where('role', 'user') // only show students
        ->paginate(10); // optional pagination

    return view('admin.student.index', compact('students'));
}


    // Show add student form
    public function create()
    {
        return view('admin.student.add');
    }




    //Store new Student
    public function store(Request $request)
    {
        $request->validate([
            'student_id' => 'required|unique:users,student_id',
            'name'       => 'required|string|max:255',
            'email'      => 'required|email|unique:users,email',
            'ic'         => 'required|string|max:20|unique:users,ic',
            'program'    => 'required|string|max:100',
            'phoneNo'    => 'nullable|string|max:20',
            'address'    => 'nullable|string|max:255',
            'photo'      => 'nullable|image|mimes:jpg,jpeg,png|max:3000',
            'status'     => 'required|in:active,inactive',
        ]);

        // Handle photo upload
        $photoPath = null;
        if ($request->hasFile('photo')) {
            $photoPath = $request->file('photo')->store('students', 'public');
            // Stored as: storage/students/filename.jpg
        }

        User::create([
            'student_id'   => $request->student_id,
            'name'         => $request->name,
            'email'        => $request->email,
            'phoneNo'      => $request->phoneNo,
            'address'      => $request->address,
            'ic'           => $request->ic,
            'program'      => $request->program,
            'profileimage' => $photoPath ? 'storage/' . $photoPath : 'uploads/profile.png',
            'role'         => 'user',
            'status'       => $request->status,
            'password'     => Hash::make('student123'), // default password
        ]);

        return redirect()->route('admin.students.index')
            ->with('success', 'Student added successfully!');
    }


    // View student info
   public function show(User $user, $id)
    {
        $user = User::find($id);

        return view('admin.student.view')->with('user', $user);
    }


    public function edit($id)
{
    $student = User::findOrFail($id); // Get student by ID
    return view('admin.student.edit', compact('student'));
}


public function update(Request $request, $id)
{
    $student = User::findOrFail($id);

    $request->validate([
        'student_id' => 'required|unique:users,student_id,' . $student->id,
        'name'       => 'required|string|max:255',
        'email'      => 'required|email|unique:users,email,' . $student->id,
        'ic'         => 'required|string|max:20|unique:users,ic,' . $student->id,
        'program'    => 'required|in:Kemahiran Elektrik,Kemahiran Mekatronik',
        'phoneNo'    => 'nullable|string|max:20',
        'address'    => 'nullable|string|max:255',
        'status'     => 'required|in:active,inactive',
        'photo'      => 'nullable|image|mimes:jpg,jpeg,png|max:3000',
    ]);

    // Handle new photo upload
    if ($request->hasFile('photo')) {
        $photoPath = $request->file('photo')->store('students', 'public');
        $student->profileimage = 'storage/' . $photoPath;
    }

    // Update other fields
    $student->update([
        'student_id' => $request->student_id,
        'name'       => $request->name,
        'email'      => $request->email,
        'phoneNo'    => $request->phoneNo,
        'address'    => $request->address,
        'ic'         => $request->ic,
        'program'    => $request->program,
        'status'     => $request->status,
        'profileimage' => $student->profileimage, // keep updated photo
    ]);

    return redirect()->route('admin.students.index')
        ->with('success', 'Student updated successfully!');
}



    public function destroy($id)
{
    $student = User::findOrFail($id);

    // If the student has a profile image and it's not the default, delete it
    if ($student->profileimage && $student->profileimage !== 'uploads/profile.png') {
        $imagePath = public_path($student->profileimage);
        if (file_exists($imagePath)) {
            unlink($imagePath);
        }
    }

    $student->delete();

    return redirect()->route('admin.students.index')
        ->with('success', 'Student deleted successfully!');
}

}
