<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class StudentController extends Controller
{


    public function index(Request $request)
    {
        $search = $request->input('search');
        $program = $request->input('program');

        $students = User::query()
            ->when($search, function ($query, $search) {
               $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('student_id', 'like', "%{$search}%");
                      });
            })
            ->when($program, function ($query, $program) {
            $query->where('program', $program);
                })
            ->where('role', 'user') // only show students
            ->orderBy('name', 'asc') // <-- sort alphabetically by name
            ->paginate(10); // optional pagination


$programs = User::where('role','user')->distinct()->pluck('program');

        return view('admin.student.index', compact('students', 'programs'));
    }


    // Show add student form
    // public function create()
    // {
    //     return view('admin.student.add');
    // }

    public function create()
    {
        // Get all distinct programs from exams table (or you can create a separate programs table later)
        $programs = User::distinct()->pluck('program');

        return view('admin.student.add', compact('programs'));
    }





    //Store new Student
    public function store(Request $request)
{
    $request->validate([
        'student_id'   => 'required|unique:users,student_id',
        'name'         => 'required|string|max:255',
        'email'        => 'required|email|unique:users,email',
        'ic'           => 'required|string|max:20|unique:users,ic|regex:/^\d{6}-\d{2}-\d{4}$/',
        'program'      => 'required|string|max:100',
        'phoneNo'      => 'nullable|string|max:20',
        'address'      => 'nullable|string|max:255',
        'level'      => 'nullable|string|max:255',
        'profileimage' => 'nullable|image|mimes:jpg,jpeg,png|max:3000',
        'status'       => 'required|in:active,inactive',
    ]);

    $photoPath = null;

    if ($request->hasFile('profileimage')) {
        // Store only relative path like "students/xxx.jpg"
        $photoPath = $request->file('profileimage')->store('students', 'public');
    }

    User::create([
        'student_id'   => $request->student_id,
        'name'         => $request->name,
        'email'        => $request->email,
        'phoneNo'      => $request->phoneNo,
        'address'      => $request->address,
        'ic'           => $request->ic,
        'program'      => $request->program,
        'level'        => $request->level,
        'profileimage' => $photoPath ?? 'uploads/profile.png',
        'role'         => 'user',
        'status'       => $request->status,
        'password'     => Hash::make('student123'), // default password
    ]);

    return redirect()->route('admin.students.index')
        ->with('success', 'Student added successfully!');
}


    // View student info
    // public function show($id)
    // {
    //     $user = User::findOrFail($id);

    //     return view('admin.students.show', compact('student'));
    // }

public function show($id)
{
    $student = User::findOrFail($id); // fetch student by ID
    return view('admin.student.view', compact('student'));

}



    // Edit student info
    public function edit($id)
    {
        $student = User::findOrFail($id); // Get student by ID
        return view('admin.student.edit', compact('student'));
    }


    public function update(Request $request, $id)
    {
        $student = User::findOrFail($id);

        $validated =$request->validate([
            'student_id' => 'required|unique:users,student_id,' . $student->id,
            'name'       => 'required|string|max:255',
            'email'      => 'required|email|unique:users,email,' . $student->id,
           'ic'          => 'required|string|regex:/^\d{6}-\d{2}-\d{4}$/|unique:users,ic,' . $student->id,
            'program'    => 'required|in:Kemahiran Elektrik,Kemahiran Mekatronik',
            'level'     => 'required|string',
            'phoneNo'    => 'nullable|string|max:20',
            'address'    => 'nullable|string|max:255',
            'status'     => 'required|in:active,inactive',
            'profileimage'      => 'nullable|image|mimes:jpg,jpeg,png|max:3000',
        ]);

        // Handle new photo upload
        if ($request->hasFile('profileimage')) {
            $photoPath = $request->file('profileimage')->store('students', 'public');
            $student->profileimage = $photoPath;
        }

        // Update other fields
        $student->update([
            'student_id' => $request->student_id,
            'name'       => $request->name,
            'email'      => $request->email,
            'phoneNo'    => $request->phoneNo,
            'address'    => $request->address,
            $student->ic = $validated['ic'],
            'program'    => $request->program,
            'level'    => $request->level,
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
