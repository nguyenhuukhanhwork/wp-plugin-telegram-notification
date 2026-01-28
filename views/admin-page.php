<?php
/**
 *  @var array $options
 *  @var string $option_group
 */
?>

<div class="wrap">
    <h1>Telegram API Settings</h1>

    <form method="post" action="options.php">
        <?php settings_fields($option_group); ?>

        <table class="form-table">
            <tr>
                <th scope="row">API Token</th>
                <td>
                    <input
                        type="text"
                        name="telegram_notify_credentials[api_token]"
                        value="<?php echo esc_attr($options['api_token'] ?? ''); ?>"
                        class="regular-text"
                    >
                </td>
            </tr>

            <tr>
                <th scope="row">API Secret</th>
                <td>
                    <input
                        type="password"
                        name="telegram_notify_credentials[api_secret]"
                        value="<?php echo esc_attr($options['api_secret'] ?? ''); ?>"
                        class="regular-text"
                    >
                </td>
            </tr>
        </table>

        <?php submit_button(); ?>
    </form>
</div>
