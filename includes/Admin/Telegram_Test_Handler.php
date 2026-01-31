<?php

namespace TelegramNotification\Admin;

use TelegramNotification\Core\Telegram_Api_Client;
use TelegramNotification\Core\Telegram_Settings;

class Telegram_Test_Handler {

    private static string $check_admin_referer_action = 'telegram_test_action';
    private static string $check_admin_referer_nonce = 'telegram_test_nonce';
    private static string $post_string = 'telegram_notify_send_test_message';

    public static function register() {
        add_action('admin_init', [ self::class, 'handle']);
    }

    public static function handle() {

        # Check $_POST -> Check Admin
        if (!isset($_POST[self::$post_string])) {
            return;
        }

        if (
        ! check_admin_referer(self::$check_admin_referer_action, self::$check_admin_referer_nonce)
        ) {
            return;
        }

        $message = trim($_POST[self::$post_string] ?? '');

        if ($message === '') {
            $message = 'Telegram test successful';
        }

        $telegram_settings = Telegram_Settings::get_credentials();

        // Get Bot Token and Fallback if error
        $bot_token = $telegram_settings['bot_token'] ?? '';
        $chat_id = $telegram_settings['chat_id'] ?? '';

        // Check Empty Bot Token or Chat ID
        if (!$bot_token || !$chat_id) {
            add_action('admin_notices', function () {

                if (!current_user_can('manage_options')) {
                    return;
                }
                $message = 'Missing Bot Token or Chat ID';
                echo "<div class='notice notice-error is-dismissible'><p> $message </p></div>";
            });

            return;
        }

        // Send
        $api_client = new Telegram_Api_Client($bot_token, $chat_id);
        $api_client->send_message($message);
    }
}