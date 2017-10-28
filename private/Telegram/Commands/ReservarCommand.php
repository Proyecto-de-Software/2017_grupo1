<?php
namespace Longman\TelegramBot\Commands\UserCommands;

use Longman\TelegramBot\Commands\UserCommand;
use Longman\TelegramBot\Request;

class ReservarCommand extends UserCommand
{
    protected $name = 'reservar';
    protected $description = '/reservar dni dd-mm-aaaa hh-mm: Permite reservar un turno para un paciente indicando su dni, la fecha y la hora.
                                              Retorna un identificador único de turno.';
    protected $usage = '/reservar';
    protected $version = '1.0.0';

    public function execute()
    {
      $message = $this->getMessage();
      $param = $message->getText(true);

      $chat_id = $message->getChat()->getId();

      $data = [
      'chat_id' => $chat_id,
      'text' => "este es el comando /reservar... con parametros $param"
      ];

      return Request::sendMessage($data);
    }
}