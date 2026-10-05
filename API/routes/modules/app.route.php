<?php

use App\Http\Controllers\Api\App\AcademicController;
use App\Http\Controllers\Api\App\AttendanceController;
use App\Http\Controllers\Api\App\FcmController;
use App\Http\Controllers\Api\App\GeneralInfoController;
use App\Http\Controllers\Api\App\LoginAppController;
use App\Http\Controllers\Api\App\ListClassController;
use App\Http\Controllers\Api\App\PermissionController;
use App\Http\Controllers\Api\App\StudentController;
use App\Http\Controllers\Api\App\TelegramController;
use App\Http\Controllers\Api\App\TelegramConnectionController;
use App\Http\Controllers\Api\App\UserDeviceTokenController;
use Illuminate\Support\Facades\Route;

Route::post('login', [LoginAppController::class, 'login']);

// Public — WebView report page (validated by access code)
Route::post('report-student-individual', [GeneralInfoController::class, 'showReport']);
Route::get('permission-request/{id}', [PermissionController::class, 'viewrequest']);
Route::post('permission-request/{id}/{type}', [PermissionController::class, 'updaterequest']);
Route::post('notifications/permission', [FcmController::class, 'sendNotification']);
Route::post('notifications/attendance', [FcmController::class, 'sendNotiToAtt']);
Route::post('telegram/webhook', [TelegramController::class, 'webhook']);
Route::post('telegram-connection/webhook', [TelegramConnectionController::class, 'webhook']);
Route::group(['middleware' => ['auth:api']], function () {
    Route::get('months-list', [AttendanceController::class, 'getMonths']);
    Route::post('attendance', [AttendanceController::class, 'getAttendance']);
    Route::get('telegram-connection/link', [TelegramConnectionController::class, 'getTelegramConnectLink']);
    Route::get('telegram-connection/status', [TelegramConnectionController::class, 'checkConnectTelegram']);
    Route::post('telegram-connection/send-message', [TelegramConnectionController::class, 'sendMessageToChat'])
        ->middleware('permission:view-teachers');
    Route::post('telegram-connection/disconnect', [TelegramConnectionController::class, 'disConnectBot']);
    Route::post('telegram-connection/unlink-group', [TelegramConnectionController::class, 'unlinkTelegramGroup']);
    Route::post('logout', [LoginAppController::class, 'logout']);
    Route::post('telegram/permission-request', [TelegramController::class, 'sendPermissionRequest']);
    Route::post('device-token', [UserDeviceTokenController::class, 'saveDeviceToken']);
    Route::get('permissions', [PermissionController::class, 'sendPermission']);
    Route::post('permission-request', [PermissionController::class, 'requestpermission']);
    Route::get('students-list', [StudentController::class, 'list']);
    Route::get('classes-list', [StudentController::class, 'studentClass']);
    Route::get('curriculums-list', [GeneralInfoController::class, 'curriculum_list']);
    Route::get('years-list', [GeneralInfoController::class, 'year_list']);
    Route::post('report-code', [GeneralInfoController::class, 'getCode']);

    Route::get('family-classes-list', [ListClassController::class, 'list']);
    Route::get('academic-years', [AcademicController::class, 'years']);
    Route::get('curriculums', [AcademicController::class, 'curriculums']);
});
