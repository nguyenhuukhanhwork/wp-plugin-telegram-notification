<?php
/**
 *  @var array $options: `bot_token`, `chat_id`, `notify_on`
 *  @var string $option_group
 */

use TelegramNotification\Core\Telegram_Api_Client;
use TelegramNotification\Core\Telegram_Settings;

?>

<div class="wrap">
    <h1>Telegram API Settings</h1>

    <!-- Form Setting -->
    <form method="post" action="options.php">
        <?php settings_fields($option_group); ?>

        <table class="form-table">

            <!-- API  -->
            <tr>
                <th scope="row">Bot Token</th>
                <td>
                    <input
                        type="password"
                        name="telegram_notify_credentials[bot_token]"
                        value="<?php echo esc_attr($options['bot_token'] ?? ''); ?>"
                        class="regular-text"
                    >
                </td>
            </tr>

            <!-- Chat ID -->
            <tr>
                <th scope="row">Chat ID</th>
                <td>
                    <input
                        type="text"
                        name="telegram_notify_credentials[chat_id]"
                        value="<?php echo esc_attr($options['chat_id'] ?? ''); ?>"
                        class="regular-text"
                    >
                </td>
            </tr>

            <!-- On/Off Send Notification -->
            <tr>
                <th scope="row">Enable Send Notification</th>
                <td>
                    <label>
                        <input
                            type="radio"
                            name="telegram_notify_credentials[notify_on]"
                            value="1"
                            <?php checked( $options['notify_on'] ?? '0', '1' ); ?>                        >
                        Yes
                    </label>
                    &nbsp;&nbsp;
                    <label>
                        <input
                            type="radio"
                            name="telegram_notify_credentials[notify_on]"
                            value="0"
                            <?php checked( $options['notify_on'] ?? '0', '0' ); ?>
                        >
                        No
                    </label>
                </td>
            </tr>

        </table>

        <?php submit_button(); ?>
    </form>

    <!-- Form Send Test  -->
    <hr>
    <h1>Test Telegram Message</h1>

    <form method="post">
        <?php wp_nonce_field('telegram_test_action', 'telegram_test_nonce'); ?>

        <p>
            <textarea
                name="telegram_notify_send_test_message"
                rows="4"
                class="large-text"
                placeholder="Leave empty to send default test message"
            ></textarea>
        </p>

        <p>
            <?php submit_button('Send Test Message', 'primary', 'telegram_send_test');?>
        </p>
    </form>
</div>