<?php
namespace Longman\TelegramBot\Commands\UserCommands;

use Longman\TelegramBot\Commands\UserCommand;
use Longman\TelegramBot\Commands\AppointmentCommand;
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

  private function getPatientRepository()
  {
    return new \PacientsRepository(new \AppConfig);
  }

  private function checkDni($dni)
  {
    if (!isset($dni))
      throw new \Exception("$dni es un DNI invalido");

    if (!$this->getPatientRepository()->dniExists($dni))
      throw new \Exception("$dni no existe en el sistema");
  }

  private function checkArgs($args)
  {
    # $this->checkDni($args['dni']);
    AppointmentCommand::isValidDate($args['fecha']);
    AppointmentCommand::isValidTime($args['hora']);
  }

  public function execute()
  {
    $message = $this->getMessage();
    $chat_id = $message->getChat()->getId();

    try
    {
      $params = $this->parseArgs($message->getText(true));
      $this->checkArgs($params);
      $fecha = $params['fecha'];
      $hora = $params['hora'];
      $dni = $params['dni'];
      AppointmentCommand::getRepository()->appoint($fecha, $hora, $dni);
      $id_turno = AppointmentCommand::getRepository()->getLastId();

      $data = [
        'chat_id' => $chat_id,
        'text' => "Te confirmamos el turno nro $id_turno para $dni, a las $hora del dia $fecha"
      ];
    }
    catch (\Exception $e)
    {
      $data = [
        'chat_id' => $chat_id,
        'text' => 'Ocurrio un error: ' . e . getMessage()
      ];
    }

    return Request::sendMessage($data);
  }
}
