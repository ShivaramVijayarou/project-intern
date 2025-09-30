<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Result;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ResultController extends Controller
{
    //
    public function index(Request $request)
{
    $query = \App\Models\Result::query();

    if ($search = $request->input('search')) {
        $query->where('program', 'like', "%{$search}%")
              ->orWhere('level', 'like', "%{$search}%");
    }

    $files = $query->latest()->paginate(10); // or get()

    return view('admin.result.index', compact('files'));
}

public function create()
    {
        //
          return view('admin.result.create');
    }





public function store(Request $request)
{
    $request->validate([
        'program'   => 'required|string',
        'level'     => 'required|string',
        'file_name' => 'required|string|max:255',
        'file_path' => 'required|file|mimes:pdf,doc,docx,ppt,pptx,xls,xlsx',
    ]);

    $filePath = $request->file('file_path')->store('results', 'public');

    \App\Models\Result::create([
        'program'   => $request->program,
        'level'     => $request->level,
        'file_name' => $request->file_name,
        'file_path' => $filePath,
    ]);

    return redirect()->route('admin.result.index')->with('success','Result uploaded successfully.');
}







}
