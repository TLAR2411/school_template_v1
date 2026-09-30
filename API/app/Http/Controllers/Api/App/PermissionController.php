<?php

namespace App\Http\Controllers\Api\App;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class PermissionController extends Controller
{
    public function sendPermission(Request $request)
    {
        return response()->json([
            'status' => true,
            'data' => $request->user()->getAllPermissions()->pluck('name'),
        ]);
    }

     public function updaterequest($id,$type)
    {
        header('Access-Control-Allow-Origin: *');
        header('Access-Control-Allow-Methods: *');
        $form = [
            
            'approve'=>$type
        ];
        $update_data= DB::table('api_request_permission')
                        ->where('id',$id)
                        ->update($form);
                        
         if($update_data)
        {
            echo 0;
              
        }else{
            
            echo 1;
            
        }                    
            
    }
     public function viewrequest($id)
    {
         header('Access-Control-Allow-Origin: *');
        $data= DB::table('api_request_permission')
                ->where('user_id',$id)->get();
                
        if($data)
        {
            return response()->json([
                "status"=>0,
                "data"=>$data,
                "message"=>"Succesfully"
              ],200);
              
        }else{
            
              return response()->json([
                    "status"=>1,
                    "message"=>"UnSuccesfully"
            ],400);
            
        }
    }
    public function requestpermission(Request $request)
    {
        $validated = $request->validate([
            'student_id' => ['required', 'integer'],
            'student_en' => ['nullable', 'string', 'max:255'],
            'student_kh' => ['nullable', 'string', 'max:255'],
            'type' => ['required', 'string', 'max:100'],
            'date_from' => ['required', 'date'],
            'date' => ['required', 'date', 'after_or_equal:date_from'],
            'phone_number' => ['nullable', 'string', 'max:30'],
            'reason' => ['required', 'string', 'max:2000'],
            'branch_id' => ['nullable', 'integer', 'min:1'],
        ]);

        try {
            $permissionRequestId = DB::table('api_request_permission')->insertGetId([
                'user_id' => $request->user()->getAuthIdentifier(),
                'student_id' => $validated['student_id'],
                'student_en' => $validated['student_en'] ?? null,
                'student_kh' => $validated['student_kh'] ?? null,
                'type' => $validated['type'],
                'date_from' => $validated['date_from'],
                'date' => $validated['date'],
                'phone_number' => $validated['phone_number'] ?? null,
                'reason' => $validated['reason'],
                'branch_id' => $validated['campus_id'] ?? 1,
            ]);

            return response()->json(
                [
                    'status' => 0,
                    'id' => $permissionRequestId,
                    'message' => 'Permission request submitted successfully',
                ],
                201
            );
        } catch (\Throwable $exception) {
            Log::error('Failed to submit permission request', [
                'user_id' => $request->user()->getAuthIdentifier(),
                'exception' => $exception,
            ]);

            return response()->json([
                'status' => 1,
                'message' => 'Failed to submit permission request',
            ], 500);
        }
    }
}
