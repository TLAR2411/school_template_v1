<?php


use App\Http\Controllers\Api\ActivityLogController;
use App\Http\Controllers\Api\Admin\PermissionController;
use App\Http\Controllers\Api\Admin\PositionController;
use App\Http\Controllers\Api\Admin\RoleController;
use App\Http\Controllers\Api\AdminDashboardController;
use App\Http\Controllers\Api\BranchController;
use App\Http\Controllers\Api\CurrencyController;
use App\Http\Controllers\Api\ReportTemplateController;
use App\Http\Controllers\Api\UserController;
use Illuminate\Support\Facades\Route;

Route::post("admin-dashboards", [AdminDashboardController::class, "index"]);

Route::post("activity-log-list", [ActivityLogController::class, "list"])->middleware(['auth:api', 'permission:view-activity-log']);
Route::post("activity-log-delete-by-date", [ActivityLogController::class, "deleteByDate"])->middleware(['auth:api', 'permission:view-activity-log']);

Route::post("users-get-co", [UserController::class, "getCo"]);
Route::post("users-get-approver", [UserController::class, "getApprover"]);
Route::post("users-all", [UserController::class, "all"]);
Route::post("users-all-under-users", [UserController::class, "allUnderUsers"]);
Route::post("users-show", [UserController::class, "show"]);
Route::post("users-list", [UserController::class, "list"])->middleware(['auth:api', 'permission:view-users']);
Route::post("users-store", [UserController::class, "store"])->middleware(['auth:api', 'permission:add-users']);
Route::post("users-update", [UserController::class, "update"])->middleware(['auth:api', 'permission:edit-users']);
Route::post("users-delete", [UserController::class, "delete"])->middleware(['auth:api', 'permission:delete-users']);
Route::post("users-disable", [UserController::class, "disable"])->middleware(['auth:api', 'permission:change-active-users']);
Route::post("users-password", [UserController::class, "password"]);
Route::post("users-permission", [UserController::class, "permission"]);
Route::post("users-change-password", [UserController::class, "changePassword"]);
Route::post("users-change-username-email", [UserController::class, "changeUsernameEmail"]);
Route::post("users-change-image-path", [UserController::class, "changeImagePath"]);
Route::post("users-link-user", [UserController::class, "linkUser"]);

Route::post("branches-all", [BranchController::class, "all"]);
Route::post("branches-show", [BranchController::class, "show"]);
Route::post("branches-list", [BranchController::class, "list"])->middleware(['auth:api', 'permission:view-branches']);
Route::post("branches-store", [BranchController::class, "store"])->middleware(['auth:api', 'permission:add-branches']);
Route::post("branches-update", [BranchController::class, "update"])->middleware(['auth:api', 'permission:edit-branches']);
Route::post("branches-delete", [BranchController::class, "delete"])->middleware(['auth:api', 'permission:delete-branches']);
Route::post("branches-disable", [BranchController::class, "disable"]);

Route::post("currencies-all", [CurrencyController::class, "all"]);
Route::post("currencies-show", [CurrencyController::class, "show"]);
Route::post("currencies-default", [CurrencyController::class, "setDefault"]);

Route::post("roles-all", [RoleController::class, "all"]);
Route::post("roles-show", [RoleController::class, "show"]);
Route::post("roles-list", [RoleController::class, "list"])->middleware(['auth:api', 'permission:view-roles']);
Route::post("roles-store", [RoleController::class, "store"])->middleware(['auth:api', 'permission:add-roles']);
Route::post("roles-update", [RoleController::class, "update"])->middleware(['auth:api', 'permission:edit-roles']);
Route::post("roles-delete", [RoleController::class, "delete"])->middleware(['auth:api', 'permission:delete-roles']);

Route::post("positions-all", [PositionController::class, "all"]);
Route::post("positions-show", [PositionController::class, "show"]);
Route::post("positions-list", [PositionController::class, "list"])->middleware(['auth:api', 'permission:view-positions']);
Route::post("positions-store", [PositionController::class, "store"])->middleware(['auth:api', 'permission:add-positions']);
Route::post("positions-update", [PositionController::class, "update"])->middleware(['auth:api', 'permission:edit-positions']);
Route::post("positions-delete", [PositionController::class, "delete"])->middleware(['auth:api', 'permission:delete-positions']);

Route::post("permissions-all", [PermissionController::class, "all"]);
Route::post("permissions-show", [PermissionController::class, "show"])->middleware(['auth:api', 'permission:view-permissions']);
Route::post("permissions-list", [PermissionController::class, "list"])->middleware(['auth:api', 'permission:view-permissions']);
Route::post("permissions-store", [PermissionController::class, "store"])->middleware(['auth:api', 'permission:add-permissions']);
Route::post("permissions-update", [PermissionController::class, "update"])->middleware(['auth:api', 'permission:edit-permissions']);
Route::post("permissions-delete", [PermissionController::class, "delete"])->middleware(['auth:api', 'permission:delete-permissions']);

Route::post("report-templates-show", [ReportTemplateController::class, "show"]);
Route::post("report-templates-save", [ReportTemplateController::class, "save"]);
