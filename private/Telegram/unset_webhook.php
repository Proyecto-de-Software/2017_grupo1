<?php
require __DIR__ . '/vendor/autoload.php';
require __DIR__. '/bot_config.php';

/* Al ejecutar este script PHP en un browser cualquiera, se desvincula el WebHook del Bot */
try
{
    $telegram = new Longman\TelegramBot\Telegram(TelegramBotConfig::bot_api_key, TelegramBotConfig::bot_username);
    $result = $telegram->deleteWebhook();
    if ($result->isOk())
        echo $result->getDescription();
}
catch (Longman\TelegramBot\Exception\TelegramException $e)
{
  echo $e->getMessage();
}