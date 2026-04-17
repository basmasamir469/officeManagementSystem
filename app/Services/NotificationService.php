<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class NotificationService
{
    protected string $fcmServerKey;

    public function __construct()
    {
        $this->fcmServerKey = config('services.fcm.server_key');
    }

    /**
     * Send notification to a user
     *
     * @param mixed $user
     * @param string $title
     * @param string $body
     * @param array $data
     * @return bool
     */
    public function sendToUser($user, string $title, string $body, array $data = []): bool
    {
        if (!$user || empty($user->fcm_tokens)) {
            return false;
        }

        $tokens = is_array($user->fcm_tokens) ? $user->fcm_tokens : [$user->fcm_tokens];

        $payload = [
            'registration_ids' => $tokens,
            'notification' => [
                'title' => $title,
                'body' => $body,
            ],
            'data' => $data,
        ];

        try {
            $response = Http::withHeaders([
                'Authorization' => 'key=' . $this->fcmServerKey,
                'Content-Type' => 'application/json',
            ])->post('https://fcm.googleapis.com/fcm/send', $payload);

            $result = $response->json();

            if ($response->successful()) {
                // Handle invalid tokens
                if (isset($result['results'])) {
                    $validTokens = [];
                    foreach ($result['results'] as $index => $res) {
                        if (isset($res['error'])) {
                            Log::warning('FCM token error', ['token' => $tokens[$index], 'error' => $res['error']]);
                        } else {
                            $validTokens[] = $tokens[$index];
                        }
                    }
                    // Update user tokens, remove invalid ones
                    if (count($validTokens) !== count($tokens)) {
                        $user->update(['fcm_tokens' => $validTokens]);
                    }
                }
                return true;
            } else {
                Log::error('FCM send failed', ['response' => $result]);
                return false;
            }
        } catch (\Exception $e) {
            Log::error('FCM exception', ['error' => $e->getMessage()]);
            return false;
        }
    }
}