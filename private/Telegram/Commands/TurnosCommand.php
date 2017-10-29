<?php
namespace Longman\TelegramBot\Commands\UserCommands;

use Longman\TelegramBot\Commands\UserCommand;
use Longman\TelegramBot\Commands\AppointmentCommand;
use Longman\TelegramBot\Request;

class TurnosCommand extends UserCommand
{
  protected $name = 'turnos';
  protected $description = '/turnos dd-mm-aaaa: Devuelve  los turnos disponibles para la fecha indicada';
  protected $usage = '/turnos';
  protected $version = '1.0.0';

  private function getAvailableAppointments($date)
  {
    $available_appointments = AppointmentCommand::getRepository()->getAvailableAppointments($date);
    return 'Los turnos disponibles son: ' . implode(" | ", $available_appointments);
  }

  public function execute()
  {
    $message = $this->getMessage();
    $chat_id = $message->getChat()->getId();
    $date = $message->getText(true);

    try
    {
      AppointmentCommand::isValidDate($date);
      $data = [
        'chat_id' => $chat_id,
        'text' => $this->getAvailableAppointments($date)
      ];
    }
    catch (\Exception $e)
    {
      $data = [
        'chat_id' => $chat_id,
        'text' => $e .getMessage()
      ];
    }

    return Request::sendMessage($data);
  }
}
