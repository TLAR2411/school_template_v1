<?php

use App\Http\Controllers\Api\Address\CommuneController;
use App\Http\Controllers\Api\Address\DistrictController;
use App\Http\Controllers\Api\Address\ProvinceController;
use App\Http\Controllers\Api\Address\VillageController;
use Illuminate\Support\Facades\Route;

Route::post("provinces-all", [ProvinceController::class, "all"]);
Route::post("provinces-show", [ProvinceController::class, "show"]);
Route::post("provinces-list", [ProvinceController::class, "list"])->middleware(['auth:api', 'permission:view-provinces']);
Route::post("provinces-store", [ProvinceController::class, "store"])->middleware(['auth:api', 'permission:add-provinces']);
Route::post("provinces-update", [ProvinceController::class, "update"])->middleware(['auth:api', 'permission:edit-provinces']);
Route::post("provinces-delete", [ProvinceController::class, "delete"])->middleware(['auth:api', 'permission:delete-provinces']);
Route::post("provinces-disable", [ProvinceController::class, "disable"]);

Route::post("districts-all", [DistrictController::class, "all"]);
Route::post("districts-show", [DistrictController::class, "show"]);
Route::post("districts-list", [DistrictController::class, "list"])->middleware(['auth:api', 'permission:view-districts']);
Route::post("districts-store", [DistrictController::class, "store"])->middleware(['auth:api', 'permission:add-districts']);
Route::post("districts-update", [DistrictController::class, "update"])->middleware(['auth:api', 'permission:edit-districts']);
Route::post("districts-delete", [DistrictController::class, "delete"])->middleware(['auth:api', 'permission:password-districts']);
Route::post("districts-disable", [DistrictController::class, "disable"]);

Route::post("communes-all", [CommuneController::class, "all"]);
Route::post("communes-show", [CommuneController::class, "show"]);
Route::post("communes-list", [CommuneController::class, "list"])->middleware(['auth:api', 'permission:view-communes']);
Route::post("communes-store", [CommuneController::class, "store"])->middleware(['auth:api', 'permission:add-communes']);
Route::post("communes-update", [CommuneController::class, "update"])->middleware(['auth:api', 'permission:edit-communes']);
Route::post("communes-delete", [CommuneController::class, "delete"])->middleware(['auth:api', 'permission:delete-communes']);
Route::post("communes-disable", [CommuneController::class, "disable"]);

Route::post("villages-all", [VillageController::class, "all"]);
Route::post("villages-show", [VillageController::class, "show"]);
Route::post("villages-list", [VillageController::class, "list"])->middleware(['auth:api', 'permission:view-villages']);
Route::post("villages-store", [VillageController::class, "store"])->middleware(['auth:api', 'permission:add-villages']);
Route::post("villages-update", [VillageController::class, "update"])->middleware(['auth:api', 'permission:edit-villages']);
Route::post("villages-delete", [VillageController::class, "delete"])->middleware(['auth:api', 'permission:delete-villages']);
Route::post("villages-disable", [VillageController::class, "disable"]);