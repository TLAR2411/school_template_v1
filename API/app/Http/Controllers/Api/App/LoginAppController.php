<?php

namespace App\Http\Controllers\Api\App;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\AppLoginRequest;
use App\Models\User;
use Carbon\Carbon;
use Laravel\Passport\Passport;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class LoginAppController extends Controller
{
    public function login(AppLoginRequest $request)
    {
        try {
            $login = $request->username;

            $user = User::query()
                ->where(function ($query) use ($login) {
                    $query->where('username', $login)
                        ->orWhere('email', $login);
                })
                ->first();

            if (!$user) {
                abort(500, 'User not found!');
            } else if (!Hash::check($request->password, $user->password)) {
                abort(500, 'Password is incorrect!');
            } else if ($user->is_active == false) {
                abort(500, "Account is disabled!");
            }

            // App token only — does not change the 12-hour web login.
            Passport::personalAccessTokensExpireIn(Carbon::now()->addYears(10));

            $tokenResult = $user->createToken('app-login');

            $user->last_login = Carbon::now();
            $user->save();

            return response()->json([
                'status' => true,
                'is_login' => true,

                'access_token' => [
                    'value' => $tokenResult->accessToken,
                    'expiry' => $tokenResult->token->expires_at->valueOf(),
                ],
                'user_id' => $user->id,
                'user' => $user->only([
                    'name_kh',
                    'name_en',
                    'username',
                    'email',
                    'contact',
                ]),
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage(),
            ], 500);
        }
    }

    public function logout(Request $request)
    {
        $validated = $request->validate([
            'device_token' => ['nullable', 'string', 'max:4096'],
        ]);

        try {
            $user = $request->user();

            $deletedDeviceTokens = DB::transaction(function () use ($user, $validated) {
                $deleted = 0;

                if (! empty($validated['device_token'])) {
                    $deleted = DB::table('tbl_user_devices')
                        ->where('user_id', $user->getAuthIdentifier())
                        ->where('device_token', $validated['device_token'])
                        ->delete();
                }

                $accessToken = $user->token();

                if ($accessToken) {
                    $accessToken->revoke();
                }

                return $deleted;
            });

            return response()->json([
                'status' => true,
                'message' => 'Logged out successfully',
                'deleted_device_tokens' => $deletedDeviceTokens,
            ]);
        } catch (\Throwable $exception) {
            Log::error('App logout failed', [
                'user_id' => $request->user()?->getAuthIdentifier(),
                'exception' => $exception,
            ]);

            return response()->json([
                'status' => false,
                'message' => 'Unable to log out',
            ], 500);
        }
    }
}
