<?php

use App\Http\Controllers\Api\App\AcademicController;
use App\Http\Controllers\Api\App\GeneralInfoController;
use App\Http\Controllers\Api\App\LoginAppController;
use App\Http\Controllers\Api\App\ListClassController;
use App\Http\Controllers\Api\App\StudentController;
use Illuminate\Support\Facades\Route;

Route::post('login', [LoginAppController::class, 'login']);

// Public — WebView report page (validated by access code)
Route::post('report-student-individual', [GeneralInfoController::class, 'showReport']);

Route::group(['middleware' => ['auth:api']], function () {
    Route::get('students-list', [StudentController::class, 'list']);
    Route::get('classes-list', [StudentController::class, 'studentClass']);
    Route::get('curriculums-list', [GeneralInfoController::class, 'curriculum_list']);
    Route::get('years-list', [GeneralInfoController::class, 'year_list']);
    Route::post('report-code', [GeneralInfoController::class, 'getCode']);

    Route::get('family-classes-list', [ListClassController::class, 'list']);
    Route::get('academic-years', [AcademicController::class, 'years']);
    Route::get('curriculums', [AcademicController::class, 'curriculums']);
});
