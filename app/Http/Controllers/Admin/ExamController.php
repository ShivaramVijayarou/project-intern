<?php

namespace App\Http\Controllers\Admin;

use App\Models\Exam;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;

class ExamController extends Controller
{
    //
    public function index(Request $request)
{
    $query = Exam::query();

    if ($request->has('search') && $request->search != '') {
        $query->where('course_code', 'LIKE', "%{$request->search}%")
              ->orWhere('subject', 'LIKE', "%{$request->search}%");
    }

    $exams = $query->latest()->paginate(10);

    return view('admin.examination.index', compact('exams'));
}


     public function create()
    {
        return view('admin.examination.create');
    }


    public function edit($id)
{
    $exam = Exam::findOrFail($id);
    return view('admin.examination.edit', compact('exam'));
}

public function update(Request $request, $id)
{
    $request->validate([
        'program' => 'required|string',
        'course_code' => 'required|string|max:50',
        'course_name' => 'required|string|max:255',
        'exam_date' => 'required|date',
        'time_from' => 'required|date_format:H:i',
        'time_to' => 'required|date_format:H:i|after:time_from',
    ]);

    $exam = Exam::findOrFail($id);
    $exam->update($request->all());

    return redirect()->route('admin.exams.index')->with('success', 'Exam updated successfully!');
}


public function destroy(Exam $exam)
    {
        $exam->delete();
        return redirect()->back()->with('success', 'exam deleted successfully!');
    }


public function store(Request $request)
    {
        $request->validate([
            'program'     => 'required|string|max:255',
            'course_code' => 'required|string|max:255',
            'course_name'     => 'required|string|max:255',
            'exam_date'   => 'required|date',
            'time_from'   => 'required|date_format:H:i',
            'time_to'     => 'required|date_format:H:i|after:time_from',
        ]);

        Exam::create($request->all());

        return redirect()->route('admin.exams.index')->with('success', 'Exam added successfully.');
    }




}
