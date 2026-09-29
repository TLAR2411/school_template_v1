<?php

use App\Http\Controllers\Api\App\AcademicController;
use App\Http\Controllers\Api\App\LoginAppController;
use App\Http\Controllers\Api\App\ListClassController;
use App\Http\Controllers\Api\App\StudentController;
use Illuminate\Support\Facades\Route;

Route::post('login', [LoginAppController::class, 'login']);

Route::group(['middleware' => ['auth:api']], function () {
    Route::post('students-list', [StudentController::class, 'list']);
    Route::get('classes-list', [ListClassController::class, 'list']);
    Route::get('academic-years', [AcademicController::class, 'years']);
    Route::get('curriculums', [AcademicController::class, 'curriculums']);
});
