<?php
/**
 * Plugin Name: ECB Mock Checkout (Dev Tool)
 * Description: Create WooCommerce orders from mock payload via WP-CLI (for dev/testing)
 * Version: 1.0.0
 * Author: KhanhECB
 */

namespace TelegramNotification;
use TelegramNotification\Core\Telegram_Service;
use TelegramNotification\Admin\Telegram_Admin;
use TelegramNotification\Admin\Telegram_Test_Handler;

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
        ( new Telegram_Admin() )-> register();
    }
});

// Process Submit Send Message
Telegram_Test_Handler::register();

// Load FadeCade Funciton
require_once $plugin_dir . 'includes/functions.php';