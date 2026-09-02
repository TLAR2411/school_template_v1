<?php

namespace App\Http\Controllers\Api\Accounting;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AccountingDashboardController extends Controller
{
    public function summary(Request $request)
    {
        return response()->json([
            'status' => true,
            'data' => [
                'cash_on_hand' => 0,
                'cash_in_bank' => 0,
                'withdraw_deposit' => 0,
                'deposit' => 0,
                'total_income' => 0,
                'total_expense' => 0,
                'total_profit' => 0,
            ],
        ]);
    }

    public function incomeExpenseProfit(Request $request)
    {
        return response()->json([
            'status' => true,
            'data' => [
                'income' => [],
                'expense' => [],
                'profit' => [],
                'labels' => [],
            ],
        ]);
    }
}
