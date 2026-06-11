<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Barryvdh\DomPDF\Facade\Pdf;

class StudentController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');
        $program = $request->input('program');
        $batchCode = $request->input('batch_code');

        $students = User::query()
            ->when($search, function ($query, $search) {
                $query->where(function ($q) use ($search) {
                    $q->where('name', 'like', "%{$search}%")
                      ->orWhere('ic', 'like', "%{$search}%");
                });
            })
            ->when($program, fn($query) => $query->where('program', $program))
            ->when($batchCode, fn($query) => $query->where('batch_code', 'like', "%{$batchCode}%"))
            ->where('role', 'user')
            ->orderBy('name', 'asc')
            ->paginate(30);

        $programs = User::where('role', 'user')->distinct()->pluck('program');

        return view('admin.student.index', compact('students', 'programs'));
    }

    public function create()
    {
        $programs = User::distinct()->pluck('program');
        return view('admin.student.add', compact('programs'));
    }

    public function store(Request $request)
    {
        // Validate all student + parent fields
        $validated = $request->validate([
            // Student fields
            'student_id'   => 'required|unique:users,student_id',
            'batch_code'   => 'nullable|string|max:100',
            'name'         => 'required|string|max:255',
            'email'        => 'required|email|unique:users,email',
            'ic'           => 'required|string|max:20|unique:users,ic|regex:/^\d{6}-\d{2}-\d{4}$/',
            'program'      => 'required|string|max:100',
            'phoneNo'      => 'nullable|string|max:20',
            'address'      => 'nullable|string|max:255',
            'level'        => 'nullable|string|max:255',
            'profileimage' => 'nullable|image|mimes:jpg,jpeg,png|max:3000',
            'start_date'   => 'required|date',
            'end_date'     => 'required|date|after_or_equal:start_date',
            'status'       => 'required|in:active,inactive',

            // Parent fields
            'parent_name'        => 'required|string|max:255',
            'parent_phone'       => 'required|string|max:20',
            'parent_relationship'=> 'nullable|string|max:50',
            'parent_email'       => 'nullable|email',
            'parent_address'     => 'nullable|string|max:255',
            'parent_occupation'  => 'nullable|string|max:255',
            'salary'             => 'nullable|numeric|min:0',
        ]);

        $photoPath = $request->hasFile('profileimage')
            ? $request->file('profileimage')->store('students', 'public')
            : 'uploads/profile.png';

        User::create([
            // Student
            'student_id' => $validated['student_id'],
            'batch_code' => $validated['batch_code'] ?? null,
            'name'       => $validated['name'],
            'email'      => $validated['email'],
            'phoneNo'    => $validated['phoneNo'] ?? null,
            'address'    => $validated['address'] ?? null,
            'ic'         => $validated['ic'],
            'program'    => $validated['program'],
            'level'      => $validated['level'] ?? null,
            'profileimage'=> $photoPath,
            'role'       => 'user',
            'status'     => $validated['status'],
            'start_date' => $validated['start_date'],
            'end_date'   => $validated['end_date'],
            'password'   => Hash::make(config('constants.default_student_password', 'student123')),

            // Parent
            'parent_name'         => $validated['parent_name'],
            'parent_relationship' => $validated['parent_relationship'] ?? null,
            'parent_phone'        => $validated['parent_phone'],
            'parent_email'        => $validated['parent_email'] ?? null,
            'parent_address'      => $validated['parent_address'] ?? null,
            'parent_occupation'   => $validated['parent_occupation'] ?? null,
            'salary'              => $validated['salary'] ?? null,
        ]);

        return redirect()->route('admin.students.index')
                         ->with('success', 'Student and parent details saved successfully!');
    }

    public function edit($id)
    {
        $student = User::findOrFail($id);
        return view('admin.student.edit', compact('student'));
    }

    public function update(Request $request, $id)
    {
        $student = User::findOrFail($id);

        $validated = $request->validate([
            'student_id' => 'required|unique:users,student_id,' . $student->id,
            'batch_code' => 'nullable|string|max:100',
            'name'       => 'required|string|max:255',
            'email'      => 'required|email|unique:users,email,' . $student->id,
            'ic'         => 'required|string|regex:/^\d{6}-\d{2}-\d{4}$/|unique:users,ic,' . $student->id,
            'program'    => 'required|string',
            'level'      => 'nullable|string|max:255',
            'phoneNo'    => 'nullable|string|max:20',
            'address'    => 'nullable|string|max:255',
            'start_date' => 'required|date',
            'end_date'   => 'required|date|after_or_equal:start_date',
            'status'     => 'required|in:active,inactive',
            'profileimage'=> 'nullable|image|mimes:jpg,jpeg,png|max:3000',

            // Parent fields
            'parent_name'        => 'required|string|max:255',
            'parent_phone'       => 'required|string|max:20',
            'parent_relationship'=> 'nullable|string|max:50',
            'parent_email'       => 'nullable|email',
            'parent_address'     => 'nullable|string|max:255',
            'parent_occupation'  => 'nullable|string|max:255',
            'salary'             => 'nullable|numeric|min:0',
        ]);

        if ($request->hasFile('profileimage')) {
            $photoPath = $request->file('profileimage')->store('students', 'public');
            $student->profileimage = $photoPath;
        }

        $student->update($validated);

        return redirect()->route('admin.students.index')
                         ->with('success', 'Student and parent details updated successfully!');
    }



    public function show($id)
{
    $student = User::findOrFail($id);
    return view('admin.student.show', compact('student'));
}

    public function destroy($id)
    {
        $student = User::findOrFail($id);

        if ($student->profileimage && $student->profileimage !== 'uploads/profile.png') {
            $imagePath = public_path($student->profileimage);
            if (file_exists($imagePath)) unlink($imagePath);
        }

        $student->delete();

        return redirect()->route('admin.students.index')
                         ->with('success', 'Student deleted successfully!');
    }
}
