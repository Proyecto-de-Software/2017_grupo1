<?php
namespace Longman\TelegramBot\Commands\UserCommands;

use Longman\TelegramBot\Commands\AppointmentCommand;
use Longman\TelegramBot\Request;

class TurnosCommand extends AppointmentCommand
{
  protected $name = 'turnos';
  protected $description = '/turnos dd-mm-aaaa: Devuelve  los turnos disponibles para la fecha indicada';
  protected $usage = '/turnos';
  protected $version = '1.0.0';

  private function getAvailableAppointments($date)
  {
    $available_appointments = $this->getRepository()->getAvailableAppointments($date);
    return 'Los turnos disponibles son: ' . implode(" | ", $available_appointments);
  }

  public function execute()
  {
    $message = $this->getMessage();
    $chat_id = $message->getChat()->getId();
    $date = $message->getText(true);

    try
      {
      if ($this->isValidDate($date))
      {
        $data = [
          'chat_id' => $chat_id,
          'text' =>$this->getAvailableAppointments($date)
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
        'text' => 'Ocurrio un error: ' . e . getMessage()
      ];
    }

    return Request::sendMessage($data);
  }
}
