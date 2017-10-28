<?php
namespace Longman\TelegramBot\Commands\UserCommands;

use Longman\TelegramBot\Commands\UserCommand;
use Longman\TelegramBot\Request;

require_once "/private/Telegram/Commands/autoloader.php";

class TurnosCommand extends UserCommand
{
    private $name = 'turnos';
    private $description = '/turnos dd-mm-aaaa: Devolverá los turnos disponibles para la fecha indicada';
    private $usage = '/turnos';
    private $version = '1.0.0';

    private function isValidDate($text)
    {
      $d = DateTime::createFromFormat('d-m-Y', $text);
      return ($d && $d->format('d-m-Y') == $text);
    }

    private function getRepository()
    {
      return new AppointmentsRepository();
    }

    private function getAppointments($date)
    {
      return print_r($this->getRepository()->getAppointments($date));
    }

    public function execute()
    {
      try
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
            'text' => $this->getAppointments($date)
            ];
        }
      }
        catch (Exception $e)
        {
          $data = [
            'chat_id' => $chat_id,
            'text' => "error $e->getMessage()"
            ];
        }

      return Request::sendMessage($data);
    }
}