<?php

use App\Http\Controllers\Api\Hr\DashboardController;
use Illuminate\Support\Facades\Route;

Route::post("hr-dashboards", [DashboardController::class, "index"]);
