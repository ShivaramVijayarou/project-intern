<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Staff;
use App\Models\StaffFamily;
use Illuminate\Http\Request;

class StaffController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $staffs = Staff::with('families') // 🔥 IMPORTANT (eager load)
            ->when(request('search'), function ($q) {
                $q->where(function ($query) {
                    $query->where('name', 'like', '%' . request('search') . '%')
                          ->orWhere('ic_no', 'like', '%' . request('search') . '%')
                          ->orWhere('staff_id', 'like', '%' . request('search') . '%');
                });
            })
            ->when(request('department'), function ($q) {
                $q->where('department', request('department'));
            })
            ->when(request('status'), function ($q) {
                $q->where('status', request('status'));
            })
            ->latest()
            ->paginate(10);

        $departments = Staff::select('department')
            ->whereNotNull('department')
            ->distinct()
            ->pluck('department');

        return view('admin.staff.index', compact('staffs', 'departments'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.staff.add');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->only([
            'staff_id',
            'name',
            'email',
            'phone',
            'ic_no',
            'department',
            'level',
            'start_date',
            'status'
        ]);

        // Upload profile image
        if ($request->hasFile('profileimage')) {
            $data['profileimage'] = $request->file('profileimage')->store('staff', 'public');
        }

        $staff = Staff::create($data);

        // Save family members
        // if ($request->has('family')) {
        //     foreach ($request->family as $family) {
        //         $staff->family()->create($family);
        //     }
        // }

//         if ($request->has('family')) {
//     foreach ($request->family as $family) {
//         $staff->families()->create($family);
//     }
// }

if (!empty($request->family)) {
    foreach ($request->family as $family) {

        // Skip completely empty rows
        if (!array_filter($family)) {
            continue;
        }

        $staff->families()->create($family);
    }
}

        return redirect()->route('admin.staff.index')
            ->with('success', 'Staff added successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Staff $staff)
    {
        $staff->load('families'); // 🔥 load family

        return view('admin.staff.view', compact('staff'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Staff $staff)
    {
        $staff->load('families'); // 🔥 load family

        return view('admin.staff.edit', compact('staff'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Staff $staff)
    {
        $data = $request->only([
            'staff_id',
            'name',
            'email',
            'phone',
            'ic_no',
            'department',
            'level',
            'start_date',
            'status'
        ]);

        // Update profile image (optional)
        if ($request->hasFile('profileimage')) {
            $data['profileimage'] = $request->file('profileimage')->store('staff', 'public');
        }

        $staff->update($data);

        // 🔥 Reset and re-insert family data
        // $staff->family()->delete();

        // if ($request->has('families')) {
        //     foreach ($request->family as $family) {
        //         $staff->family()->create($family);
        //     }
        // }


        $staff->families()->delete();

// if ($request->has('family')) {
//     foreach ($request->family as $family) {
//         $staff->families()->create($family);
//     }
// }


if (!empty($request->family)) {
    foreach ($request->family as $family) {

        // Skip completely empty rows
        if (!array_filter($family)) {
            continue;
        }

        $staff->families()->create($family);
    }
}
        return redirect()->route('admin.staff.index')
            ->with('success', 'Staff updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Staff $staff)
    {
        // Optional: delete family first (clean data)
        $staff->families()->delete();

        $staff->delete();

        return redirect()->route('admin.staff.index')
            ->with('success', 'Staff deleted successfully');
    }
}
