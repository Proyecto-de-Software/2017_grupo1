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

  private function isValidDate($date)
  {
    $d = \DateTime::createFromFormat('d-m-Y', $date);
    if (!($d && $d->format('d-m-Y') == $date))
    {
      return false;
    }

    return true;
  }

  private function getRepository()
  {
    return new \AppointmentsRepository;
  }

  private function getAppointments($date)
  {
    return print_r($this->getRepository()->getAppointments($date));
  }

  public function execute()
  {
    $message = $this->getMessage();
    $chat_id = $message->getChat()->getId();
    $date = $message->getText(true);

    try
      {
      if ($this->isValidDate($date))
        $data = [
          'chat_id' => $chat_id,
          'text' =>$this->getAppointments()
        ];
      }
      else
      {
        $data = [
          'chat_id' => $chat_id,
          'text' => "$date no es una fecha valida, usar formato dd-mm-aaaa. Ejemplo <25-10-2017>"
        ];
      }
    } catch (\Exception $e)
      {
      $data = [
        'chat_id' => $chat_id,
        'text' => e . getMessage()
      ];
    }

    return Request::sendMessage($data);
  }
}
