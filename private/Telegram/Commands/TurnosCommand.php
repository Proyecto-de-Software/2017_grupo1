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

    public function execute()
    {
      $message = $this->getMessage();
      $fecha = $message->getText(true);

      $chat_id = $message->getChat()->getId();

      $data = [
      'chat_id' => $chat_id,
      'text' => "este es el comando /turnos, con parametro $fecha"
      ];

      return Request::sendMessage($data);
    }
}