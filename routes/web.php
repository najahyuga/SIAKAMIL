<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryCoursesController;
use App\Http\Controllers\CoursesController;
use App\Http\Controllers\EducationLevelsController;
use App\Http\Controllers\StudentsController;
use App\Http\Controllers\TasksController;
use App\Http\Controllers\TeachersController;
use App\Http\Controllers\UsersController;
use Illuminate\Support\Facades\Route;

// akses tanpa harus login
Route::get('/', [AuthController::class, 'dashboard']);
Route::middleware(['guest'])->group(function () {
    Route::get('/login', [AuthController::class, 'indexLogin']);
    Route::post('/login', [AuthController::class, 'login'])->name('login');
    Route::get('/register',[AuthController::class, 'indexRegister']);
    Route::post('/storeRegister',[AuthController::class, 'storeRegister'])->name('storeRegister');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/admin', [AuthController::class, 'indexAdmin'])->middleware('UsersAkses:admin'); // pembatasan hak akses hanya untuk admin
    Route::get('logout', [AuthController::class, 'logout'])->name('logout');

    Route::resource('/educationLevels', EducationLevelsController::class);
    Route::resource('/teacher', TeachersController::class);
    Route::resource('/semesters', App\Http\Controllers\SemestersController::class);
    Route::resource('/classrooms', App\Http\Controllers\ClassroomsController::class);
    Route::resource('/students', StudentsController::class);
    Route::resource('/users', UsersController::class);
    Route::resource('/categoryCourses', CategoryCoursesController::class);
    Route::resource('/courses', CoursesController::class);
});

// Rute untuk guru
Route::prefix('guru')->name('guru.')->middleware('UsersAkses:guru')->group(function () {
    Route::get('/', [AuthController::class, 'indexGuru']);
    Route::resource('tasks', TasksController::class);
    Route::resource('students', StudentsController::class);
});
