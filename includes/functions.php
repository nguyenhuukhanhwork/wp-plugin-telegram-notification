<?php

/**
 * This file implement functions for dev ue
 */


use TelegramNotification\Core\Telegram_Service;

/**
 * Function simple for send Telegram Message
 * @param string $message
 * @param string $chat_id
 * @return bool
 */
function telegram_send( string $message, string $chat_id = ''): bool {

    // Check Chat Id is string
    if ( ! is_string( $chat_id ) ) {
        error_log('telegram_send $message is string');
        return false;
    }

    // Check empty $message
    $message = trim( $message );
    if ( $message === '' ) {
        return false;
    }

    // Send Message
    return Telegram_Service::send( $message, $chat_id );
}