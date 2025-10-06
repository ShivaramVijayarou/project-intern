<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\ExamController;
use App\Http\Controllers\Admin\NoteController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\StudentController;
use App\Http\Controllers\Admin\ElibraryController;
use App\Http\Controllers\Admin\KaunselingController;
use App\Http\Controllers\Admin\InfoController;
use App\Http\Controllers\Admin\ResultController;
use App\Http\Controllers\Admin\AttendanceController;
use App\Http\Controllers\Staff\StaffDashboardController;
use App\Http\Controllers\Student\StudentDashboardController;
use App\Http\Controllers\Student\StudentProfileController;
use App\Http\Controllers\Student\StudentExamController;
use App\Http\Controllers\Student\StudentNotesController;
use App\Http\Controllers\Student\StudentELibraryController;
use App\Http\Controllers\Student\StudentKaunselingController;
use App\Http\Controllers\Student\StudentInfoController;
use App\Http\Controllers\Student\StudentResultController;
use App\Http\Controllers\Auth\PasswordResetLinkController;
use App\Http\Controllers\Auth\NewPasswordController;


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
Route::get('/dashboard', [StudentDashboardController::class, 'index'])
    ->middleware(['auth', 'verified', 'role:user'])
    ->name('dashboard');

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


Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');
    Route::resource('students', StudentController::class);
    Route::resource('notes', NoteController::class);
    Route::resource('exams', ExamController::class);
    Route::resource('elibrary', ElibraryController::class);
    Route::resource('kaunseling', KaunselingController::class);
    Route::resource('info', InfoController::class);
    Route::resource('result', ResultController::class);
    Route::resource('attendance', AttendanceController::class);


});





    // Notes & Students Resource Controllers
    Route::prefix('admin')->name('admin.')->group(function () {
        Route::resource('students', StudentController::class);
        Route::resource('notes', NoteController::class);
        Route::resource('exams', ExamController::class);
        Route::resource('Elibrary', ElibraryController::class);
         Route::resource('kaunseling', KaunselingController::class);
         Route::resource('info', InfoController::class);
         Route::resource('result', ResultController::class);
        Route::resource('attendance', AttendanceController::class);
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
    // Route::get('/student/dashboard', [StudentDashboardController::class, 'index'])->name('student.dashboard');
    Route::get('student/profile', [StudentProfileController::class, 'index'])->name('student.profile');
    Route::put('/student/profile/password', [StudentProfileController::class, 'updatePassword'])->name('student.profile.password.update');
    Route::get('student/notes', [StudentNotesController::class, 'index'])->name('student.notes');
   Route::get('/student/exams', [StudentExamController::class, 'index'])->name('student.exams');
   Route::get('/student/elibrary', [StudentELibraryController::class, 'index'])->name('student.elibrary');
   Route::get('/student/kaunseling', [StudentKaunselingController::class, 'index'])->name('student.kaunseling');
    Route::get('/student/info', [StudentInfoController::class, 'index'])->name('student.info');
    Route::get('/student/result', [StudentResultController::class, 'index'])->name('student.result');

});



// forgot password
Route::get('/forgot-password', [PasswordResetLinkController::class, 'create'])->name('password.request');

Route::post('/forgot-password', [PasswordResetLinkController::class, 'store'])->name('password.email');

Route::get('/reset-password/{token}', [NewPasswordController::class, 'create'])->name('password.reset');

Route::post('/reset-password', [NewPasswordController::class, 'store'])->name('password.store');

