<?php

use TelegramNotification\Core\Telegram_Settings;
use TelegramNotification\Core\Telegram_Api_Client;


add_action('admin_init', function(){

    # Check is admin
    if ( ! current_user_can('manage_options')) {
        return;
    }

    # Get Bot Token & Chat ID
    $telegram_settings = Telegram_Settings::get_credentials();
    $enable_send = Telegram_Settings::is_notify_enabled();

    # If is enable send => send Test
    if ( $enable_send ) {
        $api_token = $telegram_settings['api_token'];
        $api_id = $telegram_settings['api_secret'];
        $api_client = new Telegram_Api_Client($api_token, $api_id);
        $api_client->send_message("Send Notification - demo");
    }

});
