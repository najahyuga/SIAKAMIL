<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ClassroomsController;
use App\Http\Controllers\CoursesController;
use App\Http\Controllers\EducationLevelsController;
use App\Http\Controllers\MasterCategoryCoursesController;
use App\Http\Controllers\MasterCoursesController;
use App\Http\Controllers\pendaftaranController;
use App\Http\Controllers\PresenceController;
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
    Route::get('/presences', [PresenceController::class, 'index'])->name('presences.index');
    Route::get('/presences/create', [PresenceController::class, 'create'])->name('presences.create');
    Route::post('/presences', [PresenceController::class, 'store'])->name('presences.store');
    Route::get('/presences/{id}', [PresenceController::class, 'show'])->name('presences.show');
    Route::get('/presences/{id}/showSubmit', [PresenceController::class, 'showSubmit'])->name('presences.showSubmit');
    Route::post('/presences/{id}/submit', [PresenceController::class, 'submit'])->name('presences.submit');
    // Rute untuk mendapatkan data classrooms berdasarkan course
    Route::get('courses/{course_id}/classrooms', [TasksController::class, 'getClassroomsByCourse']);
    // Rute untuk mendapatkan data master courses berdasarkan course
    Route::get('courses/{course_id}/master-courses', [TasksController::class, 'getMasterCoursesByCourse']);

    // Rute untuk pemilihan classroom oleh siswa dan penyimpanan history
    Route::get('/select-classroom', [ClassroomsController::class, 'showSelectClassroomForm'])->name('classroom.form');
    // Route::post('/select-classroom', [ClassroomsController::class, 'selectClassroom'])->name('classroom.select');
    Route::get('/classrooms/{classroom_id}/students', [ClassroomsController::class, 'getStudentsByClassroom'])->name('classrooms.students');
    Route::post('/students/updateHistory', [StudentsController::class, 'updateStudents'])->name('students.updateHistory');
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
    Route::get('/presences', [PresenceController::class, 'index'])->name('presences.index');
    Route::get('/presences/create', [PresenceController::class, 'create'])->name('presences.create');
    Route::post('/presences', [PresenceController::class, 'store'])->name('presences.store');
    Route::get('/presences/{id}', [PresenceController::class, 'show'])->name('presences.show');
    Route::get('/presences/{id}/showSubmit', [PresenceController::class, 'showSubmit'])->name('presences.showSubmit');
    Route::post('/presences/{id}/submit', [PresenceController::class, 'submit'])->name('presences.submit');
});

// Rute untuk siswa
Route::prefix('siswa')->name('siswa.')->middleware('auth', 'UsersAkses:siswa')->group(function () {
    Route::get('/', [AuthController::class, 'indexSiswa']);
    Route::resource('tasks', TasksController::class);
    Route::resource('taskDetails', TasksDetailsController::class);
    Route::get('tasks/{task}/detail', [TasksController::class, 'detail'])->name('tasks.detail');
    Route::get('taskDetails/{studentsId}/{taskId}', [TasksDetailsController::class, 'index'])->name('taskDetails.index');
});

// Rute untuk calon siswa
Route::prefix('calonSiswa')->name('calonSiswa.')->middleware('auth', 'UsersAkses:calonSiswa')->group(function (){
    Route::get('/', [AuthController::class, 'indexCalonSiswa']);
    // Route::resource('pendaftaran/paketA', pendaftaranController::class);
    Route::get('pendaftaran', [pendaftaranController::class, 'index'])->name('pendaftaran.index');
    Route::get('pendaftaran/create/{education_level}', [pendaftaranController::class, 'create'])->name('pendaftaran.create');
    Route::post('pendaftaran/store', [pendaftaranController::class, 'store'])->name('pendaftaran.store');
});
