<?php

namespace TelegramNotification\Core;

class Telegram_Process {

    public function __construct(
        public readonly string $token,
        public readonly string $chatId,
    ) {}

    public function send(string $message) {
        return false;
    }
}