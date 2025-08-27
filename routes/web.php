<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\ExamController;
use App\Http\Controllers\Admin\NoteController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\StudentController;
use App\Http\Controllers\Staff\StaffDashboardController;
use App\Http\Controllers\Student\StudentDashboardController;
use App\Http\Controllers\Student\StudentProfileController;
use App\Http\Controllers\Student\StudentExamController;
use App\Http\Controllers\Student\StudentNotesController;

/*
|--------------------------------------------------------------------------
| Default Redirect
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return redirect()->route('dashboard');
});

/*
|--------------------------------------------------------------------------
| Dashboard (for all authenticated users)
|--------------------------------------------------------------------------
*/
Route::get('/dashboard', function () {
    return view('student.dashboard.index');
})->middleware(['auth', 'verified'])->name('dashboard');

/*
|--------------------------------------------------------------------------
| User Profile (for all authenticated users)
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile/update', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile/delete', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('admin/dashboard', [AdminDashboardController::class, 'index'])->name('admin.dashboard');

    // Student Management
    Route::get('student', [StudentController::class, 'index'])->name('admin.student');
    Route::get('/student/create', [StudentController::class, 'create'])->name('students.create');
    Route::post('/student/store', [StudentController::class, 'store'])->name('students.store');
    Route::delete('/students/{id}', [StudentController::class, 'destroy'])->name('students.destroy');
    Route::get('/admin/students/{id}/edit', [StudentController::class, 'edit'])->name('admin.students.edit');
    Route::put('/admin/students/{id}', [StudentController::class, 'update'])->name('admin.students.update');

    // Admin profile
    Route::get('admin/profile', [ProfileController::class, 'index'])->name('admin.profile');
    Route::put('admin/profile', [ProfileController::class, 'updateProfile'])->name('admin.profile.update');
    Route::put('admin/profile/password', [ProfileController::class, 'updatePassword'])->name('admin.profile.password.update');

    // Notes & Students Resource Controllers
    Route::prefix('admin')->name('admin.')->group(function () {
        Route::resource('students', StudentController::class);
        Route::resource('notes', NoteController::class);
        Route::resource('exams', ExamController::class);
    });
});

/*
|--------------------------------------------------------------------------
| Staff Routes
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'role:staff'])->group(function () {
    Route::get('staff/dashboard', [StaffDashboardController::class, 'index'])
        ->name('staff.dashboard');
});

/*
|--------------------------------------------------------------------------
| Student Routes
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'role:user'])->group(function () {
    Route::get('student/dashboard', [StudentDashboardController::class, 'index'])->name('student.dashboard');
    Route::get('student/profile', [StudentProfileController::class, 'index'])->name('student.profile');
    Route::get('student/notes', [StudentNotesController::class, 'index'])->name('student.notes');
   Route::get('/student/exams', [StudentExamController::class, 'index'])->name('student.exams');


    // Student Notes (filtered by program)
    // Route::get('student/notes', function () {
        // $user = auth()->user(); // logged-in student
        // $notes = \App\Models\Note::where('program', $user->program)
        //     ->latest()
        //     ->get();

        // return view('student.notes.index', compact('notes'));
    // })->name('student.notes');

        
});
