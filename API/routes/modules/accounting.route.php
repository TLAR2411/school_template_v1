<?php

use App\Http\Controllers\Api\Accounting\AccountingDashboardController;
use Illuminate\Support\Facades\Route;

Route::post("accounting-dashboard-summary", [AccountingDashboardController::class, 'summary']);
Route::post("accounting-dashboard-income-expense-profit", [AccountingDashboardController::class, 'incomeExpenseProfit']);
