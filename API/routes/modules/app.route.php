<?php

use App\Http\Controllers\Api\App\LoginAppController;
use App\Http\Controllers\Api\App\StudentController;
use Illuminate\Support\Facades\Route;

Route::post('login', [LoginAppController::class, 'login']);

Route::group(['middleware' => ['auth:api']], function () {
    Route::post('students-list', [StudentController::class, 'list']);
});
