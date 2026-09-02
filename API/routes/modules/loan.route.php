<?php

use App\Http\Controllers\Api\Loan\DashboardController;
use Illuminate\Support\Facades\Route;

Route::post("loans-dashboard-daily-result", [DashboardController::class, "dailyResult"]);
Route::post("loans-dashboard-monthly-result", [DashboardController::class, "monthlyResult"]);
Route::post("loans-dashboard-all-loans", [DashboardController::class, "allLoans"]);
Route::post("loans-dashboard-daily-plan-and-collected", [DashboardController::class, "dailyPlanAndCollected"]);
Route::post("loans-dashboard-late-overdue-repayment-status", [DashboardController::class, "lateAndOverdueRepaymentStatus"]);
