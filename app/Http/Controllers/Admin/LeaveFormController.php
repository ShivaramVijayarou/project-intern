<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\LeaveForm;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class LeaveFormController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        //
        $search = $request->input('search');

    // start a query
    $query = LeaveForm::query();

    // add search condition if any
    if ($search) {
        $query->where('file_name', 'like', '%' . $search . '%');
    }

    // order and paginate
    $files = $query->latest()->paginate(10);

    // pass search back to view so form keeps the value
    return view('admin.leaveform.index', compact('files', 'search'));
   }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
          return view('admin.leaveform.add');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
         $request->validate([
            'file_name' => 'nullable|string|max:255',
            'file_path' => 'required|file|mimes:pdf,doc,docx,jpg,jpeg,png|max:40000', // 5MB max
        ]);

        // Store file in storage/app/public/leaveform
       $path = $request->file('file_path')->store('leaveform', 'public');

        // use provided file_name OR original uploaded file name
    $fileName = $request->file_name
        ?: $request->file('file_path')->getClientOriginalName();

    LeaveForm::create([
        'file_name' => $fileName,
        'file_path' => $path,
    ]);

        return redirect()->route('admin.leaveform.index')->with('success', 'File uploaded successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(LeaveForm $leaveForm)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(LeaveForm $leaveForm)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, LeaveForm $leaveForm)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $file = LeaveForm::findOrFail($id);

        // Delete file from storage
        if ($file->file_path && Storage::disk('public')->exists($file->file_path)) {
            Storage::disk('public')->delete($file->file_path);
        }

        $file->delete();

        return redirect()->route('admin.leaveform.index')->with('success', 'File deleted successfully.');
    }
}
