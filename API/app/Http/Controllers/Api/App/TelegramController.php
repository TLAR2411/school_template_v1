<?php

namespace App\Http\Controllers\Api\App;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Throwable;

class TelegramController extends Controller
{
    private const BOT_TOKEN = '7764601839:AAGxWkULqfsXd0J5aehA3KPUFS8a7hs7KlM';

    private const WEBHOOK_SECRET = 'c4a8f7d62e1b4950b3d9f86a724ce105';

    private const CAMPUSES = [
        1 => [
            'chat_id' => '-4762087132',
            'campus_id' => 1,
        ],
        2 => [
            'chat_id' => '-5080617609',
            'campus_id' => 2,
        ],
        3 => [
            'chat_id' => '-5206253766',
            'campus_id' => 3,
        ],
    ];

    public function __construct(private readonly FcmController $fcmController)
    {
    }

    public function sendPermissionRequest(Request $request)
    {
        $validated = $request->validate([
            'id' => ['required', 'integer', 'exists:api_request_permission,id'],
            'text' => ['required', 'string', 'max:4096'],
            'student_id' => ['required', 'integer', 'exists:students,id'],
            'date_from' => ['required', 'date_format:Y-m-d'],
            'date' => ['required', 'date_format:Y-m-d', 'after_or_equal:date_from'],
            'number_of_days' => ['required', 'integer', 'min:1'],
        ]);

        $campusId = $this->extractCampusId($validated['text']);
        $campus = self::CAMPUSES[$campusId] ?? self::CAMPUSES[3];
        $message = "ID Request : {$validated['id']}\n"
            .$validated['text']."\n"
            ."ចំនួន: {$validated['number_of_days']} ថ្ងៃ";

        $replyMarkup = [
            'inline_keyboard' => [[
                [
                    'text' => '✅ Approve',
                    'callback_data' => $this->callbackData(
                        'approve',
                        $validated['id'],
                        $campus['campus_id']
                    ),
                ],
                [
                    'text' => '❌ Not Approve',
                    'callback_data' => $this->callbackData(
                        'not approve',
                        $validated['id'],
                        $campus['campus_id']
                    ),
                ],
            ]],
        ];

        try {
            $response = Http::asForm()
                ->timeout(30)
                ->post($this->telegramUrl('sendMessage'), [
                    'chat_id' => $campus['chat_id'],
                    'text' => $message,
                    'reply_markup' => json_encode(
                        $replyMarkup,
                        JSON_UNESCAPED_UNICODE | JSON_THROW_ON_ERROR
                    ),
                ]);

            if ($response->failed()) {
                Log::warning('Telegram permission notification failed', [
                    'request_id' => $validated['id'],
                    'http_status' => $response->status(),
                    'response' => $response->json(),
                ]);

                return response()->json([
                    'status' => 1,
                    'message' => 'Unable to send Telegram notification',
                ], 502);
            }

            return response()->json([
                'status' => 0,
                'message' => 'Telegram notification sent successfully',
                'data' => $response->json('result'),
            ]);
        } catch (Throwable $exception) {
            Log::error('Telegram permission notification error', [
                'request_id' => $validated['id'],
                'message' => $exception->getMessage(),
                'exception' => $exception,
            ]);

            return response()->json([
                'status' => 1,
                'message' => 'Unable to send Telegram notification',
            ], 500);
        }
    }

    public function webhook(Request $request)
    {
        $providedSecret = (string) $request->header('X-Telegram-Bot-Api-Secret-Token');

        if (! hash_equals(self::WEBHOOK_SECRET, $providedSecret)) {
            return response()->json(['ok' => false], 403);
        }

        $callbackQuery = $request->input('callback_query');

        if (! is_array($callbackQuery)) {
            return response()->json(['ok' => true]);
        }

        try {
            $callbackData = json_decode(
                (string) ($callbackQuery['data'] ?? ''),
                true,
                512,
                JSON_THROW_ON_ERROR
            );

            $action = $callbackData['action'] ?? null;
            $requestId = filter_var($callbackData['id'] ?? null, FILTER_VALIDATE_INT);
            $campusId = filter_var($callbackData['name'] ?? null, FILTER_VALIDATE_INT);

            if (! in_array($action, ['approve', 'not approve'], true)
                || $requestId === false
                || $campusId === false
                || ! isset(self::CAMPUSES[$campusId])) {
                $this->answerCallbackQuery(
                    $callbackQuery['id'] ?? null,
                    'Invalid callback data',
                    true
                );

                return response()->json(['ok' => true]);
            }

            $permissionRequest = DB::table('api_request_permission')
                ->where('id', $requestId)
                ->first(['id']);

            if (! $permissionRequest) {
                $this->answerCallbackQuery(
                    $callbackQuery['id'] ?? null,
                    'Permission request not found',
                    true
                );

                return response()->json(['ok' => true]);
            }

            $approved = $action === 'approve';
            DB::table('api_request_permission')
                ->where('id', $requestId)
                ->update(['approve' => $approved ? 0 : 3]);

            $this->answerCallbackQuery(
                $callbackQuery['id'] ?? null,
                $approved ? 'Request approved' : 'Request rejected'
            );

            $this->removeInlineKeyboard($callbackQuery);

            $fcmResponse = $this->fcmController->sendPermissionStatusNotification(
                $requestId,
                $approved ? 'approved' : 'rejected'
            );

            if ($fcmResponse->getStatusCode() >= 400) {
                Log::warning('FCM failed after Telegram permission decision', [
                    'request_id' => $requestId,
                    'http_status' => $fcmResponse->getStatusCode(),
                ]);
            }

            $this->telegramRequest('sendMessage', [
                'chat_id' => self::CAMPUSES[$campusId]['chat_id'],
                'text' => $approved
                    ? "✅ Approved ID: {$requestId}"
                    : "🛑 Not Approved ID: {$requestId}",
            ]);

            return response()->json(['ok' => true]);
        } catch (Throwable $exception) {
            Log::error('Telegram webhook error', [
                'message' => $exception->getMessage(),
                'exception' => $exception,
            ]);

            return response()->json(['ok' => false], 500);
        }
    }

    private function extractCampusId(string $text): int
    {
        preg_match('/សាខា\s*:\s*(\d+)/u', $text, $campusMatch);

        return isset($campusMatch[1]) ? (int) $campusMatch[1] : 3;
    }

    private function callbackData(string $action, int $requestId, int $campusId): string
    {
        return json_encode([
            'action' => $action,
            'id' => $requestId,
            'name' => $campusId,
        ], JSON_UNESCAPED_UNICODE | JSON_THROW_ON_ERROR);
    }

    private function answerCallbackQuery(?string $callbackQueryId, string $text, bool $showAlert = false): void
    {
        if (! $callbackQueryId) {
            return;
        }

        $this->telegramRequest('answerCallbackQuery', [
            'callback_query_id' => $callbackQueryId,
            'text' => $text,
            'show_alert' => $showAlert,
        ]);
    }

    private function removeInlineKeyboard(array $callbackQuery): void
    {
        $chatId = $callbackQuery['message']['chat']['id'] ?? null;
        $messageId = $callbackQuery['message']['message_id'] ?? null;

        if (! $chatId || ! $messageId) {
            return;
        }

        $this->telegramRequest('editMessageReplyMarkup', [
            'chat_id' => $chatId,
            'message_id' => $messageId,
            'reply_markup' => ['inline_keyboard' => []],
        ]);
    }

    private function telegramRequest(string $method, array $parameters): void
    {
        $response = Http::asJson()
            ->timeout(30)
            ->post($this->telegramUrl($method), $parameters);

        if ($response->failed()) {
            Log::warning('Telegram API request failed', [
                'method' => $method,
                'http_status' => $response->status(),
                'response' => $response->json(),
            ]);
        }
    }

    private function telegramUrl(string $method): string
    {
        return 'https://api.telegram.org/bot'.self::BOT_TOKEN.'/'.$method;
    }
}
