<?php
ini_set('display_startup_errors', 1);
ini_set('display_errors', 1);
error_reporting(-1);

require __DIR__ . '/vendor/autoload.php';
require __DIR__ . '/private/Telegram/Commands/autoloader.php';
require  './private/Telegram/bot_config.php';
require  './private/autoloader.php';

$commands_paths = [__DIR__ . '/private/Telegram/Commands'];
try
{
    $telegram = new Longman\TelegramBot\Telegram(TelegramBotConfig::bot_api_key, TelegramBotConfig::bot_username);
    // Logging (Error, Debug and Raw Updates)
    $telegram->addCommandsPaths($commands_paths);
    $telegram->enableLimiter();
    $telegram->handle();
}
catch (Longman\TelegramBot\Exception\TelegramException $e)
{
  // controlar excepcion
}