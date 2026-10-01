<?php

namespace App\Http\Controllers\Api\App;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;

class TelegramConnectionController extends Controller
{
    private const BOT_USERNAME = 'dis_noti_bot';

    private const WEBHOOK_SECRET = 'telegram-connection-webhook-2026';

    private function botToken(): string
    {
        return (string) ('8722156373:AAHd4q6-KZfUngqRdWZviY9HMuBThCJIsqU');
    }

    private function userId(): int
    {
        $userId = auth('api')->id();

        if (! $userId) {
            abort(401, 'Unauthenticated');
        }

        return (int) $userId;
    }

    private function ensureConnectToken(int $userId): string
    {
        $existing = DB::table('telegram_connect_tokens')
            ->where('user_id', $userId)
            ->where(function ($q) {
                $q->whereNull('expired_at')
                    ->orWhere('expired_at', '>', now());
            })
            ->first();

        if ($existing) {
            return $existing->token;
        }

        $token = Str::random(32);

        DB::table('telegram_connect_tokens')->updateOrInsert(
            ['user_id' => $userId],
            [
                'token' => $token,
                'expired_at' => now()->addDays(7),
                'updated_at' => now(),
                'created_at' => now(),
            ]
        );

        return $token;
    }

    private function connectPayload(string $token): array
    {
        return [
            'success' => true,
            'token' => $token,
            'link' => 'https://t.me/'.self::BOT_USERNAME.'?start='.$token,
            // Opens Telegram "Add to group", then sends /start TOKEN into that group.
            'group_add_link' => 'https://t.me/'.self::BOT_USERNAME.'?startgroup='.$token,
            // @bot required when Group Privacy is ON, otherwise Telegram hides the message.
            'group_link_command' => '/link@'.self::BOT_USERNAME.' '.$token,
        ];
    }

    // Generate Telegram connect link
    public function getTelegramConnectLink()
    {
        $token = $this->ensureConnectToken($this->userId());

        return response()->json($this->connectPayload($token));
    }

    // Telegram webhook
    public function webhook(Request $request)
    {
        // Always ACK quickly with HTTP 200. Telegram retries for minutes when the
        // webhook returns 500, which makes paste/link feel "slow" or stuck.
        try {
            if (! hash_equals(
                self::WEBHOOK_SECRET,
                (string) $request->header('X-Telegram-Bot-Api-Secret-Token')
            )) {
                return response()->json(['ok' => false], 403);
            }

            Log::info('Telegram connection webhook received', [
                'update_id' => $request->input('update_id'),
            ]);

            $message = $request->input('message');

            if (! $message) {
                return response()->json(['ok' => true]);
            }

            $chatId = $message['chat']['id'] ?? null;
            $chatType = $message['chat']['type'] ?? null;
            $chatTitle = $message['chat']['title'] ?? null;
            $username = $message['from']['username'] ?? null;
            $text = trim($message['text'] ?? '');

            if (! $chatId || $text === '') {
                return response()->json(['ok' => true]);
            }

            if (preg_match('/^\/start(?:@\w+)?(?:\s+(.+))?$/su', $text, $matches)) {
                $token = $this->normalizeConnectToken($matches[1] ?? '');

                // startgroup deep link sends /start TOKEN into the group.
                if (in_array($chatType, ['group', 'supergroup'], true)) {
                    return $this->linkGroupChat($chatId, $chatTitle, $token, $chatType, $username);
                }

                return $this->handlePersonalStart($chatId, $username, $token);
            }

            if (preg_match('/^\/link(?:@\w+)?(?:\s+(.+))?$/su', $text, $matches)) {
                return $this->linkGroupChat(
                    $chatId,
                    $chatTitle,
                    $this->normalizeConnectToken($matches[1] ?? ''),
                    $chatType,
                    $username
                );
            }
        }
        catch (\Throwable $e) {
            Log::error('Telegram webhook failed', [
                'error' => $e->getMessage(),
            ]);
        }

        return response()->json(['ok' => true]);
    }

    private function handlePersonalStart($chatId, ?string $username, string $token)
    {
        if ($token === '') {
            $this->sendMessage(
                $chatId,
                '❌ Invalid connect link. Please connect from your CamTool account.'
            );

            return response()->json(['ok' => true]);
        }

        $data = $this->findValidConnectToken($token);

        if (! $data) {
            $this->sendMessage(
                $chatId,
                '❌ Invalid or expired connect link. Open CamTool Settings → Telegram and connect again.'
            );

            return response()->json(['ok' => true]);
        }

        $existing = DB::table('telegram_users')
            ->where('user_id', $data->user_id)
            ->first();

        DB::table('telegram_users')->updateOrInsert(
            ['user_id' => $data->user_id],
            [
                'telegram_chat_id' => $chatId,
                'telegram_username' => $username,
                'telegram_group_chat_id' => $existing->telegram_group_chat_id ?? null,
                'telegram_group_title' => $existing->telegram_group_title ?? null,
                'updated_at' => now(),
                'created_at' => $existing->created_at ?? now(),
            ]
        );

        // Keep token alive so the same user can still link a print group.
        DB::table('telegram_connect_tokens')
            ->where('id', $data->id)
            ->update([
                'expired_at' => now()->addDays(7),
                'updated_at' => now(),
            ]);

        $this->sendMessage(
            $chatId,
            '✅ Personal chat connected. To print to a shop group, open CamTool Settings → Telegram → Add bot to group.'
        );

        return response()->json(['ok' => true]);
    }

    private function linkGroupChat($chatId, ?string $chatTitle, string $token, ?string $chatType = 'supergroup', ?string $username = null)
    {
        $token = trim($token);
        $chatId = (string) $chatId;

        if ($chatType !== null && ! in_array($chatType, ['group', 'supergroup'], true)) {
            $this->sendMessage(
                $chatId,
                '❌ Group link only works inside a Telegram group. Use “Add bot to group” from CamTool Settings → Telegram.'
            );

            return response()->json(['ok' => true]);
        }

        if ($token === '') {
            $this->sendMessage(
                $chatId,
                '❌ Missing token. Use “Add bot to group” from CamTool Settings → Telegram (recommended), or send /link@'.self::BOT_USERNAME.' YOUR_TOKEN'
            );

            return response()->json(['ok' => true]);
        }

        $data = $this->findValidConnectToken($token);

        if (! $data) {
            $this->sendMessage(
                $chatId,
                '❌ Invalid or expired link token. Open CamTool Settings → Telegram, refresh, then try Add bot to group again.'
            );

            return response()->json(['ok' => true]);
        }

        if (
            ! Schema::hasColumn('telegram_users', 'telegram_group_chat_id')
            || ! Schema::hasColumn('telegram_users', 'telegram_group_title')
        ) {
            $this->sendMessage(
                $chatId,
                '❌ Server DB missing group columns. Run telegram_users migration on production, then try again.'
            );

            return response()->json(['ok' => true]);
        }

        $existing = DB::table('telegram_users')
            ->where('user_id', $data->user_id)
            ->first();

        // Idempotent: avoid spam when Telegram retries the same update.
        if ($existing && (string) ($existing->telegram_group_chat_id ?? '') === $chatId) {
            $title = $chatTitle ? " \"{$chatTitle}\"" : '';
            $this->sendMessage(
                $chatId,
                "✅ Already linked{$title}. Print invoices will go to this group."
            );

            return response()->json(['ok' => true]);
        }

        // Production columns telegram_chat_id + telegram_username are NOT NULL.
        // Always send non-null strings (group fallback) so insert/update never fails.
        $personalChatId = trim((string) ($existing->telegram_chat_id ?? ''));
        $personalUsername = trim((string) ($existing->telegram_username ?? ''));
        $fromUsername = trim((string) ($username ?? ''));

        $payload = [
            'telegram_chat_id' => $personalChatId !== '' ? $personalChatId : $chatId,
            'telegram_username' => $personalUsername !== '' ? $personalUsername : ($fromUsername !== '' ? $fromUsername : 'group'),
            'telegram_group_chat_id' => $chatId,
            'telegram_group_title' => trim((string) ($chatTitle ?? '')) !== '' ? $chatTitle : 'Telegram group',
            'updated_at' => now(),
        ];

        try {
            if ($existing) {
                DB::table('telegram_users')
                    ->where('user_id', $data->user_id)
                    ->update($payload);
            }
            else {
                DB::table('telegram_users')->insert(array_merge([
                    'user_id' => $data->user_id,
                    'created_at' => now(),
                ], $payload));
            }
        }
        catch (\Throwable $e) {
            Log::error('Telegram group link failed', [
                'user_id' => $data->user_id,
                'chat_id' => $chatId,
                'error' => $e->getMessage(),
            ]);

            $shortError = Str::limit($e->getMessage(), 160, '...');
            $this->sendMessage(
                $chatId,
                "❌ Could not save group link.\n{$shortError}"
            );

            return response()->json(['ok' => true]);
        }

        DB::table('telegram_connect_tokens')
            ->where('id', $data->id)
            ->update([
                'expired_at' => now()->addDays(7),
                'updated_at' => now(),
            ]);

        $title = $chatTitle ? " \"{$chatTitle}\"" : '';
        $this->sendMessage(
            $chatId,
            "✅ Print destination linked{$title}. Invoice prints from CamTool will be sent to this group."
        );

        return response()->json(['ok' => true]);
    }

    private function normalizeConnectToken(?string $token): string
    {
        $token = trim((string) $token);
        // Users sometimes paste a trailing ? from chat/UI.
        $token = rtrim($token, '?!.,;');

        return $token;
    }

    private function findValidConnectToken(string $token)
    {
        $token = $this->normalizeConnectToken($token);

        if ($token === '') {
            return null;
        }

        return DB::table('telegram_connect_tokens')
            ->where('token', $token)
            ->where(function ($q) {
                $q->whereNull('expired_at')
                    ->orWhere('expired_at', '>', now());
            })
            ->first();
    }

    public function sendMessageToChat(Request $request)
    {
        $validated = $request->validate([
            'comment_id' => ['required', 'integer'],
            'text' => ['nullable', 'string', 'max:4096'],
        ]);

        $userData = DB::table('telegram_users')
            ->where('user_id', $this->userId())
            ->first();

        if (! $userData) {
            return response()->json([
                'success' => false,
                'message' => 'Telegram chat is not connected',
            ], 404);
        }

        $targetChatId = $userData->telegram_group_chat_id ?: $userData->telegram_chat_id;

        if (! $targetChatId) {
            return response()->json([
                'success' => false,
                'message' => 'No Telegram print destination. Connect personal chat or link a group.',
            ], 404);
        }

        $comment = DB::table('facebook_comments')
            ->where('id', $validated['comment_id'])
            ->first();

        if (! $comment) {
            return response()->json([
                'success' => false,
                'message' => 'Comment not found',
            ], 404);
        }

        $commentDate = $comment->comment_created_time
            ?? $comment->created_at
            ?? now()->format('Y-m-d H:i:s');

        $note = $validated['text'] ?? $comment->note ?? '-';

        $telegramMessage = implode("\n", [
            '<b>ការបញ្ជាទិញ និង Print Draft</b>',
            '',
            '#️⃣ កូដបញ្ជាទិញ : '.$comment->id,
            '📅 ថ្ងៃទីបញ្ជាទិញ : '.$commentDate,
            '👤 ឈ្មោះអ្នកបញ្ជាទិញ : <code>'.$this->escapeTelegramHtml($comment->from_name ?? '-').'</code>',
            '✅ កូដ ឬ Comment : '.$this->escapeTelegramHtml($comment->message ?? '-'),
            '✍️ Note : '.$this->escapeTelegramHtml($note),
        ]);

        $result = $this->sendTelegramRequest('sendMessage', [
            'chat_id' => $targetChatId,
            'text' => $telegramMessage,
            'parse_mode' => 'HTML',
        ]);

        if (($result['ok'] ?? false) !== true) {
            return response()->json([
                'success' => false,
                'message' => 'Telegram send failed',
                'telegram_error' => $result,
            ], 500);
        }

        DB::table('facebook_comments')
            ->where('id', $validated['comment_id'])
            ->update([
                'is_draft_print' => 1,
            ]);

        return response()->json([
            'success' => true,
            'destination' => $userData->telegram_group_chat_id ? 'group' : 'personal',
            'group_title' => $userData->telegram_group_title,
        ]);
    }

    public function sendAlertToUser($userId, $message)
    {
        return $this->notifyUserPrintDestination((int) $userId, (string) $message);
    }

    /**
     * Send a message to the user's print destination (group preferred, else personal).
     */
    public function notifyUserPrintDestination(int $userId, string $htmlMessage): bool
    {
        $telegram = DB::table('telegram_users')
            ->where('user_id', $userId)
            ->first();

        if (! $telegram) {
            return false;
        }

        $chatId = $telegram->telegram_group_chat_id ?: $telegram->telegram_chat_id;

        if (! $chatId) {
            return false;
        }

        try {
            $result = $this->sendMessage($chatId, $htmlMessage, 'HTML');

            return ($result['ok'] ?? false) === true;
        }
        catch (\Throwable $e) {
            Log::error('Telegram notifyUserPrintDestination failed', [
                'user_id' => $userId,
                'chat_id' => $chatId,
                'error' => $e->getMessage(),
            ]);

            return false;
        }
    }

    public function sendMessage($chatId, $message, ?string $parseMode = null)
    {
        $parameters = [
            'chat_id' => $chatId,
            'text' => $message,
        ];

        if ($parseMode) {
            $parameters['parse_mode'] = $parseMode;
        }

        return $this->sendTelegramRequest('sendMessage', $parameters);
    }

    public function sendTelegramRequest($method, $parameters = [])
    {
        $botToken = $this->botToken();

        if (! $botToken) {
            Log::error('Telegram bot token missing');

            return [
                'ok' => false,
                'description' => 'Telegram bot token missing',
            ];
        }

        $url = "https://api.telegram.org/bot{$botToken}/{$method}";

        $response = Http::timeout(8)->post($url, $parameters);

        Log::info('Telegram API response', [
            'method' => $method,
            'status' => $response->status(),
            'body' => $response->body(),
        ]);

        return $response->json();
    }

    public function escapeTelegramHtml($text): string
    {
        return htmlspecialchars((string) $text, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
    }

    public function checkConnectTelegram()
    {
        $userId = $this->userId();
        $telegram = DB::table('telegram_users')
            ->where('user_id', $userId)
            ->first();

        $token = $this->ensureConnectToken($userId);
        $payload = $this->connectPayload($token);

        return response()->json([
            'status' => (bool) ($telegram?->telegram_chat_id || $telegram?->telegram_group_chat_id),
            'personal_connected' => (bool) $telegram?->telegram_chat_id,
            'group_linked' => (bool) $telegram?->telegram_group_chat_id,
            'group_title' => $telegram?->telegram_group_title,
            'telegram_username' => $telegram?->telegram_username,
            'group_link_command' => $payload['group_link_command'],
            'group_add_link' => $payload['group_add_link'],
            'link' => $payload['link'],
        ]);
    }

    public function disConnectBot()
    {
        $deleted = DB::table('telegram_users')
            ->where('user_id', $this->userId())
            ->delete();

        return response()->json([
            'status' => $deleted ? true : false,
        ]);
    }

    public function unlinkTelegramGroup()
    {
        $updated = DB::table('telegram_users')
            ->where('user_id', $this->userId())
            ->update([
                'telegram_group_chat_id' => null,
                'telegram_group_title' => null,
                'updated_at' => now(),
            ]);

        return response()->json([
            'success' => true,
            'status' => $updated > 0,
        ]);
    }
}
