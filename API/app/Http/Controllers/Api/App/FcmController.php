<?php

namespace App\Http\Controllers\Api\App;

use App\Http\Controllers\Controller;
use Google\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use RuntimeException;
use Throwable;

class FcmController extends Controller
{
    private const FIREBASE_PROJECT_ID = 'dismobile-51f75';

    private const FIREBASE_CREDENTIALS_FILE =
        'dismobile-51f75-firebase-adminsdk-fbsvc-ecdca8f7d6.json';

    public function sendNotification(Request $request)
    {
        $validated = $request->validate([
            'permission_request_id' => ['nullable', 'required_without:user_id', 'integer'],
            // Backward compatibility: user_id previously contained a permission request ID.
            'user_id' => ['nullable', 'required_without:permission_request_id', 'integer'],
            'type' => ['required', 'string', 'max:100'],
        ]);

        $permissionRequestId = $validated['permission_request_id'] ?? $validated['user_id'];

        return $this->sendPermissionStatusNotification(
            $permissionRequestId,
            $validated['type']
        );
    }

    public function sendPermissionStatusNotification(int $permissionRequestId, string $type)
    {
        $permissionRequest = DB::table('api_request_permission')
            ->where('id', $permissionRequestId)
            ->first(['id', 'user_id']);

        if (! $permissionRequest) {
            return response()->json([
                'status' => 1,
                'message' => 'Permission request not found',
            ], 404);
        }

        return $this->sendToTokens(
            $this->deviceTokensForUsers(collect([$permissionRequest->user_id])),
            'DIS Mobile',
            "Your permission request has been {$type}.",
        );
    }

    public function sendNotiToAtt(Request $request)
    {
        $validated = $request->validate([
            'student_id' => ['required', 'integer', 'exists:students,id'],
            'text_message' => ['required', 'string', 'max:1000'],
        ]);

        $familyIds = DB::table('family_students')
            ->where('student_id', $validated['student_id'])
            ->where('is_active', true)
            ->whereNull('deleted_at')
            ->distinct()
            ->pluck('family_id');

        if ($familyIds->isEmpty()) {
            return response()->json([
                'status' => 1,
                'message' => 'No active family found for this student',
            ], 404);
        }

        $userIds = DB::table('family_members')
            ->whereIn('family_id', $familyIds)
            ->where('is_active', true)
            ->whereNull('deleted_at')
            ->whereNotNull('user_id')
            ->distinct()
            ->pluck('user_id');

        if ($userIds->isEmpty()) {
            return response()->json([
                'status' => 1,
                'message' => 'No active family members with a user account were found',
            ], 404);
        }

        return $this->sendToTokens(
            $this->deviceTokensForUsers($userIds),
            'សាលាចំណេះទូទៅអន្តរជាតិ ឌូវី',
            $validated['text_message'],
        );
    }

    private function deviceTokensForUsers(Collection $userIds): Collection
    {
        return DB::table('tbl_user_devices')
            ->whereIn('user_id', $userIds)
            ->whereNotNull('device_token')
            ->where('device_token', '!=', '')
            ->distinct()
            ->pluck('device_token');
    }

    private function sendToTokens(Collection $tokens, string $title, string $body)
    {
        if ($tokens->isEmpty()) {
            return response()->json([
                'status' => 1,
                'message' => 'No device tokens found',
            ], 404);
        }

        try {
            $accessToken = $this->firebaseAccessToken();
            $projectId = self::FIREBASE_PROJECT_ID;
            $url = "https://fcm.googleapis.com/v1/projects/{$projectId}/messages:send";
            $success = 0;
            $failed = 0;

            foreach ($tokens as $deviceToken) {
                $response = Http::withToken($accessToken)
                    ->acceptJson()
                    ->timeout(30)
                    ->post($url, [
                        'message' => [
                            'token' => $deviceToken,
                            'notification' => [
                                'title' => $title,
                                'body' => $body,
                            ],
                            'data' => [
                                'click_action' => 'FLUTTER_NOTIFICATION_CLICK',
                                'screen' => 'home',
                            ],
                        ],
                    ]);

                if ($response->successful()) {
                    $success++;
                } else {
                    $failed++;
                    Log::warning('FCM notification failed', [
                        'http_status' => $response->status(),
                        'response' => $response->json(),
                    ]);
                }
            }

            return response()->json([
                'status' => $success > 0 ? 0 : 1,
                'message' => 'Notification sending completed',
                'success' => $success,
                'failed' => $failed,
            ], $success > 0 ? 200 : 502);
        } catch (Throwable $exception) {
            Log::error('FCM notification error', [
                'message' => $exception->getMessage(),
                'exception' => $exception,
            ]);

            return response()->json([
                'status' => 1,
                'message' => 'Unable to send notification',
            ], 500);
        }
    }

    private function firebaseAccessToken(): string
    {
        $credentialsPath = __DIR__.DIRECTORY_SEPARATOR.self::FIREBASE_CREDENTIALS_FILE;

        if (! is_file($credentialsPath)) {
            throw new RuntimeException('Firebase credentials file was not found.');
        }

        $client = new Client();
        $client->setAuthConfig($credentialsPath);
        $client->addScope('https://www.googleapis.com/auth/firebase.messaging');
        $token = $client->fetchAccessTokenWithAssertion();

        if (! isset($token['access_token'])) {
            throw new RuntimeException('Unable to obtain a Firebase access token.');
        }

        return $token['access_token'];
    }
}
