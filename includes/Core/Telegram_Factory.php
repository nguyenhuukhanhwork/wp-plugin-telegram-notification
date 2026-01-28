<?php

namespace TelegramNotification\Core;

use TelegramNotification\Core\Telegram_Process;

class Telegram_Factory {

    public static function make(string $channel): Telegram_Process {

        $map = [
            'order' => [
                'token'   => 'BOT_TOKEN_ORDER',
                'chat_id' => 'CHAT_ID_ORDER',
            ],
            'error' => [
                'token'   => 'BOT_TOKEN_ERROR',
                'chat_id' => 'CHAT_ID_ERROR',
            ],
        ];

        if (!isset($map[$channel])) {
            throw new \InvalidArgumentException('Invalid Telegram channel');
        }

        return new Telegram_Process(
            $map[$channel]['token'],
            $map[$channel]['chat_id']
        );
    }
}