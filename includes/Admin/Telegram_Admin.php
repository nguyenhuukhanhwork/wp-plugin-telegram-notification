<?php

namespace TelegramNotification\Admin;

use TelegramNotification\Core\Telegram_Settings;

class Telegram_Admin
{
    const OPTION_GROUP = 'telegram_notify_api_settings_group';

    public function register()
    {
        add_action('admin_init', [$this, 'register_options']);
        add_action('admin_menu', [$this, 'add_menu']);
    }

    /**
     * Register Option for API Token and API Secrect
     */
    public function register_options()
    {
        register_setting(
            self::OPTION_GROUP,
            Telegram_Settings::OPTION_NAME,
        );
    }

    public function add_menu()
    {
        add_menu_page(
            'Telegram Notify',
            'Telegram Notify',
            'manage_options',
            'telegram-notify',
            [$this, 'render_page'],
            'dashicons-admin-network'
        );
    }

    public function render_page()
    {
        $option_group = self::OPTION_GROUP;
        $options = get_option(Telegram_Settings::OPTION_NAME, []);
        $notify_enabled = Telegram_Settings::is_notify_enabled();
        include TELEGRAM_NOTIFY_DIR . 'views/admin-page.php';
    }
}

