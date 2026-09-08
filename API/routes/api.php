<?php

use App\Http\Controllers\Api\Auth\AuthController;
use App\Http\Controllers\Api\CacheController;
use App\Http\Controllers\ExportController;
use App\Http\Controllers\ImageController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => '/web'], function () {

    Route::post('login', [AuthController::class, "login"]);
    Route::post("refresh", [AuthController::class, "refresh"]);
    Route::get('/img', [ImageController::class, 'resize']);

    Route::group(['middleware' => ['auth:api']], function () {
        Route::get('bootstrap', [AuthController::class, "bootstrap"]);
        Route::post("change-user", [AuthController::class, "changeUser"]);
        Route::post("logout", [AuthController::class, "logout"]);

        Route::post("export-excel", [ExportController::class, "exportExcel"]);
        Route::post("cache-clear", [CacheController::class, "clear"]);

        include 'modules/accounting.route.php';
        include 'modules/address.route.php';
        include 'modules/admin.route.php';
        include 'modules/loan.route.php';
        include 'modules/hr.route.php';
        include 'modules/school.route.php';
    });
});
