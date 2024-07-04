<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryCoursesController;
use App\Http\Controllers\ClassroomsController;
use App\Http\Controllers\CoursesController;
use App\Http\Controllers\EducationLevelsController;
use App\Http\Controllers\MasterCategoryCoursesController;
use App\Http\Controllers\MasterCoursesController;
use App\Http\Controllers\SemestersController;
use App\Http\Controllers\StudentsController;
use App\Http\Controllers\TasksController;
use App\Http\Controllers\TasksDetailsController;
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

// Rute untuk logout
Route::get('logout', [AuthController::class, 'logout'])->name('logout');

// Rute untuk switch role
Route::post('/switch-role', [AuthController::class, 'switchRole'])->name('switch-role')->middleware('auth');
// Route::get('/switch-role', [AuthController::class, 'switchRole'])->name('switch-role')->middleware('auth');

// Rute untuk admin
Route::prefix('admin')->name('admin.')->middleware('auth', 'UsersAkses:admin')->group(function () {
    Route::get('/', [AuthController::class, 'indexAdmin']);
    Route::resource('/educationLevels', EducationLevelsController::class);
    Route::resource('/teacher', TeachersController::class);
    Route::resource('/semesters', SemestersController::class);
    Route::resource('/classrooms', ClassroomsController::class);
    Route::resource('/students', StudentsController::class);
    Route::resource('/users', UsersController::class);
    Route::resource('/masterCategoryCourses', MasterCategoryCoursesController::class);
    Route::resource('/masterCourses', MasterCoursesController::class);
    Route::resource('/courses', CoursesController::class);
    Route::resource('tasks', TasksController::class);
    Route::get('tasks/{task}/detail', [TasksController::class, 'detail'])->name('tasks.detail');
    Route::get('/classrooms/{id}/courses', [StudentsController::class, 'getCoursesByClassroom']);
    Route::post('/ckeditor/upload', [TasksController::class, 'upload'])->name('ckeditor.upload');
    Route::resource('taskDetails', TasksDetailsController::class);
    Route::get('taskDetails/{studentsId}/{taskId}', [TasksDetailsController::class, 'index'])->name('taskDetails.index');
});

// Rute untuk guru
Route::prefix('guru')->name('guru.')->middleware('auth', 'UsersAkses:guru')->group(function () {
    Route::get('/', [AuthController::class, 'indexGuru']);
    Route::resource('tasks', TasksController::class);
    Route::resource('students', StudentsController::class);
    Route::resource('taskDetails', TasksDetailsController::class);
    Route::get('/classrooms/{id}/courses', [StudentsController::class, 'getCoursesByClassroom']);
    Route::post('/ckeditor/upload', [TasksController::class, 'upload'])->name('ckeditor.upload');
    Route::get('tasks/{task}/detail', [TasksController::class, 'detail'])->name('tasks.detail');
    Route::get('taskDetails/{studentsId}/{taskId}', [TasksDetailsController::class, 'index'])->name('taskDetails.index');
});

// Rute untuk siswa
Route::prefix('siswa')->name('siswa.')->middleware('auth', 'UsersAkses:siswa')->group(function () {
    Route::get('/', [AuthController::class, 'indexSiswa']);
    Route::resource('tasks', TasksController::class);
    Route::get('tasks/{task}/detail', [TasksController::class, 'detail'])->name('tasks.detail');
});
