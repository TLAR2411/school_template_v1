<?php

namespace App\Http\Controllers\Api\App;

use App\Http\Controllers\Controller;
use App\Models\School\Curriculum;
use App\Models\School\Year;

class AcademicController extends Controller
{
    public function years()
    {
        try {
            $years = Year::query()
                ->where('is_active', true)
                ->orderByDesc('start_date')
                ->get(['id', 'name', 'start_date', 'end_date']);

            return response()->json([
                'status' => true,
                'data' => $years,
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => 'Failed to get academic years',
                'error' => $th->getMessage(),
            ], 500);
        }
    }

    public function curriculums()
    {
        try {
            $curriculums = Curriculum::query()
                ->where('is_active', true)
                ->orderBy('name_en')
                ->get(['id', 'name_en', 'name_kh', 'symbol', 'description']);

            return response()->json([
                'status' => true,
                'data' => $curriculums,
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => 'Failed to get curriculums',
                'error' => $th->getMessage(),
            ], 500);
        }
    }
}
