<?php
/**
 *  @var array $options: `api_token`, `api_secret`, `notify_on`
 *  @var string $option_group
 */
?>

<div class="wrap">
    <h1>Telegram API Settings</h1>

    <form method="post" action="options.php">
        <?php settings_fields($option_group); ?>

        <table class="form-table">

            <!-- API  -->
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

            <!-- Chat ID -->
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

            <!-- On/Off Send Notification -->
            <tr>
                <th scope="row">Send Telegram Notification</th>
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
</div>
