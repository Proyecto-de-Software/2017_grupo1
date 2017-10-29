<?php
namespace Longman\TelegramBot\Commands\UserCommands;

use Longman\TelegramBot\Commands\UserCommand;
use Longman\TelegramBot\Request;

require_once './autoloader.php';

class TurnosCommand extends UserCommand
{
    protected $name = 'turnos';
    protected $description = '/turnos dd-mm-aaaa: Devolverá los turnos disponibles para la fecha indicada';
    protected $usage = '/turnos';
    protected $version = '1.0.0';

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
      return $this->getRepository()->getAppointments($date);
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
