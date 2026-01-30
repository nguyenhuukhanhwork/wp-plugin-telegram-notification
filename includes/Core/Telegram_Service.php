<?php

namespace TelegramNotification\Core;

use TelegramNotification\Core\Telegram_Settings;
use TelegramNotification\Core\Telegram_Api_Client;
class Telegram_Service {

    public static function send(
        string $message,
        string $chat_id = ''
    ) {
        // Check Enable send
        $enable_chat = Telegram_Settings::is_notify_enabled();

        if ( $enable_chat ) {
            // get Chat ID and bot Token
            $chat_id = $chat_id ?: Telegram_Settings::get_default_chat_id();
            $bot_token = Telegram_Settings::get_bot_token();

            $client = new Telegram_Api_Client($bot_token, $chat_id);

            $client->send_message($message);

            return true;
        }

        return false;

    }
}