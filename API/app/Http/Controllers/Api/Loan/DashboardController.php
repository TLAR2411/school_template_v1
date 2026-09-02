<?php

namespace App\Http\Controllers\Api\Loan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function dailyResult(Request $request)
    {
        return $this->stub([
            'total_disburse' => 0,
            'total_receive' => 0,
            'last_total_disburse' => 0,
            'last_total_receive' => 0,
            'next_total_disburse' => 0,
            'next_total_receive' => 0,
            'total_penalty' => 0,
            'last_total_penalty' => 0,
            'next_total_penalty' => 0,
            'total_prepaid' => 0,
            'last_total_prepaid' => 0,
            'next_total_prepaid' => 0,
        ]);
    }

    public function monthlyResult(Request $request)
    {
        return $this->stub([
            'disburse' => [],
            'receive' => [],
            'labels' => [],
        ]);
    }

    public function allLoans(Request $request)
    {
        return $this->stub([
            'total_loans' => 0,
            'total_active_loans' => 0,
            'total_closed_loans' => 0,
            'total_overdue_loans' => 0,
            'total_late_loans' => 0,
        ]);
    }

    public function dailyPlanAndCollected(Request $request)
    {
        return $this->stub([
            'plan' => [],
            'collected' => [],
            'labels' => [],
        ]);
    }

    public function lateAndOverdueRepaymentStatus(Request $request)
    {
        return $this->stub([
            'late' => [],
            'overdue' => [],
            'labels' => [],
        ]);
    }

    private function stub(array $data)
    {
        return response()->json([
            'status' => true,
            'data' => $data,
        ]);
    }
}
