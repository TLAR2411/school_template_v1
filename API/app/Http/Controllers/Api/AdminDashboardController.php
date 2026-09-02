<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Core\Branch;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminDashboardController extends Controller
{
    public function index(Request $request)
    {
        try {
            $userCounts = User::query()
                ->select([
                    DB::raw('COUNT(id) as total'),
                    DB::raw('SUM(CASE WHEN is_active = true THEN 1 ELSE 0 END) as total_active'),
                    DB::raw('SUM(CASE WHEN is_active = false THEN 1 ELSE 0 END) as total_inactive'),
                ])
                ->first();

            $branchCounts = Branch::query()
                ->select([
                    DB::raw('COUNT(id) as total'),
                    DB::raw('SUM(CASE WHEN is_active = true THEN 1 ELSE 0 END) as total_active'),
                    DB::raw('SUM(CASE WHEN is_active = false THEN 1 ELSE 0 END) as total_inactive'),
                ])
                ->first();

            return response()->json([
                'status' => true,
                'data' => [
                    'total_users' => (float) $userCounts->total,
                    'total_users_active' => (float) $userCounts->total_active,
                    'total_users_inactive' => (float) $userCounts->total_inactive,
                    'total_branches' => (float) $branchCounts->total,
                    'total_branches_active' => (float) $branchCounts->total_active,
                    'total_branches_inactive' => (float) $branchCounts->total_inactive,
                ],
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage(),
            ], 500);
        }
    }
}
