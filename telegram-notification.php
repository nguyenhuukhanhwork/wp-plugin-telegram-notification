<?php
/**
 * Plugin Name: ECB Mock Checkout (Dev Tool)
 * Description: Create WooCommerce orders from mock payload via WP-CLI (for dev/testing)
 * Version: 1.0.0
 * Author: KhanhECB
 */

namespace TelegramNotification;
use TelegramNotification\Admin\Telegram_Admin;
use TelegramNotification\Core\Telegram_Api_Client;
use TelegramNotification\Core\Telegram_Settings;

if ( ! defined('ABSPATH') ) {
    exit;
}

$plugin_dir = plugin_dir_path(__FILE__);
$plugin_url = plugin_dir_url(__FILE__);

define("TELEGRAM_NOTIFY_DIR", $plugin_dir);

require_once __DIR__ . '/vendor/autoload.php';

// If is admin page is load Class Admin Setting
add_action('plugins_loaded', function () {
    if ( is_admin() ) {
        ( new Telegram_Admin() )->register();
    }
});

add_action('init', function() {
    $telegram_settings = Telegram_Settings::get_credentials();
    $enable_send = Telegram_Settings::is_notify_enabled();

    if ( $enable_send ) {
        $api_token = $telegram_settings['api_token'];
        $api_id = $telegram_settings['api_secret'];
        $api_client = new Telegram_Api_Client($api_token, $api_id);
        $api_client->send_message("Send Notification - demo");
    }
});