<?php
/**
 * Telegram Notification
 * 
 * @wordpress-plugin
 * @author  KhanhECB
 * 
 * Plugin Name: Telegram Notification
 * Description: Send message to Telegram chat group, notification for company.
 * Plugin URI: https://github.com/nguyenhuukhanhwork/wp-plugin-telegram-notification
 * Version: 1.0.0
 * Author: KhanhECB
 * Author URL: https://www.linkedin.com/in/khanh-nguyen-huu-1aa09733a/
 * Requires PHP: 8.1
 */

namespace TelegramNotification;

use TelegramNotification\Admin\Telegram_Admin;
use TelegramNotification\Admin\Telegram_Test_Handler;

if ( ! defined('ABSPATH') ) {
    exit;
}

define('TELEGRAM_NOTIFY_VERSION', '1.0.0');

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

// Load Facade Funciton
require_once $plugin_dir . 'includes/functions.php';