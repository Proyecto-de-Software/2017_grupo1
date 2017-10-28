<?php

require __DIR__ . '/vendor/autoload.php';

$bot_api_key  = '473002661:AAEsj26lXrKllYBfe5JXHphdHWYxX41dfjA';
$bot_username = 'grupo1_proyecto2017_bot';

try
{
    $telegram = new Longman\TelegramBot\Telegram($bot_api_key, $bot_username);

    // Handle telegram webhook request
    $telegram->handle();
}
catch (Longman\TelegramBot\Exception\TelegramException $e) {
    // Silence is golden!
    // log telegram errors
    // echo $e->getMessage();
}