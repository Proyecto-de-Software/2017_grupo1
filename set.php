<?php
// Load composer
require __DIR__ . '/vendor/autoload.php';

$bot_api_key  = '473002661:AAEizN1pskV5usMG2yKh7vzhYEDQL71DLCY';
$bot_username = 'grupo1_proyecto2017_bot';
$hook_url = 'https://grupo1.proyecto2017.linti.unlp.edu.ar/api/bot473002661:AAEsj26lXrKllYBfe5JXHphdHWYxX41dfj';

try {
    // Create Telegram API object
    $telegram = new Longman\TelegramBot\Telegram($bot_api_key, $bot_username);

    // Set webhook
    $result = $telegram->setWebhook($hook_url);
    if ($result->isOk()) {
        echo $result->getDescription();
    }
} catch (Longman\TelegramBot\Exception\TelegramException $e) {
    // log telegram errors
    // echo $e->getMessage();
}