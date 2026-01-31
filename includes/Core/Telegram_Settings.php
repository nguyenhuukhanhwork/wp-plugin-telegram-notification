<?php

namespace TelegramNotification\Core;

class Telegram_Settings {
    const OPTION_NAME = 'telegram_notify_credentials';

    /**
     * Get Bot data
     * @return array
     */
    public static function get_credentials(): array {
        $options = get_option( self::OPTION_NAME, [] );
        return [
            'bot_token' => $options['bot_token'] ?? '',
            'chat_id' => $options['chat_id'] ?? ''
        ];
    }

    public static function get_bot_token(): string {
        return self::get_credentials()['bot_token'] ??'';
    }

    public static function get_default_chat_id(): string {
        return self::get_credentials()['chat_id'] ?? '';
    }

    /**
     * Turn On/ Turn Off send Notification
     * @return bool
     */
    public static function is_notify_enabled(): bool {
        $options = get_option(self::OPTION_NAME, []);
        return isset($options['notify_on']) && $options['notify_on'] === '1';
    }

    /**
     * Check Empty API Token and Secrect
     * @return bool
     */
    public static function has_valid_credentials(): bool {
        $c = self::get_credentials();
        return ! empty($c['bot_token']) && ! empty($c['chat_id']);
    }
}