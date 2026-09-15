<?php

namespace App\Http\Controllers\Api\School;

use App\Http\Controllers\Controller;
use App\Models\School\Shift;
use Illuminate\Http\Request;

class ShiftController extends Controller
{
    public function all()
    {
        $data = Shift::all();
        return response()->json([
            'data' => $data,
            'status' => true
        ]);
    }
}
