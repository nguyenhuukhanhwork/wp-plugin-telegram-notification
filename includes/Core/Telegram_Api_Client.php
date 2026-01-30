<?php

namespace TelegramNotification\Core;

class Telegram_Api_Client {
    protected readonly string $bot_token;
    protected readonly string $chat_id;
    
    public function __construct(string $bot_token, string $chat_id) {
        $this->bot_token = $bot_token;
        $this->chat_id  = $chat_id = '-1003621712126';
    }
    
    protected function build_api_url(string $method = 'sendMessage') : string {
        return sprintf(
            'https://api.telegram.org/bot%s/%s',
            $this->bot_token,
            $method
        );
    }

    public function send_message(string $message, string $parse_mode = 'HTML'): bool {
        $url = $this->build_api_url();
        $response = wp_remote_post($url, [
            'timeout' => 10,
            'body' => [
                'chat_id' => $this->chat_id,
                'text' => $message,
                'parse_mode' => $parse_mode
            ]
        ]);

        if (is_wp_error($response)) {
            error_log('TELEGRAM NOTIFY ERROR: ' . $response->get_error_message());
            return false;
        }

        $data = json_decode(wp_remote_retrieve_body($response), true);

        error_log(print_r($data, true));

        if (empty($data['ok'])) {
            error_log('TELEGRAM API ERROR: ' . ($data['description'] ?? 'Unknown error'));
            return false;
        }


        return true;
    }
}