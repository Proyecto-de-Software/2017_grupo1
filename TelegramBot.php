<?php
require __DIR__ . '/vendor/autoload.php';
require  '/private/Telegram/bot_config.php';

$commands_paths = [__DIR__ . '/private/Telegram/Commands'];
try
{
    $telegram = new Longman\TelegramBot\Telegram(TelegramBotConfig::bot_api_key, TelegramBotConfig::bot_username);
    $telegram->addCommandsPaths($commands_paths);
    $telegram->enableLimiter();
    $telegram->handle();
}
catch (Longman\TelegramBot\Exception\TelegramException $e)
{
  // aca podriamos guardar las excepciones en algun lado
}