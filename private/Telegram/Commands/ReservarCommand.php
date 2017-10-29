<?php
namespace Longman\TelegramBot\Commands\UserCommands;

use Longman\TelegramBot\Commands\UserCommand;
use Longman\TelegramBot\Request;

class ReservarCommand extends UserCommand
{
  protected $name = 'reservar';
  protected $description = '/reservar dni dd-mm-aaaa hh-mm: Permite reservar un turno para un paciente indicando su dni, la fecha y la hora. Retorna un identificador único de turno.';
  protected $usage = '/reservar';
  protected $version = '1.0.0';

  private function parseArgs($params)
  {
    $temp_args = explode(' ', $params);

    if (count($temp_args) != 3)
      throw new \Exception('Recibidos ' . count($temp_args) . ' parametros, deben ser 3');

    return array(
      'dni' => $temp_args[0],
      'fecha' => $temp_args[1],
      'hora' => $temp_args[2]
    );
  }

  private function checkArgs($args)
  {
    if (!isset($args['dni']))
      throw new \Exception('DNI invalido');

    if (!isset($args['fecha']))
      throw new \Exception('Fecha invalida');

    if (!isset($args['hora']))
      throw new \Exception('Hora invalida');
  }

  private function requestAppointment($date, $time, $dni)
  {
    return \TelegramCommandHelper::appoint($date, $time, $dni);
  }

  public function execute()
  {
    $message = $this->getMessage();
    $chat_id = $message->getChat()->getId();

    try
    {
      $params = $this->parseArgs($message->getText(true));
      $this->checkArgs($params);
      $date = $params['fecha'];
      $time = $params['hora'];
      $dni = $params['dni'];

      $data = [
        'chat_id' => $chat_id,
        'text' => $this->requestAppointment($date, $time, $dni)
      ];
    }
    catch (\Exception $e)
    {
      $data = [
        'chat_id' => $chat_id,
        'text' => 'Ocurrio un error: ' . $e->getMessage()
      ];
    }

    return Request::sendMessage($data);
  }
}
