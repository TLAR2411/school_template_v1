<?php

namespace App\Http\Controllers\Api\School;

use App\Http\Controllers\Controller;
use App\Models\School\Month;
use Illuminate\Http\Request;

class MonthController extends Controller
{
    public function all(){
        $data = Month::all();
        return response()->json([
            'data'=>$data,
            'status'=>1
        ]);
    }
}
