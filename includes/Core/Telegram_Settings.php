<?php

namespace TelegramNotification\Core;

class Telegram_Settings {
    const OPTION_NAME = 'telegram_notify_credentials';

    /**
     * Get data
     * @return array
     */
    public static function get_credentials(): array {
        $options = get_option( self::OPTION_NAME, [] );
        return [
            'api_token' => $options['api_token'] ?? '',
            'api_secret' => $options['api_secret'] ?? '',
        ];
    }

    /**
     * Check Empty API Token and Secrect
     * @return bool
     */
    public static function has_credentials(): bool {
        $c = self::get_credentials();
        return ! empty($c['api_token']) && ! empty($c['api_secret']);
    }
}