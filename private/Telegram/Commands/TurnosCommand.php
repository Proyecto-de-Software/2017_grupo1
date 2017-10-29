<?php
namespace Longman\TelegramBot\Commands\UserCommands;

use Longman\TelegramBot\Commands\UserCommand;
use Longman\TelegramBot\Request;

class TurnosCommand extends UserCommand
{
    protected $name = 'turnos';
    protected $description = '/turnos dd-mm-aaaa: Devolverá los turnos disponibles para la fecha indicada';
    protected $usage = '/turnos';
    protected $version = '1.0.0';

    private function isValidDate($text)
    {
      $d = DateTime::createFromFormat('d-m-Y', $text);
      if (!($d && $d->format('d-m-Y') == $text))
        return false;

      return true;
    }

    public function execute()
    {
    $message = $this->getMessage();
    $chat_id = $message->getChat()->getId();
    $date = $message->getText(true);

    if (!$this->isValidDate($date))
      {
      $data = [
        'chat_id' => $chat_id,
        'text' => "$date no es una fecha valida, usar formato dd-mm-aaaa. Ejemplo <25-10-2017>"
      ];
    }
    else
    {
      $data = [
        'chat_id' => $chat_id,
        'text' => "la fecha es $date"
      ];
    }

      return Request::sendMessage($data);
    }
}
