<?php
require __DIR__ . '/vendor/autoload.php';
require  './private/Telegram/bot_config.php';

$commands_paths = [__DIR__ . '/private/Telegram/Commands'];
try
{
    $telegram = new Longman\TelegramBot\Telegram(TelegramBotConfig::bot_api_key, TelegramBotConfig::bot_username);
    // Logging (Error, Debug and Raw Updates)
    Longman\TelegramBot\TelegramLog::initErrorLog(__DIR__ . "/bot_error.log");
    Longman\TelegramBot\TelegramLog::initDebugLog(__DIR__ . "/bot_debug.log");
    Longman\TelegramBot\TelegramLog::initUpdateLog(__DIR__ . "/bot_update.log");
    $telegram->addCommandsPaths($commands_paths);
    $telegram->enableLimiter();
    $telegram->handle();
}
catch (Longman\TelegramBot\Exception\TelegramException $e)
{
  Longman\TelegramBot\TelegramLog::error($e);
}