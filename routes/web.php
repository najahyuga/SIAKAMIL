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


Route::get('/', [AuthController::class, 'dashboard']);
Route::get('/admin', [AuthController::class, 'indexAdmin']);

Route::resource('/educationLevels', EducationLevelsController::class);
Route::resource('/teacher', TeachersController::class);
Route::resource('/semesters', App\Http\Controllers\SemestersController::class);
Route::resource('/classrooms', App\Http\Controllers\ClassroomsController::class);
Route::resource('/students', StudentsController::class);
Route::resource('/users', UsersController::class);
Route::resource('/categoryCourses', CategoryCoursesController::class);
Route::resource('/courses', CoursesController::class);
Route::resource('/tasks', TasksController::class);
