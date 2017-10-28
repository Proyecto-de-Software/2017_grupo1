<?php
ini_set('display_startup_errors', 1);
ini_set('display_errors', 1);
error_reporting(-1);

require __DIR__ . '/vendor/autoload.php';
require 'private/Telegram/bot_config.php';

/* Al ejecutar este script PHP en un browser cualquiera, se vincula el WebHook del Bot */
try
{
  $telegram = new Longman\TelegramBot\Telegram(TelegramBotConfig::bot_api_key, TelegramBotConfig::bot_username);

    $result = $telegram->setWebhook(TelegramBotConfig::hook_url);
    if ($result->isOk())
        echo $result->getDescription();
}
catch (Longman\TelegramBot\Exception\TelegramException $e)
{
  echo $e->getMessage();
}