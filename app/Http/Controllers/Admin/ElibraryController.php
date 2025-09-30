<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Elibrary;
use Illuminate\Support\Facades\Auth;

class ElibraryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        //
         $program = Auth::user()->program;
         $files = Elibrary::where('program', $program)->latest()->get();
         $query = Elibrary::query();

    if ($request->has('search') && $request->search !== '') {
        $query->where('program', 'like', '%' . $request->search . '%');
    }

    $files = $query->latest()->get();

    return view('admin.elibrary.index', compact('files'));



    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
       return view('admin.elibrary.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $request->validate([
        'program' => 'required|string|max:255',
        'file'    => 'required|file|mimes:pdf,doc,docx,ppt,pptx,jpg,jpeg,png'
    ]);

    $path = $request->file('file')->store('elibrary', 'public');

    Elibrary::create([
        'program'   => $request->program,
        'file_name' => $request->file('file')->getClientOriginalName(),
        'file_path' => $path,
    ]);

    return redirect()->route('admin.elibrary.index')->with('success','File uploaded successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
         $file = ELibrary::findOrFail($id);
    return view('admin.elibrary.edit', compact('file'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $file = ELibrary::findOrFail($id);

    $request->validate([
        'program' => 'required|string|max:255',
        'file'    => 'required|file|mimes:pdf,doc,docx,ppt,pptx,jpg,jpeg,png'
    ]);

    $data = [
        'program' => $request->program,
    ];

    if ($request->hasFile('file')) {
        // delete old file if needed
        if (\storage_path()::disk('public')->exists($file->file_path)) {
            \storage_path()::disk('public')->delete($file->file_path);
        }

        $path = $request->file('file')->store('e-library', 'public');

        $data['file_name'] = $request->file('file')->getClientOriginalName();
        $data['file_path'] = $path;
    }

    $file->update($data);

    return redirect()->route('admin.elibrary.index')
                     ->with('success','File updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Elibrary $elibrary)
    {
        //
         $elibrary->delete();
        return redirect()->back()->with('success', 'elibrary deleted successfully!');

    }
}
