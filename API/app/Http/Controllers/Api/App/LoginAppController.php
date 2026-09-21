<?php

namespace App\Http\Controllers\Api\App;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\AppLoginRequest;
use App\Models\User;
use Carbon\Carbon;
use Laravel\Passport\Passport;
use Illuminate\Support\Facades\Hash;

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
}
