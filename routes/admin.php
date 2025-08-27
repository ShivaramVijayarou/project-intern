<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\StudentController;
use App\Http\Controllers\Admin\NoteController;
use App\Http\Controllers\Admin\ExamController;

Route::middleware(['auth', 'role:admin'])->prefix('admin') ->as('admin.')->group(function () {


        Route::get('dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');
        Route::get('student', [StudentController::class, 'index'])->name('student');

        // Profile
        Route::get('profile', [ProfileController::class, 'index'])->name('profile');
        Route::put('profile', [ProfileController::class, 'updateProfile'])->name('profile.update');
        Route::put('profile/password', [ProfileController::class, 'updatePassword'])->name('profile.password.update');

        //Notes
        Route::get('note', [NoteController::class, 'index'])->name('note');


        //Examination
        Route::get('/examination', [ExamController::class, 'index'])->name('examination.index');




    Route::get('/exams/create', [ExamController::class, 'create'])->name('examination.create');
    Route::post('/exams', [ExamController::class, 'store'])->name('examination.store');
    Route::get('/exams/{exam}', [ExamController::class, 'show'])->name('examination.show');
    Route::get('/exams/{exam}/edit', [ExamController::class, 'edit'])->name('examination.edit');
    Route::put('/exams/{exam}', [ExamController::class, 'update'])->name('examination.update');
    Route::delete('/exams/{exam}', [ExamController::class, 'destroy'])->name('examination.destroy');






    });
