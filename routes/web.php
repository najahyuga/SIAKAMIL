<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\EducationLevelsController;
use App\Http\Controllers\TeachersController;
use Illuminate\Support\Facades\Route;


Route::get('/', [AuthController::class, 'dashboard']);
Route::get('/admin', [AuthController::class, 'indexAdmin']);

Route::resource('/educationLevels', EducationLevelsController::class);
Route::resource('/teacher', TeachersController::class);
Route::resource('/semesters', App\Http\Controllers\SemestersController::class);
