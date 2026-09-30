<?php

namespace App\Http\Controllers\Api\App;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class UserDeviceTokenController extends Controller
{
    public function saveDeviceToken(Request $request)
    {
        $validated = $request->validate([
            'device_token' => ['required', 'string', 'max:4096'],
        ]);

        $userId = $request->user()->getAuthIdentifier();
        $deviceToken = $validated['device_token'];

        try {
            DB::table('tbl_user_devices')->updateOrInsert(
                ['device_token' => $deviceToken],
                ['user_id' => $userId]
            );

            return response()->json([
                'status' => 0,
                'message' => 'Device token saved successfully',
                'token' => $deviceToken,
            ]);
        } catch (\Throwable $exception) {
            Log::error('Failed to save device token', [
                'user_id' => $userId,
                'exception' => $exception,
            ]);

            return response()->json([
                'status' => 1,
                'message' => 'Failed to save device token',
            ], 500);
        }
    }
}
