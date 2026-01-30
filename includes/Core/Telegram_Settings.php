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
            'api_token' => $options['api_token'] ?? '',
            'api_secret' => $options['api_secret'] ?? ''
        ];
    }

    public static function get_bot_token(): string {
        return self::get_credentials()['api_token'] ??'';
    }

    public static function get_default_chat_id(): string {
        return self::get_credentials()['api_secret'] ?? '';
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
        return ! empty($c['api_token']) && ! empty($c['api_secret']);
    }
}