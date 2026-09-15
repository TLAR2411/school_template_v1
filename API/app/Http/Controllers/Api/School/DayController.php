<?php

namespace App\Http\Controllers\Api\School;

use App\Http\Controllers\Controller;
use App\Models\School\Day;
use Illuminate\Http\Request;

class DayController extends Controller
{
    public function all()
    {
        try {
            $data = Day::all();
            return response()->json([
                'data' => $data,
                'status' => true
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'message' => $th->getMessage(),
                'status' => false
            ]);
        }
    }
}
