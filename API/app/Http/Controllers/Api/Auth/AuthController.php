<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\RefreshTokenRequest;
use App\Models\Auth\UserBranch;
use App\Models\Core\Branch;
use App\Models\User;
use Carbon\Carbon;
use GuzzleHttp\Client;
use Illuminate\Encryption\Encrypter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

// Add this line

class AuthController extends Controller
{

    // ✔ pass the user explicitly
    private function branchesFor(User $user)
    {
        if ($user->manage_branch == 1) {
            return Branch::where('id', $user->branch_id)->where('is_active', true)->get();
        } elseif ($user->manage_branch == 2) {
            return Branch::query()
                ->join('user_branches as ub', 'ub.branch_id', 'branches.id')
                ->where('ub.user_id', $user->id)
                ->where('branches.is_active', true)
                ->orderBy('branches.id', 'asc')
                ->get();
        } elseif ($user->manage_branch == 3) {
            return Branch::orderBy('id', 'asc')->where('is_active', true)->get();
        } elseif ($user->manage_branch == 4) {
            $userBranches = UserBranch::where('user_id', $user->id)->pluck('branch_id');
            return Branch::whereNotIn('id', $userBranches)->where('is_active', true)->orderBy('id', 'asc')->get();
        }
        return collect();
    }

    private function permissionsFor(int $userId)
    {
        $rolePermissions = User::query()
            ->leftJoin('role_user as ru', 'ru.user_id', 'users.id')
            ->leftJoin('permission_role as rp', 'rp.role_id', 'ru.role_id')
            ->leftJoin('permissions as p', 'p.id', 'rp.permission_id')
            ->where('users.id', $userId)
            ->pluck('p.name', 'p.id'); // <-- Pluck name as value, id as key

        $userPermissions = User::query()
            ->leftJoin('permission_user as pu', 'pu.user_id', 'users.id')
            ->leftJoin('permissions as p', 'p.id', 'pu.permission_id')
            ->where('users.id', $userId)
            ->pluck('p.name', 'p.id'); // <-- Pluck name as value, id as key

        // merge() combines the lists and handles duplicates (by key).
        // values() strips the keys and gives you just the names.
        return $rolePermissions->merge($userPermissions)->values();
    }

    private function generateTokenForUser(User $user, string $clientId, ?int $originalUserId = null)
    {
        try {
            // Create a personal access token for the user
            $tokenResult = $user->createToken('Personal Access Token', ['*']);
            $token = $tokenResult->token;

            // Store original user ID in token metadata if impersonating
            if ($originalUserId) {
                // Store in a custom field or use token name
                DB::table('oauth_access_tokens')
                    ->where('id', $token->id)
                    ->update([
                        'name' => json_encode([
                            'type' => 'impersonation',
                            'original_user_id' => $originalUserId,
                            'impersonated_at' => now()->toDateTimeString()
                        ])
                    ]);
            }

            return [
                'access_token' => $tokenResult->accessToken,
                'token_type' => 'Bearer',
                'expires_at' => $token->expires_at->toDateTimeString(),
            ];
        } catch (\Exception $e) {
            Log::error('Token generation failed: ' . $e->getMessage());
            throw $e;
        }
    }

    public function login(LoginRequest $request)
    {
        try {

            $user = User::query()
                ->whereUsername($request->username)
                ->orWhere('email', $request->username)
                ->first();

            if (!$user) {
                abort(500, 'User not found!');
            } else if (!Hash::check($request->password, $user->password)) {
                abort(500, 'Password is incorrect!');
            } else if ($user->is_active == false) {
                abort(500, "Account is disabled!");
            }
            $defaultBranch = "*";

            if ($user->manage_branch == 1) {
                $defaultBranch = $user->branch_id;
            } else {
                if ($user->manage_branch == 3) {
                    $branch = Branch::where('is_active', true)->count();
                    if ($branch <= 1) {
                        $defaultBranch = $user->branch_id;
                    }
                } elseif ($user->manage_branch == 2) {
                    $branch = UserBranch::join('branches as b', 'b.id', 'user_branches.branch_id')
                        ->where('b.is_active', true)
                        ->where('user_branches.user_id', $user->id)
                        ->count();

                    if ($branch <= 1) {
                        $defaultBranch = $user->branch_id;
                    }
                }
            }

            $client = new Client();

            $response = $client->request(
                'POST',
                env('APP_URL') . '/oauth/token',
                [
                    'form_params' => [
                        'grant_type' => "password",
                        'client_id' => $request->header('X-CLIENT-ID') ?? '',
                        'client_secret' => env('PASSPORT_CLIENT_SECRET'),
                        'username' => $user->email,
                        'password' => $request->password
                    ],
                ]
            );

            $user->last_login = Carbon::now();
            $user->save();
            $response = json_decode($response->getBody());
            $date = Carbon::now()->addSeconds($response->expires_in);
            return response()->json([
                'status' => true,
                'is_login' => true,
                'data' => [
                    'access_token' => [
                        'value' => $response->access_token,
                        'expiry' => $date->valueOf()
                    ],
                    'refresh_token' => $response->refresh_token,
                    'default_part' => $user->default_part,
                    'default_branch' => $defaultBranch
                ]
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage(),
            ], 500);
        }
    }


    public function refresh(RefreshTokenRequest $request)
    {
        try {
            $client = new Client();

            $response = $client->request(
                'POST',
                env('APP_URL') . '/oauth/token',
                [
                    'form_params' => [
                        'grant_type' => 'refresh_token',
                        'client_id' => $request->header('X-CLIENT-ID') ?? '',
                        'client_secret' => env('PASSPORT_CLIENT_SECRET'),
                        'refresh_token' => $request->refreshToken,
                        'scope' => "*"
                    ],
                ]
            );

            $response = json_decode($response->getBody());

            return response()->json([
                'status' => true,
                'access_token' => $response->access_token,
                'refresh_token' => $response->refresh_token
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage(),
            ], 500);
        }
    }

    public function logout()
    {
        try {
            $user = Auth::user();
            // Get and revoke the current token
            $token = $user->token();
            if ($token) {
                $token->revoke(); // Mark the token as revoked
            }

            return response()->json([
                'status' => true,
                'message' => 'User logout.'
            ]);
        } catch (\Exception $e) {
            Log::error('Logout failed: ' . $e->getMessage());

            return response()->json([
                'status' => false,
                'message' => 'An error occurred during logout.',
            ], 500);
        }
    }

    public function bootstrap(Request $request)
    {
        try {
            $key = env('CUSTOM_ENCRYPTION_KEY');
            if (str_starts_with($key, 'base64:')) {
                $key = base64_decode(substr($key, 7));
            }
            $encrypter = new Encrypter($key, config('app.cipher'));

            $authUser = $request->user();
            if (!$authUser) {
                return response()->json(['status' => 401, 'message' => 'Unauthenticated'], 401);
            }
            $user = User::query()
                ->with([
                    'mainUser.position',
                    'subUsers.position',
                    'subUsers.role',
                    'siblings.position',
                    'siblings.role',
                    'underUser',
                    'branch',
                    'role',
                    'position',
                    'village.commune.district.province'
                ])
                ->findOrFail(Auth::id());

            $branches = $this->branchesFor($user);        // ← uses the same helper now
            $permissions = $this->permissionsFor($user->id); // ← pass id

            return response()->json([
                'a' => 1, // status
                'b' => $encrypter->encryptString($user),
                'c' => $encrypter->encryptString($branches),
                'd' => $encrypter->encryptString($permissions),
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage(),
            ], 500);
        }
    }

    public function changeUser(Request $request)
    {
        try {

            $checkUser = User::findOrFail($request->user_id);

            if ($checkUser->type == 'sub') {
                $user = User::where('id', $request->user_id)
                    ->where('parent_user_id', Auth::id())
                    ->first();
            } else {
                $user = $checkUser;
            }
            if ($user) {

                // --- THIS IS THE NEW TOKEN GENERATION ---
                // Stop making HTTP requests. Create the token directly.
                // This is fast, secure, and doesn't need a password.
                // We use 'user-switch-token' as an example token name.
                $token = $user->createToken('user-switch-token')->accessToken;

                return response()->json([
                    'status' => true,
                    'data' => [
                        'access_token' => $token,
                        'refresh_token' => null,
                        'default_part' => $user->default_part,
                        'branch_id' => $user->branch_id,
                    ]
                ]);
            } else {
                // The user was not found OR they don't belong to the parent
                return response()->json([
                    'status' => false,
                    'message' => 'User not found or access denied.'
                ], 403); // Use 403 (Forbidden) or 404 (Not Found)
            }

            return response()->json([
                'status' => true,
                'data' => [
                    'access_token' => $token['access_token'],
                    'refresh_token' => $token['refresh_token'],
                    'default_part' => $user->default_part,
                    'branch_id' => $user->branch_id,
                ]
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 500);
        }
    }
}
