<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Note;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Storage;

class NoteController extends Controller
{
    //

    //  function index(): View
    // {
    //     return view('admin.notes.index');
    // }

    public function index()
    {
        $notes = Note::latest()->paginate(10); // use paginate if your Blade calls ->links()
        return view('admin.notes.index', compact('notes'));
    }


    public function create()
    {
        return view('admin.notes.create');
    }



public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'file' => 'required|mimes:pdf,doc,docx,ppt,pptx,txt|max:2048',
            'program' => 'required|string',
        ]);

        $filePath = $request->file('file')->store('notes', 'public');

        Note::create([
            'title' => $request->title,
            'description' => $request->description,
            'file' => $filePath,
             'program' => $request->program,
            'uploaded_by' => Auth::id(),
        ]);

        return redirect()->route('admin.notes.index')->with('success', 'Note uploaded successfully!');
    }


public function update(Request $request, $id)
    {
        $note = Note::findOrFail($id);

        // Validation
        $validated = $request->validate([
            'title'       => 'required|string|max:255',
            'description' => 'nullable|string',
            'program'     => 'required|string',
            'file'        => 'nullable|mimes:pdf,doc,docx,ppt,pptx,txt|max:2048',
        ]);

        // If new file uploaded, replace the old one
        if ($request->hasFile('file')) {
            // delete old file if exists
            if ($note->file && Storage::disk('public')->exists($note->file)) {
    Storage::disk('public')->delete($note->file);
}

            // store new file
            $validated['file'] = $request->file('file')->store('notes', 'public');
        } else {
            // keep old file
            $validated['file'] = $note->file;
        }

        // update record
        $note->update($validated);

        return redirect()->route('admin.notes.index')->with('success', 'Note updated successfully.');
    }

public function edit($id)
{
    $note = Note::findOrFail($id);
    return view('admin.notes.edit', compact('note'));
}




    public function destroy(Note $note)
{
    if ($note->file && Storage::disk('public')->exists($note->file)) {
        Storage::disk('public')->delete($note->file);
    }

    $note->delete();
    return redirect()->back()->with('success', 'Note deleted successfully!');
}
}
