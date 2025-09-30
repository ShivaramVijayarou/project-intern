<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Info;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class InfoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
{
    $search = $request->input('search');

    // start a query
    $query = Info::query();

    // add search condition if any
    if ($search) {
        $query->where('file_name', 'like', '%' . $search . '%');
    }

    // order and paginate
    $files = $query->latest()->paginate(10);

    // pass search back to view so form keeps the value
    return view('admin.info.index', compact('files', 'search'));
}

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
          return view('admin.info.add');
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

        // Store file in storage/app/public/kaunseling
       $path = $request->file('file_path')->store('info', 'public');

        // use provided file_name OR original uploaded file name
    $fileName = $request->file_name
        ?: $request->file('file_path')->getClientOriginalName();

    Info::create([
        'file_name' => $fileName,
        'file_path' => $path,
    ]);

        return redirect()->route('admin.info.index')->with('success', 'File uploaded successfully.');
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
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
         $file = Info::findOrFail($id);

        // Delete file from storage
        if ($file->file_path && Storage::disk('public')->exists($file->file_path)) {
            Storage::disk('public')->delete($file->file_path);
        }

        $file->delete();

        return redirect()->route('admin.info.index')->with('success', 'File deleted successfully.');
    }
}

