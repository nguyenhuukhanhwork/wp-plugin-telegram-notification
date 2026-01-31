<?php

namespace TelegramNotification\Core;

class Telegram_Api_Client {
    protected string $bot_token;
    protected string $chat_id;
    
    public function __construct(string $bot_token, string $chat_id) {
        $this->bot_token = $bot_token;
        $this->chat_id  = $chat_id;
    }
    
    protected function build_bot_api_url(string $method = 'sendMessage') : string {
        return sprintf(
            'https://api.telegram.org/bot%s/%s',
            $this->bot_token,
            $method
        );
    }

    protected function get_default_chat_id() : string {
        return $this->chat_id;
    }

    /**
     * 
     * Send Telegram Notification into Group Chat
     * @param string $message is message send
     * @param string $chat_id is id of chat group, if chat_id = '' use default chat_id
     * @param string $parse_mode is mode: HTML, MD,...
     * @return bool
     */
    public function send_message(string $message, string $chat_id = '', string $parse_mode = 'HTML'): bool {
        
        // Get Chat URL API and Chat ID
        $url = $this->build_bot_api_url();
        $chat_id = $chat_id ?: $this->get_default_chat_id();

        // Send message to chat group
        $response = wp_remote_post($url, [
            'timeout' => 10,
            'body' => [
                'chat_id' => $chat_id,
                'text' => $message,
                'parse_mode' => $parse_mode
            ]
        ]);

        // Check Error and write log
        if (is_wp_error($response)) {
            error_log('TELEGRAM NOTIFY ERROR: ' . $response->get_error_message());
            return false;
        }

        // Check code
        $data = json_decode(wp_remote_retrieve_body($response), true);


        if (empty($data['ok'])) {
            error_log('TELEGRAM API ERROR: ' . ($data['description'] ?? 'Unknown error'));
            return false;
        }

        return true;
    }
}