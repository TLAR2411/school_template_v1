<?php

namespace App\Http\Controllers\Api\School;

use App\Http\Controllers\Controller;
use App\Models\School\ClassType;
use Illuminate\Http\Request;

class ClassTypeController extends Controller
{
    public function all()
    {
        try {
            $data = ClassType::all();
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
