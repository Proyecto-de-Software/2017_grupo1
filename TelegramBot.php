<?php
require __DIR__ . '/vendor/autoload.php';

$bot_api_key  = '473002661:AAEsj26lXrKllYBfe5JXHphdHWYxX41dfjA';
$bot_username = 'grupo1_proyecto2017_bot';
$commands_paths = [__DIR__ . 'private/Telegram/Commands'];
try
{
    $telegram = new Longman\TelegramBot\Telegram($bot_api_key, $bot_username);
    $telegram->addCommandsPaths($commands_paths);
    $telegram->enableLimiter();
    $telegram->handle();
}
catch (Longman\TelegramBot\Exception\TelegramException $e) {
  // aca podriamos guardar las excepciones en algun lado
}